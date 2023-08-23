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

namespace enrol_programs\local\source;

use tool_certify\local\source\manual;
use enrol_programs\local\program;
use tool_certify\local\certification;
use tool_certify\local\assignment;
use tool_certify\local\period;
use stdClass;

/**
 * Certifications program source test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\source\certify
 */
final class certify_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
        if (!get_config('tool_certify', 'version')) {
            $this->markTestSkipped('tool_certify not available');
        }
    }

    public function test_get_type() {
        $this->assertSame('certify', certify::get_type());
    }

    public function test_is_new_allowed() {
        $program = new stdClass();
        $this->assertSame(true, certify::is_new_allowed($program));
    }

    public function test_is_update_allowed() {
        $program = new stdClass();
        $this->assertSame(true, certify::is_new_allowed($program));
    }

    public function test_allocation_edit_supported() {
        $program = new stdClass();
        $source = new stdClass();
        $allocation = new stdClass();
        $this->assertSame(false, certify::allocation_edit_supported($program, $source, $allocation));
    }

    public function test_allocation_delete_supported() {
        $now = time();
        $program = new stdClass();
        $source = new stdClass();
        $allocation = new stdClass();
        $allocation->archived = '0';
        $allocation->timeend = null;
        $this->assertSame(false, certify::allocation_delete_supported($program, $source, $allocation));

        $allocation->timeend = $now + 100;
        $this->assertSame(false, certify::allocation_delete_supported($program, $source, $allocation));

        $allocation->timeend = $now - 100;
        $this->assertSame(true, certify::allocation_delete_supported($program, $source, $allocation));

        $allocation->timeend = null;
        $allocation->archived = '1';
        $this->assertSame(true, certify::allocation_delete_supported($program, $source, $allocation));
    }

    public function test_render_status_details() {
        global $DB;
        /** @var \tool_certify_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('tool_certify');
        /** @var \enrol_programs_generator $programgenerator */
        $programgenerator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $category = $this->getDataGenerator()->create_category([]);
        $catcontext = \context_coursecat::instance($category->id);
        $syscontext = \context_system::instance();

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $viewerroleid = $this->getDataGenerator()->create_role();
        assign_capability('tool/certify:view', CAP_ALLOW, $viewerroleid, $syscontext);
        role_assign($viewerroleid, $user1->id, $catcontext->id);

        $this->setUser($user2);

        $program1 = $programgenerator->create_program();
        $source1 = null;
        $this->assertSame('Inactive', certify::render_status_details($program1, $source1));

        $program2 = $programgenerator->create_program(['sources' => 'certify']);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'certify']);
        $this->assertSame('Active', certify::render_status_details($program2, $source2));

        $program3 = $programgenerator->create_program(['sources' => 'certify']);

        $certification1 = $generator->create_certification([
            'programid1' => $program2->id,
            'contextid' => $catcontext->id,
        ]);
        $this->assertSame('Active - Certification 1', certify::render_status_details($program2, $source2));

        $certification2 = $generator->create_certification([
            'programid1' => $program1->id,
            'contextid' => $syscontext->id,
        ]);
        $this->assertSame('Active - Certification 1', certify::render_status_details($program2, $source2));

        $certification3 = $generator->create_certification([
            'programid1' => $program1->id,
            'recertify' => DAYSECS,
            'programid2' => $program2->id,
        ]);
        $this->assertSame('Active - Certification 1, Certification 3', certify::render_status_details($program2, $source2));

        $this->setUser($user1);
        $result = certify::render_status_details($program2, $source2);
        $this->assertNotSame('Active - Certification 1, Certification 3', $result);
        $this->assertStringContainsString('Active', $result);
        $this->assertStringContainsString('>Certification 1<', $result);
        $this->assertStringContainsString('Certification 3', $result);
    }

    public function test_purge_courses() {
        $this->setAdminUser();

        $modules = \core_plugin_manager::instance()->get_plugins_of_type('mod');
        if (!$modules['bigbluebuttonbn']->is_enabled()) {
            \core\plugininfo\mod::enable_plugin('bigbluebuttonbn', true);
        }

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $params = ['course' => $course1->id];
        $this->getDataGenerator()->create_module('assign', $params, []);
        $this->getDataGenerator()->create_module('bigbluebuttonbn', $params, []);
        $this->getDataGenerator()->create_module('chat', $params, []);
        $this->getDataGenerator()->create_module('choice', $params, []);
        $this->getDataGenerator()->create_module('data', $params, []);
        if (get_config('mod_facetoface', 'version')) {
            $this->getDataGenerator()->create_module('facetoface', $params, []);
        }
        $this->getDataGenerator()->create_module('feedback', $params, []);
        $this->getDataGenerator()->create_module('forum', $params, []);
        $this->getDataGenerator()->create_module('glossary', $params, []);
        $this->getDataGenerator()->create_module('lesson', $params, []);
        $this->getDataGenerator()->create_module('quiz', $params, []);
        $this->getDataGenerator()->create_module('scorm', $params, []);
        $this->getDataGenerator()->create_module('survey', $params, []);
        $this->getDataGenerator()->create_module('wiki', $params, []);
        $this->getDataGenerator()->create_module('workshop', $params, []);

        certify::purge_courses([$course1->id, $course2->id], $user1->id);
    }

    public function test_sync_certifications_allocate() {
        global $DB;
        /** @var \tool_certify_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('tool_certify');
        /** @var \enrol_programs_generator $programgenerator */
        $programgenerator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 1]);
        $program1source = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'certify']);
        $top1 = program::load_content($program1->id);
        $program2 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 1]);
        $program2source = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'certify']);
        $top2 = program::load_content($program2->id);

        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program1->id,
        ];
        $certification1 = $generator->create_certification($data);
        $source1 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program2->id,
        ];
        $certification2 = $generator->create_certification($data);
        $source2 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification2->id], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $user5 = $this->getDataGenerator()->create_user();
        $user6 = $this->getDataGenerator()->create_user();
        $user7 = $this->getDataGenerator()->create_user();
        $user8 = $this->getDataGenerator()->create_user();
        $user9 = $this->getDataGenerator()->create_user();

        $now = time();

        manual::assign_users($certification1->id, $source1->id, [$user1->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user2->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => $now - DAYSECS,
            'timewindowend' => $now + DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user3->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => $now - DAYSECS * 2,
            'timewindowend' => $now - DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user4->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $assignment4 = $DB->get_record('tool_certify_assignments',
            ['userid' => $user4->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $assignment4->archived = '1';
        $assignment4 = assignment::update_user($assignment4);

        manual::assign_users($certification1->id, $source1->id, [$user5->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $period5 = $DB->get_record('tool_certify_periods',
            ['userid' => $user5->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $period5 = period::override_dates((object)['id' => $period5->id, 'timerevoked' => $now]);

        manual::assign_users($certification1->id, $source1->id, [$user6->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
            'timefrom' => $now - WEEKSECS,
            'timeuntil' => $now + DAYSECS,
        ]);
        $period6 = $DB->get_record('tool_certify_periods',
            ['userid' => $user6->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $period6 = period::override_dates((object)['id' => $period6->id, 'timecertified' => $now]);

        manual::assign_users($certification1->id, $source1->id, [$user7->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
            'timefrom' => $now - WEEKSECS,
            'timeuntil' => $now + DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user8->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
            'timefrom' => $now - WEEKSECS,
            'timeuntil' => $now - DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user9->id], [
            'timewindowstart' => $now + DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);

        $this->assertCount(0, $DB->get_records('enrol_programs_allocations'));

        certify::sync_certifications(null, null);
        $this->assertCount(0, $DB->get_records('enrol_programs_allocations'));

        certify::sync_certifications($certification1->id, null);
        $this->assertCount(0, $DB->get_records('enrol_programs_allocations'));

        certify::sync_certifications($certification1->id, $user1->id);
        $this->assertCount(0, $DB->get_records('enrol_programs_allocations'));

        certify::sync_certifications(null, $user1->id);
        $this->assertCount(0, $DB->get_records('enrol_programs_allocations'));

        $DB->set_field('enrol_programs_programs', 'archived', '0', []);
        certify::sync_certifications(null, null);
        $this->assertCount(3, $DB->get_records('enrol_programs_allocations'));
        $allocation1 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('0', $allocation1->archived);
        $this->assertSame((string)($now - DAYSECS), $allocation1->timestart);
        $this->assertSame(null, $allocation1->timedue);
        $this->assertSame(null, $allocation1->timeend);
        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertSame('0', $allocation2->archived);
        $this->assertSame((string)($now - WEEKSECS), $allocation2->timestart);
        $this->assertSame((string)($now - DAYSECS), $allocation2->timedue);
        $this->assertSame((string)($now + DAYSECS), $allocation2->timeend);
        $allocation7 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user7->id], '*', MUST_EXIST);
        $this->assertSame('0', $allocation7->archived);
        $this->assertSame((string)($now - WEEKSECS), $allocation7->timestart);
        $this->assertSame(null, $allocation7->timedue);
        $this->assertSame(null, $allocation7->timeend);

        $period1 = $DB->get_record('tool_certify_periods',
            ['userid' => $user1->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation1->id, $period1->allocationid);
        $period2 = $DB->get_record('tool_certify_periods',
            ['userid' => $user2->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation2->id, $period2->allocationid);
        $period3 = $DB->get_record('tool_certify_periods',
            ['userid' => $user3->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame(null, $period3->allocationid);
        $period4 = $DB->get_record('tool_certify_periods',
            ['userid' => $user4->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame(null, $period4->allocationid);
        $period5 = $DB->get_record('tool_certify_periods',
            ['userid' => $user5->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame(null, $period5->allocationid);
        $period6 = $DB->get_record('tool_certify_periods',
            ['userid' => $user6->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame(null, $period6->allocationid);
        $period7 = $DB->get_record('tool_certify_periods',
            ['userid' => $user7->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation7->id, $period7->allocationid);
        $period8 = $DB->get_record('tool_certify_periods',
            ['userid' => $user8->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame(null, $period8->allocationid);
    }

    public function test_sync_certifications_archive() {
        global $DB;
        /** @var \tool_certify_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('tool_certify');
        /** @var \enrol_programs_generator $programgenerator */
        $programgenerator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 0]);
        $program1source = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'certify']);
        $top1 = program::load_content($program1->id);
        $program2 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 0]);
        $program2source = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'certify']);
        $top2 = program::load_content($program2->id);

        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program1->id,
        ];
        $certification1 = $generator->create_certification($data);
        $source1 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program2->id,
        ];
        $certification2 = $generator->create_certification($data);
        $source2 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification2->id], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $user5 = $this->getDataGenerator()->create_user();
        $user6 = $this->getDataGenerator()->create_user();
        $user7 = $this->getDataGenerator()->create_user();
        $user8 = $this->getDataGenerator()->create_user();
        $user9 = $this->getDataGenerator()->create_user();

        $now = time();

        manual::assign_users($certification1->id, $source1->id, [$user1->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification1->id, $source1->id, [$user2->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification1->id, $source1->id, [$user3->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification1->id, $source1->id, [$user4->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification1->id, $source1->id, [$user5->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification1->id, $source1->id, [$user6->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $period1 = $DB->get_record('tool_certify_periods',
            ['userid' => $user1->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $period2 = $DB->get_record('tool_certify_periods',
            ['userid' => $user2->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $assignment3 = $DB->get_record('tool_certify_assignments',
            ['userid' => $user3->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $allocation3 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user3->id], '*', MUST_EXIST);
        $period3 = $DB->get_record('tool_certify_periods',
            ['userid' => $user3->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $allocation4 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user4->id], '*', MUST_EXIST);
        $period4 = $DB->get_record('tool_certify_periods',
            ['userid' => $user4->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $allocation5 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user5->id], '*', MUST_EXIST);
        $period5 = $DB->get_record('tool_certify_periods',
            ['userid' => $user5->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $allocation6 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user6->id], '*', MUST_EXIST);
        $period6 = $DB->get_record('tool_certify_periods',
            ['userid' => $user6->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertCount(6, $DB->get_records('enrol_programs_allocations',
            ['sourceid' => $program1source->id, 'archived' => 0]));

        $period2->timewindowend = (string)($now - 10);
        $DB->update_record('tool_certify_periods', $period2);

        $assignment3->archived = '1';
        $DB->update_record('tool_certify_assignments', $assignment3);

        $DB->delete_records('tool_certify_periods', ['id' => $period4->id]);

        $period5->timefrom = (string)($now - 1000);
        $period5->timeuntil = (string)($now - 10);
        $DB->update_record('tool_certify_periods', $period5);

        $period6->timerevoked = (string)$now;
        $DB->update_record('tool_certify_periods', $period6);

        certify::sync_certifications(null, null);
        $this->assertCount(1, $DB->get_records('enrol_programs_allocations',
            ['sourceid' => $program1source->id, 'archived' => 0]));
        $this->assertCount(5, $DB->get_records('enrol_programs_allocations',
            ['sourceid' => $program1source->id, 'archived' => 1]));

        $certification1->archived = '1';
        $DB->update_record('tool_certify_certifications', $certification1);
        certify::sync_certifications(null, null);
        $this->assertCount(0, $DB->get_records('enrol_programs_allocations',
            ['sourceid' => $program1source->id, 'archived' => 0]));
        $this->assertCount(6, $DB->get_records('enrol_programs_allocations',
            ['sourceid' => $program1source->id, 'archived' => 1]));
    }

    public function test_sync_certifications_restore() {
        global $DB;
        /** @var \tool_certify_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('tool_certify');
        /** @var \enrol_programs_generator $programgenerator */
        $programgenerator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 0]);
        $program1source = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'certify']);
        $top1 = program::load_content($program1->id);
        $program2 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 0]);
        $program2source = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'certify']);
        $top2 = program::load_content($program2->id);

        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program1->id,
        ];
        $certification1 = $generator->create_certification($data);
        $source1 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program2->id,
        ];
        $certification2 = $generator->create_certification($data);
        $source2 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification2->id], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $user5 = $this->getDataGenerator()->create_user();
        $user6 = $this->getDataGenerator()->create_user();
        $user7 = $this->getDataGenerator()->create_user();
        $user8 = $this->getDataGenerator()->create_user();
        $user9 = $this->getDataGenerator()->create_user();

        $now = time();

        manual::assign_users($certification1->id, $source1->id, [$user1->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user2->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => $now - DAYSECS,
            'timewindowend' => $now + DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user3->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => $now - DAYSECS * 2,
            'timewindowend' => $now - DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user4->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $assignment4 = $DB->get_record('tool_certify_assignments',
            ['userid' => $user4->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $assignment4->archived = '1';
        $assignment4 = assignment::update_user($assignment4);

        manual::assign_users($certification1->id, $source1->id, [$user5->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $period5 = $DB->get_record('tool_certify_periods',
            ['userid' => $user5->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $period5 = period::override_dates((object)['id' => $period5->id, 'timerevoked' => $now]);

        manual::assign_users($certification1->id, $source1->id, [$user6->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
            'timefrom' => $now - WEEKSECS,
            'timeuntil' => $now + DAYSECS,
        ]);
        $period6 = $DB->get_record('tool_certify_periods',
            ['userid' => $user6->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $period6 = period::override_dates((object)['id' => $period6->id, 'timecertified' => $now]);

        manual::assign_users($certification1->id, $source1->id, [$user7->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
            'timefrom' => $now - WEEKSECS,
            'timeuntil' => $now + DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user8->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
            'timefrom' => $now - WEEKSECS,
            'timeuntil' => $now - DAYSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user9->id], [
            'timewindowstart' => $now + DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);

        $this->assertCount(6, $DB->get_records('enrol_programs_allocations'));

        $DB->set_field('enrol_programs_allocations', 'archived', '1', []);
        certify::sync_certifications(null, null);
        $this->assertCount(2, $DB->get_records('enrol_programs_allocations', ['archived' => 1]));
        $this->assertCount(4, $DB->get_records('enrol_programs_allocations', ['archived' => 0]));
        $allocation1 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('0', $allocation1->archived);
        $this->assertSame((string)($now - DAYSECS), $allocation1->timestart);
        $this->assertSame(null, $allocation1->timedue);
        $this->assertSame(null, $allocation1->timeend);
        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertSame('0', $allocation2->archived);
        $this->assertSame((string)($now - WEEKSECS), $allocation2->timestart);
        $this->assertSame((string)($now - DAYSECS), $allocation2->timedue);
        $this->assertSame((string)($now + DAYSECS), $allocation2->timeend);
        $allocation4 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user4->id], '*', MUST_EXIST);
        $this->assertSame('1', $allocation4->archived);
        $allocation5 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user5->id], '*', MUST_EXIST);
        $this->assertSame('1', $allocation5->archived);
        $allocation6 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user6->id], '*', MUST_EXIST);
        $this->assertSame('0', $allocation6->archived);
        $allocation7 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user7->id], '*', MUST_EXIST);
        $this->assertSame('0', $allocation7->archived);
        $this->assertSame((string)($now - WEEKSECS), $allocation7->timestart);
        $this->assertSame(null, $allocation7->timedue);
        $this->assertSame(null, $allocation7->timeend);

        $period1 = $DB->get_record('tool_certify_periods',
            ['userid' => $user1->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation1->id, $period1->allocationid);
        $period2 = $DB->get_record('tool_certify_periods',
            ['userid' => $user2->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation2->id, $period2->allocationid);
        $period3 = $DB->get_record('tool_certify_periods',
            ['userid' => $user3->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame(null, $period3->allocationid);
        $period4 = $DB->get_record('tool_certify_periods',
            ['userid' => $user4->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation4->id, $period4->allocationid);
        $period5 = $DB->get_record('tool_certify_periods',
            ['userid' => $user5->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation5->id, $period5->allocationid);
        $period6 = $DB->get_record('tool_certify_periods',
            ['userid' => $user6->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation6->id, $period6->allocationid);
        $period7 = $DB->get_record('tool_certify_periods',
            ['userid' => $user7->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($allocation7->id, $period7->allocationid);
        $period8 = $DB->get_record('tool_certify_periods',
            ['userid' => $user8->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame(null, $period8->allocationid);
    }

    public function test_sync_certifications_update() {
        global $DB;
        /** @var \tool_certify_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('tool_certify');
        /** @var \enrol_programs_generator $programgenerator */
        $programgenerator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 0]);
        $program1source = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'certify']);

        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program1->id,
        ];
        $certification1 = $generator->create_certification($data);
        $source1 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification1->id], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $now = time();

        manual::assign_users($certification1->id, $source1->id, [$user1->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification1->id, $source1->id, [$user2->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => $now + DAYSECS,
            'timewindowend' => $now + WEEKSECS,
        ]);

        $allocation1 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $period1 = $DB->get_record('tool_certify_periods',
            ['userid' => $user1->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);

        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $period2 = $DB->get_record('tool_certify_periods',
            ['userid' => $user2->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);

        $allocation1->timedue = (string)($now + DAYSECS);
        $DB->update_record('enrol_programs_allocations', $allocation1);
        certify::sync_certifications(null, null);
        $allocation1 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame($period1->timewindowstart, $allocation1->timestart);
        $this->assertSame($period1->timewindowdue, $allocation1->timedue);
        $this->assertSame($period1->timewindowend, $allocation1->timeend);

        $allocation1->timeend = (string)($now + WEEKSECS);
        $DB->update_record('enrol_programs_allocations', $allocation1);
        certify::sync_certifications(null, null);
        $allocation1 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame($period1->timewindowstart, $allocation1->timestart);
        $this->assertSame($period1->timewindowdue, $allocation1->timedue);
        $this->assertSame($period1->timewindowend, $allocation1->timeend);

        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertSame($period2->timewindowstart, $allocation2->timestart);
        $this->assertSame($period2->timewindowdue, $allocation2->timedue);
        $this->assertSame($period2->timewindowend, $allocation2->timeend);

        $allocation2->timedue = (string)($now + DAYSECS);
        $DB->update_record('enrol_programs_allocations', $allocation2);
        certify::sync_certifications(null, null);
        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertSame($period2->timewindowstart, $allocation2->timestart);
        $this->assertSame($period2->timewindowdue, $allocation2->timedue);
        $this->assertSame($period2->timewindowend, $allocation2->timeend);

        $allocation2->timeend = (string)($now + WEEKSECS);
        $DB->update_record('enrol_programs_allocations', $allocation2);
        certify::sync_certifications(null, null);
        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertSame($period2->timewindowstart, $allocation2->timestart);
        $this->assertSame($period2->timewindowdue, $allocation2->timedue);
        $this->assertSame($period2->timewindowend, $allocation2->timeend);

        $allocation2->timedue = null;
        $DB->update_record('enrol_programs_allocations', $allocation2);
        certify::sync_certifications(null, null);
        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertSame($period2->timewindowstart, $allocation2->timestart);
        $this->assertSame($period2->timewindowdue, $allocation2->timedue);
        $this->assertSame($period2->timewindowend, $allocation2->timeend);

        $allocation2->timeend = null;
        $DB->update_record('enrol_programs_allocations', $allocation2);
        certify::sync_certifications(null, null);
        $allocation2 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertSame($period2->timewindowstart, $allocation2->timestart);
        $this->assertSame($period2->timewindowdue, $allocation2->timedue);
        $this->assertSame($period2->timewindowend, $allocation2->timeend);

        $allocation1 = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame($period1->timewindowstart, $allocation1->timestart);
        $this->assertSame($period1->timewindowdue, $allocation1->timedue);
        $this->assertSame($period1->timewindowend, $allocation1->timeend);

        $program1->archived = '1';
        $DB->update_record('enrol_programs_programs', $program1);
        $allocation1->timedue = (string)($now + DAYSECS);
        $allocation2->timedue = (string)($now + DAYSECS * 2);
        $allocation1->timeend = (string)($now + WEEKSECS);
        $DB->update_record('enrol_programs_allocations', $allocation1);
        certify::sync_certifications(null, null);
        $allocationx = $DB->get_record('enrol_programs_allocations', [
            'sourceid' => $program1source->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame($allocation1->timestart, $allocationx->timestart);
        $this->assertSame($allocation1->timedue, $allocationx->timedue);
        $this->assertSame($allocation1->timeend, $allocationx->timeend);
    }

    public function test_sync_certifications_complete() {
        global $DB;
        /** @var \tool_certify_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('tool_certify');
        /** @var \enrol_programs_generator $programgenerator */
        $programgenerator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 0]);
        $program1source = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'certify']);
        $top1 = program::load_content($program1->id);
        $program2 = $programgenerator->create_program(['sources' => 'certify', 'archived' => 0]);
        $program2source = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'certify']);
        $top2 = program::load_content($program2->id);

        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program1->id,
        ];
        $certification1 = $generator->create_certification($data);
        $source1 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $data = [
            'sources' => ['manual' => []],
            'programid1' => $program2->id,
        ];
        $certification2 = $generator->create_certification($data);
        $source2 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification2->id], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $user5 = $this->getDataGenerator()->create_user();
        $user6 = $this->getDataGenerator()->create_user();
        $user7 = $this->getDataGenerator()->create_user();
        $user8 = $this->getDataGenerator()->create_user();
        $user9 = $this->getDataGenerator()->create_user();

        $now = time();

        manual::assign_users($certification1->id, $source1->id, [$user1->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user2->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => $now - DAYSECS,
            'timewindowend' => null,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user3->id], [
            'timewindowstart' => $now - WEEKSECS,
            'timewindowdue' => null,
            'timewindowend' => $now + WEEKSECS,
        ]);

        manual::assign_users($certification1->id, $source1->id, [$user4->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $assignment4 = $DB->get_record('tool_certify_assignments',
            ['userid' => $user4->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $assignment4->archived = '1';
        $assignment4 = assignment::update_user($assignment4);

        manual::assign_users($certification1->id, $source1->id, [$user5->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $period5 = $DB->get_record('tool_certify_periods',
            ['userid' => $user5->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $period5 = period::override_dates((object)['id' => $period5->id, 'timerevoked' => $now]);

        manual::assign_users($certification1->id, $source1->id, [$user6->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
            'timefrom' => $now - WEEKSECS,
            'timeuntil' => $now + DAYSECS,
        ]);
        $period6 = $DB->get_record('tool_certify_periods',
            ['userid' => $user6->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $period6 = period::override_dates((object)['id' => $period6->id, 'timecertified' => $now - 30]);

        manual::assign_users($certification1->id, $source1->id, [$user7->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        $period7 = $DB->get_record('tool_certify_periods',
            ['userid' => $user7->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $period7 = period::override_dates((object)['id' => $period7->id, 'timewindowstart' => $now + WEEKSECS]);

        $this->assertCount(7, $DB->get_records('enrol_programs_allocations', []));
        $this->assertCount(7, $DB->get_records('tool_certify_periods', []));
        $this->assertCount(6, $DB->get_records('tool_certify_periods', ['timecertified' => null]));

        $DB->set_field('enrol_programs_allocations', 'timecompleted', ($now - 7), []);
        $this->setCurrentTimeStart();
        certify::sync_certifications(null, null);
        $this->assertCount(7, $DB->get_records('enrol_programs_allocations', []));
        $this->assertCount(7, $DB->get_records('tool_certify_periods', []));
        $this->assertCount(3, $DB->get_records('tool_certify_periods', ['timecertified' => null]));

        $period1 = $DB->get_record('tool_certify_periods',
            ['userid' => $user1->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($period1->timecertified);
        $period2 = $DB->get_record('tool_certify_periods',
            ['userid' => $user2->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($period2->timecertified);
        $period3 = $DB->get_record('tool_certify_periods',
            ['userid' => $user3->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($period3->timecertified);
        $period6 = $DB->get_record('tool_certify_periods',
            ['userid' => $user6->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame((string)($now - 30), $period6->timecertified);
    }

    public function test_sync_certifications_reset() {
        global $DB;
        /** @var \tool_certify_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('tool_certify');
        /** @var \enrol_programs_generator $programgenerator */
        $programgenerator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        /** @var \mod_forum_generator $forumgenerator */
        $forumgenerator = $this->getDataGenerator()->get_plugin_generator('mod_forum');
        $admin = get_admin();

        $now = time();

        $course = $this->getDataGenerator()->create_course();
        $enrol = $DB->get_record('enrol', ['courseid' => $course->id, 'enrol' => 'manual'], '*', MUST_EXIST);
        $forum = $this->getDataGenerator()->create_module('forum', ['course' => $course->id]);
        $discussion = $forumgenerator->create_discussion(['course' => $course->id, 'forum' => $forum->id, 'userid' => $admin->id]);

        $user0 = $this->getDataGenerator()->create_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $program = $programgenerator->create_program(['sources' => 'certify']);
        $programsource = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => 'certify']);
        $item = $programgenerator->create_program_item(['programid' => $program->id, 'courseid' => $course->id]);

        $this->getDataGenerator()->enrol_user($user0->id, $course->id);
        $mallocation0 = $programgenerator->create_program_allocation(['programid' => $program->id, 'userid' => $user0->id]);
        $post0 = $forumgenerator->create_post(['discussion' => $discussion->id, 'userid' => $user0->id]);

        $this->getDataGenerator()->enrol_user($user1->id, $course->id);
        $mallocation1 = $programgenerator->create_program_allocation(['programid' => $program->id, 'userid' => $user1->id]);
        $post1 = $forumgenerator->create_post(['discussion' => $discussion->id, 'userid' => $user1->id]);

        $this->getDataGenerator()->enrol_user($user2->id, $course->id);
        $mallocation2 = $programgenerator->create_program_allocation(['programid' => $program->id, 'userid' => $user2->id]);
        $post2 = $forumgenerator->create_post(['discussion' => $discussion->id, 'userid' => $user2->id]);

        $this->getDataGenerator()->enrol_user($user3->id, $course->id);
        $mallocation3 = $programgenerator->create_program_allocation(['programid' => $program->id, 'userid' => $user3->id]);
        $post3 = $forumgenerator->create_post(['discussion' => $discussion->id, 'userid' => $user3->id]);

        $certification0 = $generator->create_certification(
            ['sources' => ['manual' => []], 'programid1' => $program->id, 'periods_resettype1' => certification::RESETTYPE_NONE]);
        $source0 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification0->id], '*', MUST_EXIST);
        $certification1 = $generator->create_certification(
            ['sources' => ['manual' => []], 'programid1' => $program->id, 'periods_resettype1' => certification::RESETTYPE_DEALLOCATE]);
        $source1 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $certification2 = $generator->create_certification(
            ['sources' => ['manual' => []], 'programid1' => $program->id, 'periods_resettype1' => certification::RESETTYPE_UNENROL]);
        $source2 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification2->id], '*', MUST_EXIST);
        $certification3 = $generator->create_certification(
            ['sources' => ['manual' => []], 'programid1' => $program->id, 'periods_resettype1' => certification::RESETTYPE_PURGE]);
        $source3 = $DB->get_record('tool_certify_sources',
            ['type' => 'manual', 'certificationid' => $certification3->id], '*', MUST_EXIST);

        manual::assign_users($certification0->id, $source0->id, [$user0->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification1->id, $source1->id, [$user1->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification2->id, $source2->id, [$user2->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);
        manual::assign_users($certification3->id, $source3->id, [$user3->id], [
            'timewindowstart' => $now - DAYSECS,
            'timewindowdue' => null,
            'timewindowend' => null,
        ]);

        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['id' => $mallocation0->id]));
        $period0 = $DB->get_record('tool_certify_periods',
            ['userid' => $user0->id, 'certificationid' => $certification0->id], '*', MUST_EXIST);
        $this->assertSame('0', $period0->allocationid);
        $this->assertTrue($DB->record_exists('user_enrolments', ['enrolid' => $enrol->id, 'userid' => $user0->id]));
        $post = $DB->get_record('forum_posts', ['id' => $post0->id]);
        $this->assertSame($post0->subject, $post->subject);

        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['id' => $mallocation1->id]));
        $callocation1 = $DB->get_record('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program->id]);
        $this->assertSame($programsource->id, $callocation1->sourceid);
        $period1 = $DB->get_record('tool_certify_periods',
            ['userid' => $user1->id, 'certificationid' => $certification1->id], '*', MUST_EXIST);
        $this->assertSame($callocation1->id, $period1->allocationid);
        $this->assertTrue($DB->record_exists('user_enrolments', ['enrolid' => $enrol->id, 'userid' => $user1->id]));
        $post = $DB->get_record('forum_posts', ['id' => $post1->id]);
        $this->assertSame($post1->subject, $post->subject);

        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['id' => $mallocation2->id]));
        $callocation2 = $DB->get_record('enrol_programs_allocations', ['userid' => $user2->id, 'programid' => $program->id]);
        $this->assertSame($programsource->id, $callocation2->sourceid);
        $period2 = $DB->get_record('tool_certify_periods',
            ['userid' => $user2->id, 'certificationid' => $certification2->id], '*', MUST_EXIST);
        $this->assertSame($callocation2->id, $period2->allocationid);
        $this->assertFalse($DB->record_exists('user_enrolments', ['enrolid' => $enrol->id, 'userid' => $user2->id]));
        $post = $DB->get_record('forum_posts', ['id' => $post2->id]);
        $this->assertSame($post2->subject, $post->subject);

        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['id' => $mallocation3->id]));
        $callocation3 = $DB->get_record('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program->id]);
        $this->assertSame($programsource->id, $callocation3->sourceid);
        $period3 = $DB->get_record('tool_certify_periods',
            ['userid' => $user3->id, 'certificationid' => $certification3->id], '*', MUST_EXIST);
        $this->assertSame($callocation3->id, $period3->allocationid);
        $this->assertFalse($DB->record_exists('user_enrolments', ['enrolid' => $enrol->id, 'userid' => $user3->id]));
        $post = $DB->get_record('forum_posts', ['id' => $post3->id]);
        $this->assertSame('', $post->subject);
    }
}
