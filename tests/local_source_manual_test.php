<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace enrol_programs;

use enrol_programs\local\source\manual;
use enrol_programs\local\program;

/**
 * Manual allocation source test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\source\manual
 */
final class local_source_manual_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_get_type() {
        $this->assertSame('manual', manual::get_type());
    }

    public function test_ai_new_alloved() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $program = $generator->create_program();

        $this->assertTrue(manual::is_new_allowed($program));
        set_config('source_manual_allownew', 0, 'enrol_programs');
        $this->assertTrue(manual::is_new_allowed($program));
    }

    public function test_is_allocation_possible() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program1 = program::update_program_allocation(
            (object)['id' => $program1->id, 'timeallocationstart' => null, 'timeallocationend' => null]
        );
        $this->assertTrue(manual::is_allocation_possible($program1, $source1));

        $program1 = program::update_program_allocation(
            (object)['id' => $program1->id, 'timeallocationstart' => time() - 100, 'timeallocationend' => time() + 100]
        );
        $this->assertTrue(manual::is_allocation_possible($program1, $source1));

        $program1 = program::update_program_allocation(
            (object)['id' => $program1->id, 'timeallocationstart' => time() + 100, 'timeallocationend' => time() + 200]
        );
        $this->assertFalse(manual::is_allocation_possible($program1, $source1));

        $program1 = program::update_program_allocation(
            (object)['id' => $program1->id, 'timeallocationstart' => time() - 200, 'timeallocationend' => time() - 100]
        );
        $this->assertFalse(manual::is_allocation_possible($program1, $source1));

        $program1 = program::update_program_allocation(
            (object)['id' => $program1->id, 'timeallocationstart' => null, 'timeallocationend' => null]
        );
        $program1 = program::update_program_general(
            (object)['id' => $program1->id, 'archived' => 1]
        );
        $this->assertFalse(manual::is_allocation_possible($program1, $source1));
    }

    public function test_allocate_users() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $guest = guest_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'id ASC');
        $allocations = array_values($allocations);
        $this->assertCount(2, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($program1->id, $allocations[0]->programid);
        $this->assertSame($source1->id, $allocations[0]->sourceid);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($program1->id, $allocations[1]->programid);
        $this->assertSame($source1->id, $allocations[1]->sourceid);

        // Invalid default dates get fixed.
        $now = time();
        $data = (object)[
            'id' => $program1->id,
            'programstart_type' => 'date',
            'programstart_date' => $now,
            'programdue_type' => 'date',
            'programdue_date' => $now - 10,
            'programend_type' => 'date',
            'programend_date' => $now - 20,
        ];
        $program1 = program::update_program_scheduling($data);
        manual::allocate_users($program1->id, $source1->id, [$user3->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user3->id]);
        $this->assertEquals($now, $allocation->timestart);
        $this->assertEquals($now + 1, $allocation->timedue);
        $this->assertEquals($now + 1, $allocation->timeend);

        // Use date overrides.
        $now = time();
        $dateoverrides = [
            'timeallocated' => $now - 60*60*3,
            'timestart' => $now - 60*60*2,
            'timedue' => $now + 60*60*1,
            'timeend' => $now + 60*60*2,
        ];
        manual::allocate_users($program1->id, $source1->id, [$user4->id], $dateoverrides);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user4->id]);
        $this->assertSame((string)$dateoverrides['timeallocated'], $allocation->timeallocated);
        $this->assertSame((string)$dateoverrides['timestart'], $allocation->timestart);
        $this->assertSame((string)$dateoverrides['timedue'], $allocation->timedue);
        $this->assertSame((string)$dateoverrides['timeend'], $allocation->timeend);
    }

    public function test_deallocate_user() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $guest = guest_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $notification = $generator->create_program_notification(['programid' => $program1->id, 'notificationtype' => 'allocation']);
        $this->assertCount(0, $DB->get_records('local_openlms_user_notified', []));

        manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertCount(2, $DB->get_records('local_openlms_user_notified', []));
        $this->assertCount(1, $DB->get_records('local_openlms_user_notified', ['userid' => $user1->id]));
        $this->assertCount(1, $DB->get_records('local_openlms_user_notified', ['userid' => $user2->id]));

        manual::deallocate_user($program1, $source1, $allocation1);
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id]));
        $this->assertCount(1, $DB->get_records('local_openlms_user_notified', []));
        $this->assertCount(0, $DB->get_records('local_openlms_user_notified', ['userid' => $user1->id]));
        $this->assertCount(1, $DB->get_records('local_openlms_user_notified', ['userid' => $user2->id]));
    }

    public function test_store_uploaded_data() {
        global $CFG;
        require_once("$CFG->libdir/filelib.php");

        $admin = get_admin();
        $this->setUser($admin);
        $draftid = file_get_unused_draft_itemid();
        $fs = get_file_storage();
        $context = \context_user::instance($admin->id);
        $record = [
            'contextid' => $context->id,
            'component' => 'user',
            'filearea' => 'draft',
            'itemid' => $draftid,
            'filepath' => '/',
            'filename' => 'somefile.csv',
        ];
        $fs->create_file_from_string($record, 'content is irrelevant');

        $csvdata = [
            ['username', 'firstname', 'lastname'],
            ['user1', 'First', 'User'],
            ['user2', 'Second', 'User'],
        ];
        manual::store_uploaded_data($draftid, $csvdata);

        $files = $fs->get_area_files($context->id, 'enrol_programs', 'upload', $draftid, 'id ASC', false);
        $this->assertCount(1, $files);
        $file = reset($files);
        $this->assertSame('/', $file->get_filepath());
        $this->assertSame('data.json', $file->get_filename());
        $this->assertEquals($csvdata, json_decode($file->get_content()));
    }

    public function test_get_uploaded_data() {
        global $CFG;
        require_once("$CFG->libdir/filelib.php");

        $admin = get_admin();
        $this->setUser($admin);
        $draftid = file_get_unused_draft_itemid();

        $this->assertNull(manual::get_uploaded_data($draftid));
        $this->assertNull(manual::get_uploaded_data(-1));
        $this->assertNull(manual::get_uploaded_data(0));

        $fs = get_file_storage();
        $context = \context_user::instance($admin->id);
        $record = [
            'contextid' => $context->id,
            'component' => 'user',
            'filearea' => 'draft',
            'itemid' => $draftid,
            'filepath' => '/',
            'filename' => 'somefile.csv',
        ];
        $fs->create_file_from_string($record, 'content is irrelevant');

        $this->assertNull(manual::get_uploaded_data($draftid));

        $csvdata = [
            ['username', 'firstname', 'lastname'],
            ['user1', 'First', 'User'],
            ['user2', 'Second', 'User'],
        ];
        manual::store_uploaded_data($draftid, $csvdata);

        $this->assertEquals($csvdata, manual::get_uploaded_data($draftid));
    }

    public function test_process_uploaded_data() {
        global $CFG, $DB;
        require_once("$CFG->libdir/filelib.php");

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $admin = get_admin();
        $user1 = $this->getDataGenerator()->create_user(['username' => 'user1', 'email' => 'user1@example.com', 'idnumber' => 'u1']);
        $user2 = $this->getDataGenerator()->create_user(['username' => 'user2', 'email' => 'user2@example.com', 'idnumber' => 'u2']);
        $user3 = $this->getDataGenerator()->create_user(['username' => 'user3', 'email' => 'user3@example.com', 'idnumber' => 'u3']);
        $user4 = $this->getDataGenerator()->create_user(['username' => 'user4', 'email' => 'user4@example.com', 'idnumber' => 'u4']);

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $admin = get_admin();
        $this->setUser($admin);
        $draftid = file_get_unused_draft_itemid();

        $csvdata = [
            ['username', 'firstname', 'lastname'],
            ['user1', 'First', 'User'],
            ['user2', 'Second', 'User'],
        ];
        $data = (object)[
            'sourceid' => $source1->id,
            'usermapping' => 'username',
            'usercolumn' => 0,
            'hasheaders' => 1,
            'userfile' => $draftid,
        ];
        $expected = [
            'assigned' => 2,
            'skipped' => 0,
            'errors' => 0,
        ];
        $result = manual::process_uploaded_data($data, $csvdata);
        $this->assertSame($expected, $result);
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id]));
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user3->id]));
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user4->id]));

        $csvdata = [
            ['user3@example.com'],
            ['user2@example.com'],
        ];
        $data = (object)[
            'sourceid' => $source1->id,
            'usermapping' => 'email',
            'usercolumn' => 0,
            'hasheaders' => 0,
            'userfile' => $draftid,
        ];
        $expected = [
            'assigned' => 1,
            'skipped' => 1,
            'errors' => 0,
        ];
        $result = manual::process_uploaded_data($data, $csvdata);
        $this->assertSame($expected, $result);
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user3->id]));
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user4->id]));

        $csvdata = [
            ['1', 'u5'],
            ['1', 'u4'],
        ];
        $data = (object)[
            'sourceid' => $source1->id,
            'usermapping' => 'idnumber',
            'usercolumn' => 1,
            'hasheaders' => 0,
            'userfile' => $draftid,
        ];
        $expected = [
            'assigned' => 1,
            'skipped' => 0,
            'errors' => 1,
        ];
        $result = manual::process_uploaded_data($data, $csvdata);
        $this->assertSame($expected, $result);
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user3->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user4->id]));
    }

    public function test_process_uploaded_data_with_dates() {
        global $CFG, $DB;
        require_once("$CFG->libdir/filelib.php");

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $admin = get_admin();
        $this->setUser($admin);

        $admin = get_admin();
        $user1 = $this->getDataGenerator()->create_user(['username' => 'user1', 'email' => 'user1@example.com', 'idnumber' => 'u1']);
        $user2 = $this->getDataGenerator()->create_user(['username' => 'user2', 'email' => 'user2@example.com', 'idnumber' => 'u2']);
        $user3 = $this->getDataGenerator()->create_user(['username' => 'user3', 'email' => 'user3@example.com', 'idnumber' => 'u3']);
        $user4 = $this->getDataGenerator()->create_user(['username' => 'user4', 'email' => 'user4@example.com', 'idnumber' => 'u4']);
        $user5 = $this->getDataGenerator()->create_user(['username' => 'user5', 'email' => 'user4@example.com', 'idnumber' => 'u5']);

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $timestart = time();
        $tz = new \DateTimeZone(get_user_timezone());
        $pdata = (object)[
            'id' => $program1->id,
            'programstart_type' => 'date',
            'programstart_date' => $timestart,
            'programdue_type' => 'date',
            'programdue_date' => $timestart + (20 * 60 * 60 * 24),
            'programend_type' => 'date',
            'programend_date' => $timestart + (30 * 60 * 60 * 24),
        ];
        $program1 = program::update_program_scheduling($pdata);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $draftid = file_get_unused_draft_itemid();

        $timestart2 = new \DateTime('@' . ($timestart - (10 * 60 * 60 * 24)));
        $timedue3 = new \DateTime('@' . ($timestart + (1 * 60 * 60 * 24)));
        $timeend3 = new \DateTime('@' . ($timestart + (2 * 60 * 60 * 24)));
        $csvdata = [
            ['u1', '', '', ''],
            ['u2', $timestart2->format(\DateTime::ATOM), '', ''],
            ['u3', '', $timedue3->format(\DateTime::ATOM), $timeend3->format(\DateTime::COOKIE)],
            ['u4', 'abc', '', ''],
            ['u5', '', '', '01/01/2001'],
        ];
        $data = (object)[
            'sourceid' => $source1->id,
            'usermapping' => 'idnumber',
            'usercolumn' => 0,
            'timestartcolumn' => 1,
            'timeduecolumn' => 2,
            'timeendcolumn' => 3,
            'hasheaders' => 0,
            'userfile' => $draftid,
        ];
        $expected = [
            'assigned' => 3,
            'skipped' => 0,
            'errors' => 2,
        ];
        $result = manual::process_uploaded_data($data, $csvdata);
        $this->assertSame($expected, $result);

        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertEquals($pdata->programstart_date, $allocation1->timestart);
        $this->assertEquals($pdata->programdue_date, $allocation1->timedue);
        $this->assertEquals($pdata->programend_date, $allocation1->timeend);

        $allocation2 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id]);
        $this->assertEquals($timestart2->getTimestamp(), $allocation2->timestart);
        $this->assertEquals($pdata->programdue_date, $allocation2->timedue);
        $this->assertEquals($pdata->programend_date, $allocation2->timeend);

        $allocation3 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user3->id]);
        $this->assertEquals($pdata->programstart_date, $allocation3->timestart);
        $this->assertEquals($timedue3->getTimestamp(), $allocation3->timedue);
        $this->assertEquals($timeend3->getTimestamp(), $allocation3->timeend);
    }

    public function test_cleanup_uploaded_data() {
        global $CFG, $DB;
        require_once("$CFG->libdir/filelib.php");

        $admin = get_admin();
        $this->setUser($admin);
        $draftid = file_get_unused_draft_itemid();
        $fs = get_file_storage();
        $context = \context_user::instance($admin->id);
        $csvdata = [
            ['username', 'firstname', 'lastname'],
            ['user1', 'First', 'User'],
            ['user2', 'Second', 'User'],
        ];
        manual::store_uploaded_data($draftid, $csvdata);
        $files = $fs->get_area_files($context->id, 'enrol_programs', 'upload', $draftid, 'id ASC', false);
        $this->assertCount(1, $files);

        manual::cleanup_uploaded_data();
        $files = $fs->get_area_files($context->id, 'enrol_programs', 'upload', $draftid, 'id ASC', false);
        $this->assertCount(1, $files);

        $old = time() - 60*60*24*1;
        $DB->set_field('files', 'timecreated', $old, ['component' => 'enrol_programs']);
        manual::cleanup_uploaded_data();
        $files = $fs->get_area_files($context->id, 'enrol_programs', 'upload', $draftid, 'id ASC', false);
        $this->assertCount(1, $files);

        $old = time() - 60*60*24*2 - 10;
        $DB->set_field('files', 'timecreated', $old, ['component' => 'enrol_programs']);
        manual::cleanup_uploaded_data();
        $files = $fs->get_area_files($context->id, 'enrol_programs', 'upload', $draftid, 'id ASC', false);
        $this->assertCount(0, $files);
    }

    public function test_tool_uploaduser_process() {
        global $CFG, $DB;
        require_once("$CFG->dirroot/admin/tool/uploaduser/locallib.php");

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['idnumber' => 123, 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['idnumber' => 342, 'sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $now = time();
        $data = (object)[
            'id' => $program2->id,
            'programstart_type' => 'date',
            'programstart_date' => $now,
            'programdue_type' => 'date',
            'programdue_date' => $now + 60*60,
            'programend_type' => 'date',
            'programend_date' => $now + 60*60*2,
        ];
        $program2 = program::update_program_scheduling($data);

        $program3 = $generator->create_program();

        $user1 = $this->getDataGenerator()->create_user(['username' => 'user1', 'email' => 'user1@example.com', 'idnumber' => 'u1']);
        $user2 = $this->getDataGenerator()->create_user(['username' => 'user2', 'email' => 'user2@example.com', 'idnumber' => 'u2']);
        $manager = $this->getDataGenerator()->create_user();

        $syscontext = \context_system::instance();
        $managerroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:allocate', CAP_ALLOW, $managerroleid, $syscontext);
        role_assign($managerroleid, $manager->id, $syscontext->id);
        $this->setUser($manager);

        $upt = new class extends \uu_progress_tracker {
            public $result;
            public function reset() {
                $this->result = [];
                return $this;
            }
            public function track($col, $msg, $level = 'normal', $merge = true) {
                if (!in_array($col, $this->columns)) {
                    throw new \Exception('Incorrect column:'.$col);
                }
                if (!$merge) {
                    $this->result[$col][$level] = [];
                }
                $this->result[$col][$level][] = $msg;
            }
        };

        $data = (object)[
            'id' => $user1->id,
            'program1' => $program1->idnumber,
        ];
        manual::tool_uploaduser_process($data, 'xyz', $upt->reset());
        $this->assertSame([], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);

        $data = (object)[
            'id' => $user1->id,
            'program1' => $program1->idnumber,
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'program1', $upt->reset());
        $this->assertSame([
            'enrolments' => ['info' => ['Allocated to \'Program 1\'']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertTimeCurrent($allocation->timeallocated);
        $this->assertTimeCurrent($allocation->timeallocated, $allocation->timestart);
        $this->assertSame(null, $allocation->timedue);
        $this->assertSame(null, $allocation->timeend);
        manual::deallocate_user($program1, $source1, $allocation);

        $data = (object)[
            'id' => $user1->id,
            'programid9' => $program1->id,
            'pstartdate9' => '10/29/2022',
            'penddate9' => '2022-12-29',
            'pduedate9' => '21.11.2022',
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'programid9', $upt->reset());
        $this->assertSame([
            'enrolments' => ['info' => ['Allocated to \'Program 1\'']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertTimeCurrent($allocation->timeallocated);
        $this->assertSame(strtotime($data->pstartdate9), (int)$allocation->timestart);
        $this->assertSame(strtotime($data->pduedate9), (int)$allocation->timedue);
        $this->assertSame(strtotime($data->penddate9), (int)$allocation->timeend);
        manual::deallocate_user($program1, $source1, $allocation);

        $data = (object)[
            'id' => $user1->id,
            'program2' => $program2->idnumber,
            'pstartdate2' => '10/29/2022',
            'penddate2' => '',
            'pduedate2' => '',
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'program2', $upt->reset());
        $this->assertSame([
            'enrolments' => ['info' => ['Allocated to \'Program 2\'']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program2->id, 'userid' => $user1->id]);
        $this->assertTimeCurrent($allocation->timeallocated);
        $this->assertSame(strtotime($data->pstartdate2), (int)$allocation->timestart);
        $this->assertSame($now + 60*60, (int)$allocation->timedue);
        $this->assertSame($now + 60*60*2, (int)$allocation->timeend);
        manual::deallocate_user($program2, $source2, $allocation);

        $data = (object)[
            'id' => $user1->id,
            'programid1' => '999',
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'programid1', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Cannot allocate to \'999\'']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);

        $data = (object)[
            'id' => $user1->id,
            'programid1' => $program3->id,
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'programid1', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Cannot allocate to \'Program 3\'']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program3->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);

        $data = (object)[
            'id' => $user1->id,
            'programid1' => $program1->id,
            'pstartdate1' => 'xx',
            'penddate1' => '',
            'pduedate1' => '',
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'programid1', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Invalid program allocation dates']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);

        $data = (object)[
            'id' => $user1->id,
            'programid1' => $program1->id,
            'pstartdate1' => '10/29/2022',
            'penddate1' => '2022-09-29',
            'pduedate1' => '21.11.2022',
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'programid1', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Invalid program allocation dates']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);

        $data = (object)[
            'id' => $user1->id,
            'program1' => $program3->idnumber,
        ];
        manual::tool_uploaduser_process($data, 'program1', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Cannot allocate to \'Program 3\'']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program3->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);

        $data = (object)[
            'id' => $user1->id,
            'programid2' => $program2->id,
            'pstartdate2' => '10/29/2035',
            'penddate2' => '',
            'pduedate2' => '',
        ];
        manual::tool_uploaduser_process($data, 'programid2', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Invalid program allocation dates']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program2->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);

        $this->setUser($user2);

        $data = (object)[
            'id' => $user1->id,
            'program1' => $program1->idnumber,
        ];
        manual::tool_uploaduser_process($data, 'program1', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Cannot allocate to \'Program 1\'']],
        ], $upt->result);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]);
        $this->assertFalse($allocation);
    }


    public function test_tool_uploaduser_programid_col_process() {
        global $CFG, $DB;
        require_once("$CFG->dirroot/admin/tool/uploaduser/locallib.php");

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['idnumber' => 123, 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['idnumber' => 'PR2', 'sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $now = time();
        $user1 = $this->getDataGenerator()->create_user(['username' => 'user1', 'email' => 'user1@example.com', 'idnumber' => 'u1']);
        $user2 = $this->getDataGenerator()->create_user(['username' => 'user2', 'email' => 'user2@example.com', 'idnumber' => 'u2']);
        $manager = $this->getDataGenerator()->create_user();

        $syscontext = \context_system::instance();
        $managerroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:allocate', CAP_ALLOW, $managerroleid, $syscontext);
        role_assign($managerroleid, $manager->id, $syscontext->id);
        $this->setUser($manager);

        $upt = new class extends \uu_progress_tracker {
            public $result;
            public function reset() {
                $this->result = [];
                return $this;
            }
            public function track($col, $msg, $level = 'normal', $merge = true) {
                if (!in_array($col, $this->columns)) {
                    throw new \Exception('Incorrect column:'.$col);
                }
                if (!$merge) {
                    $this->result[$col][$level] = [];
                }
                $this->result[$col][$level][] = $msg;
            }
        };

        $data = (object)[
            'id' => $user1->id,
            'programid2' => $program2->idnumber,
            'pstartdate2' => '10/29/2022',
            'penddate2' => '',
            'pduedate2' => '',
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'programid2', $upt->reset());
        $this->assertSame([
            'enrolments' => ['error' => ['Cannot allocate to \'PR2\'']],
        ], $upt->result);

        $data = (object)[
            'id' => $user1->id,
            'programid2' => $program2->id,
            'pstartdate2' => '10/29/2022',
            'penddate2' => '',
            'pduedate2' => '',
        ];
        $this->setCurrentTimeStart();
        manual::tool_uploaduser_process($data, 'programid2', $upt->reset());
        $this->assertSame([
            'enrolments' => ['info' => ['Allocated to \'Program 2\'']],
        ], $upt->result);
    }
}
