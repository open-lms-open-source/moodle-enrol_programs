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

use enrol_programs\local\program;
use enrol_programs\local\content\set;
use enrol_programs\local\allocation;
use enrol_programs\local\source\manual;

/**
 * Details tests for enrolment sequencing of a program.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\allocation::fix_enrol_instances();
 * @covers \enrol_programs\local\allocation::fix_user_enrolments();
 */
final class enrolments_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    /**
     * Test that sequencing works for all set types work.
     *
     * @return void
     */
    public function test_sequencing() {
        global $DB, $CFG;
        require_once("$CFG->libdir/completionlib.php");
        $CFG->enablecompletion = true;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context4 = \context_course::instance($course4->id);
        $course5 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context5 = \context_course::instance($course5->id);
        $course6 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context6 = \context_course::instance($course6->id);
        $course7 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context7 = \context_course::instance($course7->id);
        $course8 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context8 = \context_course::instance($course8->id);
        $course9 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context9 = \context_course::instance($course9->id);

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $top = program::load_content($program1->id);
        $top->update_set($top, '', set::SEQUENCE_TYPE_ALLINORDER);
        $set1 = $top->append_set($top, 'Optional set', set::SEQUENCE_TYPE_ATLEAST, 2);
        $item1x1 = $top->append_course($set1, $course1->id);
        $item1x2 = $top->append_course($set1, $course2->id);
        $item1x3 = $top->append_course($set1, $course3->id);
        $set2 = $top->append_set($top, 'Any order set', set::SEQUENCE_TYPE_ALLINANYORDER);
        $item2x1 = $top->append_course($set2, $course4->id);
        $item2x2 = $top->append_course($set2, $course5->id);
        $item3 = $top->append_course($top, $course6->id);
        $item4 = $top->append_course($top, $course7->id);

        $this->getDataGenerator()->enrol_user($user2->id, $course6->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course6->id, 'userid' => $user2->id]);
        $ccompletion->mark_complete();

        $this->getDataGenerator()->enrol_user($user3->id, $course1->id);
        $this->getDataGenerator()->enrol_user($user3->id, $course7->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course7->id, 'userid' => $user3->id]);
        $ccompletion->mark_complete();

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id, $user3->id]);
        $this->assertCount(24, $DB->get_records('user_enrolments', []));
        $this->assertCount(11, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE]));
        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));
        $this->assertFalse(is_enrolled($context4, $user1, '', true));
        $this->assertTrue(is_enrolled($context1, $user2, '', true));
        $this->assertTrue(is_enrolled($context2, $user2, '', true));
        $this->assertTrue(is_enrolled($context3, $user2, '', true));
        $this->assertTrue(is_enrolled($context3, $user2, '', true));
        $this->assertFalse(is_enrolled($context4, $user2, '', true));
        $this->assertFalse(is_enrolled($context6, $user2, '', true));
        $this->assertTrue(is_enrolled($context7, $user2, '', true));
        $this->assertTrue(is_enrolled($context1, $user3, '', true));
        $this->assertTrue(is_enrolled($context2, $user3, '', true));
        $this->assertTrue(is_enrolled($context3, $user3, '', true));
        $this->assertFalse(is_enrolled($context6, $user3, '', true));
        $this->assertFalse(is_enrolled($context7, $user3, '', true));

        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $allocation3 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user3->id], '*', MUST_EXIST);

        $ccompletion = new \completion_completion(['course' => $course3->id, 'userid' => $user1->id]);
        $ccompletion->mark_complete();
        $this->assertCount(3, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE, 'userid' => $user1->id]));
        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));

        allocation::update_item_completion((object)[
            'allocationid' => $allocation1->id,
            'itemid' => $item1x1->get_id(),
            'timecompleted' => time(),
            'evidencetimecompleted' => null,
        ]);
        $this->assertCount(5, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE, 'userid' => $user1->id]));
        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));
        $this->assertTrue(is_enrolled($context4, $user1, '', true));
        $this->assertTrue(is_enrolled($context5, $user1, '', true));

        allocation::update_item_completion((object)[
            'allocationid' => $allocation1->id,
            'itemid' => $item2x1->get_id(),
            'timecompleted' => null,
            'evidencetimecompleted' => time(),
            'evidencedetails' => '',
        ]);
        $this->assertCount(5, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE, 'userid' => $user1->id]));
        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));
        $this->assertTrue(is_enrolled($context4, $user1, '', true));
        $this->assertTrue(is_enrolled($context5, $user1, '', true));

        allocation::update_item_completion((object)[
            'allocationid' => $allocation1->id,
            'itemid' => $item2x2->get_id(),
            'timecompleted' => null,
            'evidencetimecompleted' => time(),
            'evidencedetails' => '',
        ]);
        $this->assertCount(6, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE, 'userid' => $user1->id]));
        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));
        $this->assertTrue(is_enrolled($context4, $user1, '', true));
        $this->assertTrue(is_enrolled($context5, $user1, '', true));
        $this->assertTrue(is_enrolled($context6, $user1, '', true));

        $ccompletion = new \completion_completion(['course' => $course6->id, 'userid' => $user1->id]);
        $ccompletion->mark_complete();
        $this->assertCount(7, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE, 'userid' => $user1->id]));
        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));
        $this->assertTrue(is_enrolled($context4, $user1, '', true));
        $this->assertTrue(is_enrolled($context5, $user1, '', true));
        $this->assertTrue(is_enrolled($context6, $user1, '', true));
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull($allocation1->timecompleted);

        $ccompletion = new \completion_completion(['course' => $course7->id, 'userid' => $user1->id]);
        $this->setCurrentTimeStart();
        $ccompletion->mark_complete();
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($allocation1->timecompleted);
    }

    public function test_before_start() {
        global $DB, $CFG;
        require_once("$CFG->libdir/completionlib.php");
        $CFG->enablecompletion = true;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context4 = \context_course::instance($course4->id);
        $course5 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context5 = \context_course::instance($course5->id);
        $course6 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context6 = \context_course::instance($course6->id);
        $course7 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context7 = \context_course::instance($course7->id);
        $course8 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context8 = \context_course::instance($course8->id);
        $course9 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context9 = \context_course::instance($course9->id);

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program1 = program::update_program_scheduling((object)[
            'id' => $program1->id,
            'programstart_type' => 'date',
            'programstart_date' => time() + 100,
            'programdue_type' => 'notset',
            'programend_type' => 'notset',
        ]);

        $top = program::load_content($program1->id);
        $top->update_set($top, '', set::SEQUENCE_TYPE_ALLINORDER);
        $set1 = $top->append_set($top, 'Optional set', set::SEQUENCE_TYPE_ATLEAST, 2);
        $item1x1 = $top->append_course($set1, $course1->id);
        $item1x2 = $top->append_course($set1, $course2->id);
        $item1x3 = $top->append_course($set1, $course3->id);
        $set2 = $top->append_set($top, 'Any order set', set::SEQUENCE_TYPE_ALLINANYORDER);
        $item2x1 = $top->append_course($set2, $course4->id);
        $item2x2 = $top->append_course($set2, $course5->id);
        $item3 = $top->append_course($top, $course6->id);
        $item4 = $top->append_course($top, $course7->id);

        $this->getDataGenerator()->enrol_user($user2->id, $course6->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course6->id, 'userid' => $user2->id]);
        $ccompletion->mark_complete();

        $this->getDataGenerator()->enrol_user($user3->id, $course1->id);
        $this->getDataGenerator()->enrol_user($user3->id, $course7->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course7->id, 'userid' => $user3->id]);
        $ccompletion->mark_complete();

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id, $user3->id]);
        $this->assertCount(24, $DB->get_records('user_enrolments', []));
        $this->assertCount(1, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE]));
        $this->assertCount(0, $DB->get_records('enrol_programs_completions'));
    }

    public function test_open() {
        global $DB, $CFG;
        require_once("$CFG->libdir/completionlib.php");
        $CFG->enablecompletion = true;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context4 = \context_course::instance($course4->id);
        $course5 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context5 = \context_course::instance($course5->id);
        $course6 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context6 = \context_course::instance($course6->id);
        $course7 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context7 = \context_course::instance($course7->id);
        $course8 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context8 = \context_course::instance($course8->id);
        $course9 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context9 = \context_course::instance($course9->id);

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program1 = program::update_program_scheduling((object)[
            'id' => $program1->id,
            'programstart_type' => 'date',
            'programstart_date' => time() - 100,
            'programdue_type' => 'notset',
            'programend_type' => 'date',
            'programend_date' => time() + 100,
        ]);

        $top = program::load_content($program1->id);
        $top->update_set($top, '', set::SEQUENCE_TYPE_ALLINORDER);
        $set1 = $top->append_set($top, 'Optional set', set::SEQUENCE_TYPE_ATLEAST, 2);
        $item1x1 = $top->append_course($set1, $course1->id);
        $item1x2 = $top->append_course($set1, $course2->id);
        $item1x3 = $top->append_course($set1, $course3->id);
        $set2 = $top->append_set($top, 'Any order set', set::SEQUENCE_TYPE_ALLINANYORDER);
        $item2x1 = $top->append_course($set2, $course4->id);
        $item2x2 = $top->append_course($set2, $course5->id);
        $item3 = $top->append_course($top, $course6->id);
        $item4 = $top->append_course($top, $course7->id);

        $this->getDataGenerator()->enrol_user($user2->id, $course6->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course6->id, 'userid' => $user2->id]);
        $ccompletion->mark_complete();

        $this->getDataGenerator()->enrol_user($user3->id, $course1->id);
        $this->getDataGenerator()->enrol_user($user3->id, $course7->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course7->id, 'userid' => $user3->id]);
        $ccompletion->mark_complete();

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id, $user3->id]);
        $this->assertCount(24, $DB->get_records('user_enrolments', []));
        $this->assertCount(11, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE]));
        $this->assertCount(2, $DB->get_records('enrol_programs_completions'));
    }

    public function test_after_end() {
        global $DB, $CFG;
        require_once("$CFG->libdir/completionlib.php");
        $CFG->enablecompletion = true;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context4 = \context_course::instance($course4->id);
        $course5 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context5 = \context_course::instance($course5->id);
        $course6 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context6 = \context_course::instance($course6->id);
        $course7 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context7 = \context_course::instance($course7->id);
        $course8 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context8 = \context_course::instance($course8->id);
        $course9 = $this->getDataGenerator()->create_course(['enablecompletion' => true]);
        $context9 = \context_course::instance($course9->id);

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program1 = program::update_program_scheduling((object)[
            'id' => $program1->id,
            'programstart_type' => 'date',
            'programstart_date' => time() - 200,
            'programdue_type' => 'notset',
            'programend_type' => 'date',
            'programend_date' => time() - 100,
        ]);

        $top = program::load_content($program1->id);
        $top->update_set($top, '', set::SEQUENCE_TYPE_ALLINORDER);
        $set1 = $top->append_set($top, 'Optional set', set::SEQUENCE_TYPE_ATLEAST, 2);
        $item1x1 = $top->append_course($set1, $course1->id);
        $item1x2 = $top->append_course($set1, $course2->id);
        $item1x3 = $top->append_course($set1, $course3->id);
        $set2 = $top->append_set($top, 'Any order set', set::SEQUENCE_TYPE_ALLINANYORDER);
        $item2x1 = $top->append_course($set2, $course4->id);
        $item2x2 = $top->append_course($set2, $course5->id);
        $item3 = $top->append_course($top, $course6->id);
        $item4 = $top->append_course($top, $course7->id);

        $this->getDataGenerator()->enrol_user($user2->id, $course6->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course6->id, 'userid' => $user2->id]);
        $ccompletion->mark_complete();

        $this->getDataGenerator()->enrol_user($user3->id, $course1->id);
        $this->getDataGenerator()->enrol_user($user3->id, $course7->id, null, 'manual', 0, 0, ENROL_USER_SUSPENDED);
        $ccompletion = new \completion_completion(['course' => $course7->id, 'userid' => $user3->id]);
        $ccompletion->mark_complete();

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id, $user3->id]);
        $this->assertCount(24, $DB->get_records('user_enrolments', []));
        $this->assertCount(1, $DB->get_records('user_enrolments', ['status' => ENROL_USER_ACTIVE]));
        $this->assertCount(0, $DB->get_records('enrol_programs_completions'));
    }
}
