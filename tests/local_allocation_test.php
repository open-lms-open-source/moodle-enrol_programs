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

use enrol_programs\local\allocation;
use enrol_programs\local\program;

/**
 * Program allocation helper test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\allocation
 */
final class local_allocation_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_get_source_classes() {
        $classes = allocation::get_source_classes();
        $this->assertIsArray($classes);
        foreach ($classes as $type => $classname) {
            $this->assertTrue(class_exists($classname));
        }
        $this->assertArrayHasKey('manual', $classes);
        $this->assertArrayHasKey('cohort', $classes);
        $this->assertArrayHasKey('approval', $classes);
        $this->assertArrayHasKey('selfallocation', $classes);
        $this->assertArrayNotHasKey('base', $classes);
    }

    public function test_get_source_names() {
        $sources = allocation::get_source_names();
        $this->assertIsArray($sources);
        foreach ($sources as $type => $name) {
            $this->assertIsString($name);
        }
        $this->assertArrayHasKey('manual', $sources);
        $this->assertArrayHasKey('cohort', $sources);
        $this->assertArrayHasKey('approval', $sources);
        $this->assertArrayHasKey('selfallocation', $sources);
        $this->assertArrayNotHasKey('base', $sources);
    }

    public function test_fix_enrol_instances() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();
        $course4 = $this->getDataGenerator()->create_course();

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['idnumber' => 'pokus', 'archived' => 1]);

        $top1 = program::load_content($program1->id);
        $item1 = $top1->append_course($top1, $course1->id);
        $item2 = $top1->append_course($top1, $course2->id);
        $item3 = $top1->append_course($top1, $course3->id);

        $top2 = program::load_content($program2->id);
        $item2 = $top2->append_course($top2, $course1->id);

        $instance1x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x2 = $DB->get_record('enrol', ['courseid' => $course2->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x3 = $DB->get_record('enrol', ['courseid' => $course3->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance2x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program2->id], '*', MUST_EXIST);
        $this->assertEquals(ENROL_INSTANCE_ENABLED, $instance1x1->status);
        $this->assertEquals(ENROL_INSTANCE_ENABLED, $instance1x2->status);
        $this->assertEquals(ENROL_INSTANCE_ENABLED, $instance1x3->status);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance2x1->status);

        $DB->set_field('enrol_programs_programs', 'archived', 1, ['id' => $program1->id]);
        $DB->set_field('enrol_programs_programs', 'archived', 0, ['id' => $program2->id]);
        $DB->delete_records('enrol', ['id' => $instance1x1->id]);

        allocation::fix_enrol_instances($program1->id);

        $instance1x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x2 = $DB->get_record('enrol', ['courseid' => $course2->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x3 = $DB->get_record('enrol', ['courseid' => $course3->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance2x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program2->id], '*', MUST_EXIST);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x1->status);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x2->status);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x3->status);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance2x1->status);

        allocation::fix_enrol_instances(null);

        $instance1x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x2 = $DB->get_record('enrol', ['courseid' => $course2->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x3 = $DB->get_record('enrol', ['courseid' => $course3->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance2x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program2->id], '*', MUST_EXIST);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x1->status);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x2->status);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x3->status);
        $this->assertEquals(ENROL_INSTANCE_ENABLED, $instance2x1->status);

        delete_course($course1->id, false);
        allocation::fix_enrol_instances(null);
        $instance1x2 = $DB->get_record('enrol', ['courseid' => $course2->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x3 = $DB->get_record('enrol', ['courseid' => $course3->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x2->status);
        $this->assertEquals(ENROL_INSTANCE_DISABLED, $instance1x3->status);
    }

    public function test_fix_user_enrolments() {
        global $DB, $USER;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course();
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course();
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course();
        $context4 = \context_course::instance($course4->id);

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program2 = $generator->create_program(['idnumber' => 'pokus', 'sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $top1 = program::load_content($program1->id);
        $item1x1 = $top1->append_course($top1, $course1->id);
        $item1x2 = $top1->append_course($top1, $course2->id);
        $item1x3 = $top1->append_course($top1, $course3->id);

        $top2 = program::load_content($program2->id);
        $item2x1 = $top2->append_course($top2, $course1->id);

        $instance1x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x2 = $DB->get_record('enrol', ['courseid' => $course2->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x3 = $DB->get_record('enrol', ['courseid' => $course3->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance2x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program2->id], '*', MUST_EXIST);

        // Method fix_user_enrolments is called during allocation, confirm the everything was added.
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);

        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));
        $this->assertTrue(is_enrolled($context1, $user2, '', true));
        $this->assertTrue(is_enrolled($context2, $user2, '', true));
        $this->assertTrue(is_enrolled($context3, $user2, '', true));

        // Hack DB to similate removal of allocation.
        $allocation1x1x1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->delete_records('enrol_programs_completions', ['allocationid' => $allocation1x1x1->id]);
        $DB->delete_records('enrol_programs_allocations', ['id' => $allocation1x1x1->id]);
        unset($USER->enrol);
        allocation::fix_user_enrolments(null, null);

        $this->assertFalse(is_enrolled($context1, $user1, '', false));
        $this->assertFalse(is_enrolled($context2, $user1, '', false));
        $this->assertFalse(is_enrolled($context3, $user1, '', false));
        $this->assertTrue(is_enrolled($context1, $user2, '', true));
        $this->assertTrue(is_enrolled($context2, $user2, '', true));
        $this->assertTrue(is_enrolled($context3, $user2, '', true));

        // Put the allocation back and see if it gets fixed.
        unset($allocation1x1x1->id);
        $DB->insert_record('enrol_programs_allocations', $allocation1x1x1);
        unset($USER->enrol);
        allocation::fix_user_enrolments(null, null);

        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));
        $this->assertTrue(is_enrolled($context1, $user2, '', true));
        $this->assertTrue(is_enrolled($context2, $user2, '', true));
        $this->assertTrue(is_enrolled($context3, $user2, '', true));

        // Archived allocations should be ignored, do not add new enrolments.
        $allocation1x1x1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $allocation1x1x1->archived = 1;
        $DB->update_record('enrol_programs_allocations', $allocation1x1x1);
        $item1x4 = $top1->append_course($top1, $course4->id);

        $this->assertTrue(is_enrolled($context1, $user1, '', false));
        $this->assertTrue(is_enrolled($context2, $user1, '', false));
        $this->assertTrue(is_enrolled($context3, $user1, '', false));
        $this->assertFalse(is_enrolled($context4, $user1, '', false));
        $this->assertTrue(is_enrolled($context1, $user2, '', true));
        $this->assertTrue(is_enrolled($context2, $user2, '', true));
        $this->assertTrue(is_enrolled($context3, $user2, '', true));
        $this->assertTrue(is_enrolled($context4, $user2, '', true));

        // NOTE: we should add lots more tests here, for now we will rely on behat.
    }

    public function test_fix_enrolments() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course();
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course();
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course();
        $context4 = \context_course::instance($course4->id);

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program2 = $generator->create_program(['idnumber' => 'pokus', 'sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $top1 = program::load_content($program1->id);
        $item1x1 = $top1->append_course($top1, $course1->id);
        $item1x2 = $top1->append_course($top1, $course2->id);
        $item1x3 = $top1->append_course($top1, $course3->id);

        $top2 = program::load_content($program2->id);
        $item2x1 = $top2->append_course($top2, $course1->id);

        $instance1x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x2 = $DB->get_record('enrol', ['courseid' => $course2->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x3 = $DB->get_record('enrol', ['courseid' => $course3->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance2x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program2->id], '*', MUST_EXIST);

        // Method fix_user_enrolments is called during allocation, confirm the everything was added.
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);

        // Just make sure there are no errors.
        allocation::fix_enrol_instances(null);
        allocation::fix_user_enrolments(null, null);

        allocation::fix_enrol_instances($program1->id);
        allocation::fix_user_enrolments($program1->id, null);
    }

    public function test_fix_allocation_sources() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course();
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course();
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course();
        $context4 = \context_course::instance($course4->id);

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program2 = $generator->create_program(['idnumber' => 'pokus', 'sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $top1 = program::load_content($program1->id);
        $item1x1 = $top1->append_course($top1, $course1->id);
        $item1x2 = $top1->append_course($top1, $course2->id);
        $item1x3 = $top1->append_course($top1, $course3->id);

        $top2 = program::load_content($program2->id);
        $item2x1 = $top2->append_course($top2, $course1->id);

        $instance1x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x2 = $DB->get_record('enrol', ['courseid' => $course2->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance1x3 = $DB->get_record('enrol', ['courseid' => $course3->id, 'enrol' => 'programs', 'customint1' => $program1->id], '*', MUST_EXIST);
        $instance2x1 = $DB->get_record('enrol', ['courseid' => $course1->id, 'enrol' => 'programs', 'customint1' => $program2->id], '*', MUST_EXIST);

        // Method fix_user_enrolments is called during allocation, confirm the everything was added.
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);

        // Just make sure there are no errors.
        allocation::fix_allocation_sources(null, null);
        allocation::fix_allocation_sources($program1->id, null);
        allocation::fix_allocation_sources(null, $user1->id);
        allocation::fix_allocation_sources($program1->id, $user1->id);
    }

    public function test_update_user() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $now = time();

        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 12);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $result = allocation::update_user($allocation);
        $this->assertSame((array)$result, (array)$allocation);

        $newallocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame((array)$allocation, (array)$newallocation);

        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 12);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        allocation::update_user($allocation);
        $newallocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame((array)$allocation, (array)$newallocation);
    }

    public function test_update_item_completion() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $top1 = program::load_content($program1->id);
        $item1 = $top1->append_course($top1, $course1->id);

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 3);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Open', allocation::get_completion_status_plain($program1, $allocation));

        $data = (object)[
            'allocationid' => $allocation->id,
            'timecompleted' => (string)($now - 60 * 60 * 1),
            'itemid' => $item1->get_id(),
            'evidencetimecompleted' => null,
        ];
        allocation::update_item_completion($data);
        $itemcompletion = $DB->get_record('enrol_programs_completions', ['allocationid' => $allocation->id, 'itemid' => $item1->get_id()]);
        $this->assertSame($data->timecompleted, $itemcompletion->timecompleted);
        $evidencecompletion = $DB->get_record('enrol_programs_evidences', ['userid' => $allocation->userid, 'itemid' => $item1->get_id()]);
        $this->assertSame(false, $evidencecompletion);

        $data = (object)[
            'allocationid' => $allocation->id,
            'timecompleted' => $itemcompletion->timecompleted,
            'itemid' => $item1->get_id(),
            'evidencetimecompleted' => (string)($now - 60 * 60 * 2),
            'evidencedetails' => 'hmmm',
        ];
        allocation::update_item_completion($data);
        $itemcompletion = $DB->get_record('enrol_programs_completions', ['allocationid' => $allocation->id, 'itemid' => $item1->get_id()]);
        $this->assertSame($data->timecompleted, $itemcompletion->timecompleted);
        $evidencecompletion = $DB->get_record('enrol_programs_evidences', ['userid' => $allocation->userid, 'itemid' => $item1->get_id()]);
        $this->assertSame($data->evidencetimecompleted, $evidencecompletion->timecompleted);

        $data = (object)[
            'allocationid' => $allocation->id,
            'timecompleted' => (string)($now - 60 * 60 * 1),
            'itemid' => $item1->get_id(),
            'evidencetimecompleted' => null,
        ];
        allocation::update_item_completion($data);
        $itemcompletion = $DB->get_record('enrol_programs_completions', ['allocationid' => $allocation->id, 'itemid' => $item1->get_id()]);
        $this->assertSame($data->timecompleted, $itemcompletion->timecompleted);
        $evidencecompletion = $DB->get_record('enrol_programs_evidences', ['userid' => $allocation->userid, 'itemid' => $item1->get_id()]);
        $this->assertSame(false, $evidencecompletion);

        $data = (object)[
            'allocationid' => $allocation->id,
            'timecompleted' => null,
            'itemid' => $item1->get_id(),
            'evidencetimecompleted' => null,
        ];
        allocation::update_item_completion($data);
        $itemcompletion = $DB->get_record('enrol_programs_completions', ['allocationid' => $allocation->id, 'itemid' => $item1->get_id()]);
        $this->assertSame(false, $itemcompletion);
        $evidencecompletion = $DB->get_record('enrol_programs_evidences', ['userid' => $allocation->userid, 'itemid' => $item1->get_id()]);
        $this->assertSame(false, $evidencecompletion);
    }

    public function test_get_completion_status_plain() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now + 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Not open yet', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Open', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 1);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Overdue', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 5);
        $allocation->timeend = (string)($now - 60 * 60 * 1);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Failed', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now - 60 * 60 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Completed', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now + 60 * 60 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Completed', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now + 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Archived', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Archived', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 1);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Archived', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 5);
        $allocation->timeend = (string)($now - 60 * 60 * 1);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Archived', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now - 60 * 60 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Archived completed', allocation::get_completion_status_plain($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now - 60 * 60 * 1);
        allocation::update_user($allocation);
        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 1]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertSame('Archived completed', allocation::get_completion_status_plain($program1, $allocation));
    }

    public function test_get_completion_status_html() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now + 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Not open yet', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Open', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 1);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Overdue', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 5);
        $allocation->timeend = (string)($now - 60 * 60 * 1);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Failed', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now - 60 * 60 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Completed', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now + 60 * 60 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Completed', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now + 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Archived', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Archived', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 1);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Archived', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 10);
        $allocation->timedue = (string)($now - 60 * 60 * 5);
        $allocation->timeend = (string)($now - 60 * 60 * 1);
        $allocation->timecompleted = null;
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Archived', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '1';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now - 60 * 60 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Archived completed', allocation::get_completion_status_html($program1, $allocation));

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 20);
        $allocation->timecompleted = (string)($now - 60 * 60 * 1);
        allocation::update_user($allocation);
        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 1]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertStringContainsString('Archived completed', allocation::get_completion_status_html($program1, $allocation));
    }

    public function test_deleted_user_cleanup() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $top1 = program::load_content($program1->id);
        $item1 = $top1->append_course($top1, $course1->id);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);

        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);

        $data = (object)[
            'allocationid' => $allocation1->id,
            'timecompleted' => time(),
            'itemid' => $item1->get_id(),
            'evidencetimecompleted' => null,
        ];
        allocation::update_item_completion($data);

        $data = (object)[
            'allocationid' => $allocation2->id,
            'timecompleted' => time(),
            'itemid' => $item1->get_id(),
            'evidencetimecompleted' => null,
        ];
        allocation::update_item_completion($data);

        $sink = $this->redirectEvents();
        delete_user($user1);
        $sink->close();

        allocation::deleted_user_cleanup($user1->id);

        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id]));
        $this->assertFalse($DB->record_exists('enrol_programs_completions', ['allocationid' => $allocation1->id, 'itemid' => $item1->get_id()]));

        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_completions', ['allocationid' => $allocation2->id, 'itemid' => $item1->get_id()]));
    }

    public function test_make_snapshot() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $top1 = program::load_content($program1->id);
        $item1 = $top1->append_course($top1, $course1->id);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);

        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);

        $data = (object)[
            'allocationid' => $allocation1->id,
            'timecompleted' => time(),
            'itemid' => $item1->get_id(),
            'evidencetimecompleted' => null,
        ];
        allocation::update_item_completion($data);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $DB->delete_records('enrol_programs_usr_snapshots', []);

        $admin = get_admin();
        $this->setAdminUser();
        $this->setCurrentTimeStart();
        $result = allocation::make_snapshot($allocation1->id, 'some_reason', 'some explanation');
        $this->assertSame((array)$allocation1, (array)$result);
        $record = $DB->get_record('enrol_programs_usr_snapshots', ['allocationid' => $allocation1->id]);
        $this->assertSame($allocation1->id, $record->allocationid);
        $this->assertSame('some_reason', $record->reason);
        $this->assertTimeCurrent($record->timesnapshot);
        $this->assertSame($admin->id, $record->snapshotby);
        $this->assertSame('some explanation', $record->explanation);
    }
}
