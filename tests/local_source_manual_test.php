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
    }

    public function test_notify_allocation() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $guest = guest_user();
        $admin = get_admin();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $this->setUser($user3);

        $sink = $this->redirectMessages();
        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull($allocation->timenotifiedallocation);

        $program1 = program::update_program_notifications((object)[
            'id' => $program1->id,
            'allocation_manual' => 1,
        ], false);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        manual::allocate_users($program1->id, $source1->id, [$user2->id]);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($allocation->timenotifiedallocation);
        $message = $messages[0];
        $this->assertSame('Program allocation notification', $message->subject);
        $this->assertStringContainsString('you have been allocated to program', $message->fullmessage);
        $this->assertSame($user2->id, $message->useridto);
        $this->assertSame($user3->id, $message->useridfrom);
    }

    public function test_notify_deallocation() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $admin = get_admin();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $this->setUser($user3);

        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $sink = $this->redirectMessages();
        manual::deallocate_user($program1, $source1, $allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);

        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $program1 = program::update_program_notifications((object)[
            'id' => $program1->id,
            'notifydeallocation' => 1,
        ], false);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        manual::deallocate_user($program1, $source1, $allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $message = $messages[0];
        $this->assertSame('Program deallocation notification', $message->subject);
        $this->assertStringContainsString('you have been deallocated from program', $message->fullmessage);
        $this->assertSame($user1->id, $message->useridto);
        $this->assertSame($user3->id, $message->useridfrom);
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
}
