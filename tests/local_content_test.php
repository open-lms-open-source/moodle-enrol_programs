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

use enrol_programs\local\content\top;
use enrol_programs\local\content\course;
use enrol_programs\local\content\set;

/**
 * Program content test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\content\top
 * @covers \enrol_programs\local\content\course
 * @covers \enrol_programs\local\content\set
 * @covers \enrol_programs\local\content\item
 */
final class local_content_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_load() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['fullname' => 'pokus']);

        $top = top::load($program1->id);
        $this->assertInstanceOf(top::class, $top);
        $this->assertSame((int)$program1->id, $top->get_programid());
        $this->assertSame($program1->fullname, $top->get_fullname());
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertSame([], $top->get_children());
        $this->assertSame([], $top->get_orphaned_sets());
        $this->assertSame([], $top->get_orphaned_courses());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINANYORDER, $top->get_sequencetype());
        $this->assertSame('All in any order', $top->get_sequencetype_info());
        $this->assertSame(1, $top->get_minprerequisites());
    }

    public function test_append_items() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['fullname' => 'pokus']);

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();
        $course4 = $this->getDataGenerator()->create_course();
        $course5 = $this->getDataGenerator()->create_course();

        $top2 = top::load($program2->id);
        $top2->append_course($top2, $course1->id);

        $top = top::load($program1->id);
        $top->append_course($top, $course1->id);
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(1, $top->get_children());
        $this->assertSame([], $top->get_orphaned_sets());
        $this->assertSame([], $top->get_orphaned_courses());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINANYORDER, $top->get_sequencetype());
        $this->assertSame('All in any order', $top->get_sequencetype_info());
        $this->assertSame(1, $top->get_minprerequisites());
        /** @var course $courseitem1 */
        $courseitem1 = $top->get_children()[0];
        $this->assertInstanceOf(course::class, $courseitem1);
        $this->assertSame((int)$program1->id, $courseitem1->get_programid());
        $this->assertSame($course1->fullname, $courseitem1->get_fullname());
        $this->assertSame(false, $courseitem1->is_problem_detected());
        $this->assertSame([], $courseitem1->get_children());
        $this->assertSame((int)$course1->id, $courseitem1->get_courseid());
        $this->assertSame(null, $courseitem1->get_previous());

        $top = top::load($program1->id);
        $this->assertSame(false, $top->is_problem_detected());

        $top->append_set($top, 'Nice set', set::SEQUENCE_TYPE_ALLINORDER);
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(2, $top->get_children());
        $this->assertSame([], $top->get_orphaned_sets());
        $this->assertSame([], $top->get_orphaned_courses());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINANYORDER, $top->get_sequencetype());
        $this->assertSame(2, $top->get_minprerequisites());
        /** @var set $setitem1 */
        $setitem1 = $top->get_children()[1];
        $this->assertInstanceOf(set::class, $setitem1);
        $this->assertSame((int)$program1->id, $setitem1->get_programid());
        $this->assertSame('Nice set', $setitem1->get_fullname());
        $this->assertSame(false, $setitem1->is_problem_detected());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINORDER, $setitem1->get_sequencetype());
        $this->assertSame('All in order', $setitem1->get_sequencetype_info());
        $this->assertSame(1, $setitem1->get_minprerequisites());
        $this->assertSame([], $setitem1->get_children());

        $top->append_course($setitem1, $course2->id);
        $top->append_course($setitem1, $course3->id);
        $this->assertCount(2, $setitem1->get_children());
        $this->assertSame(2, $setitem1->get_minprerequisites());
        /** @var course $courseitem2 */
        $courseitem2 = $setitem1->get_children()[0];
        $this->assertSame(null, $courseitem2->get_previous());
        /** @var course $courseitem3 */
        $courseitem3 = $setitem1->get_children()[1];
        $this->assertSame($courseitem2, $courseitem3->get_previous());

        $top = top::load($program1->id);
        $this->assertSame(false, $top->is_problem_detected());

        $top->append_set($top, 'Other set', set::SEQUENCE_TYPE_ATLEAST, 2);
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(3, $top->get_children());
        $this->assertSame([], $top->get_orphaned_sets());
        $this->assertSame([], $top->get_orphaned_courses());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINANYORDER, $top->get_sequencetype());
        $this->assertSame(3, $top->get_minprerequisites());
        /** @var set $setitem2 */
        $setitem2 = $top->get_children()[2];
        $this->assertInstanceOf(set::class, $setitem2);
        $this->assertSame((int)$program1->id, $setitem2->get_programid());
        $this->assertSame('Other set', $setitem2->get_fullname());
        $this->assertSame(false, $setitem2->is_problem_detected());
        $this->assertSame(set::SEQUENCE_TYPE_ATLEAST, $setitem2->get_sequencetype());
        $this->assertSame('At least 2', $setitem2->get_sequencetype_info());
        $this->assertSame(2, $setitem2->get_minprerequisites());
        $this->assertSame([], $setitem2->get_children());

        $top->append_course($setitem2, $course4->id);
        $top->append_course($setitem2, $course5->id);
        $this->assertCount(2, $setitem2->get_children());
        $this->assertSame(2, $setitem2->get_minprerequisites());
        /** @var course $courseitem2 */
        $courseitem2 = $setitem2->get_children()[0];
        $this->assertSame(null, $courseitem2->get_previous());
        /** @var course $courseitem3 */
        $courseitem3 = $setitem2->get_children()[1];
        $this->assertSame(null, $courseitem3->get_previous());

        $top = top::load($program1->id);
        $this->assertSame(false, $top->is_problem_detected());

        $top2 = top::load($program2->id);
        $this->assertSame(false, $top2->is_problem_detected());
        $this->assertCount(1, $top2->get_children());
        $this->assertSame([], $top2->get_orphaned_sets());
        $this->assertSame([], $top2->get_orphaned_courses());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINANYORDER, $top2->get_sequencetype());
        $this->assertSame('All in any order', $top2->get_sequencetype_info());
        $this->assertSame(1, $top2->get_minprerequisites());
        /** @var course $courseitem1 */
        $courseitem1 = $top2->get_children()[0];
        $this->assertInstanceOf(course::class, $courseitem1);
        $this->assertSame((int)$program2->id, $courseitem1->get_programid());
        $this->assertSame($course1->fullname, $courseitem1->get_fullname());
        $this->assertSame(false, $courseitem1->is_problem_detected());
        $this->assertSame([], $courseitem1->get_children());
        $this->assertSame((int)$course1->id, $courseitem1->get_courseid());
        $this->assertSame(null, $courseitem1->get_previous());
    }

    public function test_update_set() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['fullname' => 'pokus']);

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();
        $course4 = $this->getDataGenerator()->create_course();
        $course5 = $this->getDataGenerator()->create_course();

        $top = top::load($program1->id);
        $top->append_course($top, $course1->id);
        $top->append_set($top, 'Nice set', set::SEQUENCE_TYPE_ALLINORDER);
        $top->append_set($top, 'Other set', set::SEQUENCE_TYPE_ATLEAST, 2);
        /** @var set $setitem1 */
        $setitem1 = $top->get_children()[1];
        $top->append_course($setitem1, $course2->id);
        $top->append_course($setitem1, $course3->id);
        /** @var set $setitem2 */
        $setitem2 = $top->get_children()[2];
        $top->append_course($setitem2, $course4->id);
        $top->append_course($setitem2, $course5->id);

        $top = top::load($program1->id);
        $this->assertSame(false, $top->is_problem_detected());

        $top->update_set($top, 'ignored', set::SEQUENCE_TYPE_ALLINORDER, 10);
        $this->assertFalse(top::load($program1->id)->is_problem_detected());
        $this->assertSame((int)$program1->id, $top->get_programid());
        $this->assertSame($program1->fullname, $top->get_fullname());
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(3, $top->get_children());
        $this->assertSame([], $top->get_orphaned_sets());
        $this->assertSame([], $top->get_orphaned_courses());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINORDER, $top->get_sequencetype());
        $this->assertSame('All in order', $top->get_sequencetype_info());
        $this->assertSame(3, $top->get_minprerequisites());
        /** @var set $setitem1 */
        $setitem1 = $top->get_children()[1];
        $this->assertInstanceOf(set::class, $setitem1);
        $this->assertSame(set::SEQUENCE_TYPE_ALLINORDER, $setitem1->get_sequencetype());
        $this->assertSame(2, $setitem1->get_minprerequisites());
        /** @var course $courseitem1 */
        $courseitem1 = $top->get_children()[0];
        $this->assertSame(null, $courseitem1->get_previous());
        /** @var course $courseitem2 */
        $courseitem2 = $setitem1->get_children()[0];
        $this->assertSame($courseitem1, $courseitem2->get_previous());
        /** @var course $courseitem3 */
        $courseitem3 = $setitem1->get_children()[1];
        $this->assertSame($courseitem2, $courseitem3->get_previous());

        $top->update_set($top, 'ignored', set::SEQUENCE_TYPE_ATLEAST, 2);
        $this->assertFalse(top::load($program1->id)->is_problem_detected());
        $this->assertSame((int)$program1->id, $top->get_programid());
        $this->assertSame($program1->fullname, $top->get_fullname());
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(3, $top->get_children());
        $this->assertSame([], $top->get_orphaned_sets());
        $this->assertSame([], $top->get_orphaned_courses());
        $this->assertSame(set::SEQUENCE_TYPE_ATLEAST, $top->get_sequencetype());
        $this->assertSame('At least 2', $top->get_sequencetype_info());
        $this->assertSame(2, $top->get_minprerequisites());
        $this->assertSame(null, $courseitem1->get_previous());
        $this->assertSame(null, $courseitem2->get_previous());
        $this->assertSame($courseitem2, $courseitem3->get_previous());

        $top->update_set($setitem1, 'Very nice set', set::SEQUENCE_TYPE_ALLINANYORDER, 10);
        $this->assertFalse(top::load($program1->id)->is_problem_detected());
        $this->assertSame((int)$program1->id, $setitem1->get_programid());
        $this->assertSame('Very nice set', $setitem1->get_fullname());
        $this->assertSame(false, $setitem1->is_problem_detected());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINANYORDER, $setitem1->get_sequencetype());
        $this->assertSame('All in any order', $setitem1->get_sequencetype_info());
        $this->assertSame(2, $setitem1->get_minprerequisites());
        $this->assertCount(2, $setitem1->get_children());
        $this->assertSame(null, $courseitem1->get_previous());
        $this->assertSame(null, $courseitem2->get_previous());
        $this->assertSame(null, $courseitem3->get_previous());
    }

    public function test_move_item() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['fullname' => 'pokus']);

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();
        $course4 = $this->getDataGenerator()->create_course();
        $course5 = $this->getDataGenerator()->create_course();

        $top = top::load($program1->id);
        $top->append_course($top, $course1->id);
        /** @var course $courseitem1 */
        $courseitem1 = $top->get_children()[0];
        $top->append_set($top, 'Nice set', set::SEQUENCE_TYPE_ALLINORDER);
        /** @var set $setitem1 */
        $setitem1 = $top->get_children()[1];
        $top->append_set($top, 'Other set', set::SEQUENCE_TYPE_ATLEAST, 2);
        /** @var set $setitem2 */
        $setitem2 = $top->get_children()[2];
        $top->append_set($top, 'Third set', set::SEQUENCE_TYPE_ALLINANYORDER);
        /** @var set $setitem3 */
        $setitem3 = $top->get_children()[3];
        $top->append_course($setitem1, $course2->id);
        /** @var course $courseitem2 */
        $courseitem2 = $setitem1->get_children()[0];
        $top->append_course($setitem1, $course3->id);
        /** @var course $courseitem3 */
        $courseitem3 = $setitem1->get_children()[1];
        $top->append_course($setitem1, $course4->id);
        /** @var course $courseitem4 */
        $courseitem4 = $setitem1->get_children()[2];
        $top->append_course($setitem1, $course5->id);
        /** @var course $courseitem5 */
        $courseitem5 = $setitem1->get_children()[3];
        $this->assertSame(false, $top->is_problem_detected());

        $this->assertTrue($top->move_item($courseitem3->get_id(), $setitem1->get_id(), 1));
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(4, $setitem1->get_children());
        $this->assertSame($courseitem2, $setitem1->get_children()[0]);
        $this->assertSame($courseitem3, $setitem1->get_children()[1]);
        $this->assertSame($courseitem4, $setitem1->get_children()[2]);
        $this->assertSame($courseitem5, $setitem1->get_children()[3]);

        $this->assertTrue($top->move_item($courseitem3->get_id(), $setitem1->get_id(), 0));
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(4, $setitem1->get_children());
        $this->assertSame($courseitem3, $setitem1->get_children()[0]);
        $this->assertSame($courseitem2, $setitem1->get_children()[1]);
        $this->assertSame($courseitem4, $setitem1->get_children()[2]);
        $this->assertSame($courseitem5, $setitem1->get_children()[3]);

        $this->assertTrue($top->move_item($courseitem3->get_id(), $setitem1->get_id(), 10));
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(4, $setitem1->get_children());
        $this->assertSame($courseitem2, $setitem1->get_children()[0]);
        $this->assertSame($courseitem4, $setitem1->get_children()[1]);
        $this->assertSame($courseitem5, $setitem1->get_children()[2]);
        $this->assertSame($courseitem3, $setitem1->get_children()[3]);

        $this->assertTrue($top->move_item($courseitem3->get_id(), $setitem1->get_id(), 1));
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(4, $setitem1->get_children());
        $this->assertSame($courseitem2, $setitem1->get_children()[0]);
        $this->assertSame($courseitem3, $setitem1->get_children()[1]);
        $this->assertSame($courseitem4, $setitem1->get_children()[2]);
        $this->assertSame($courseitem5, $setitem1->get_children()[3]);

        $this->assertCount(4, $top->get_children());
        $this->assertTrue($top->move_item($courseitem1->get_id(), $setitem1->get_id(), 1));
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(3, $top->get_children());
        $this->assertCount(5, $setitem1->get_children());
        $this->assertSame($courseitem2, $setitem1->get_children()[0]);
        $this->assertSame($courseitem1, $setitem1->get_children()[1]);
        $this->assertSame($courseitem3, $setitem1->get_children()[2]);
        $this->assertSame($courseitem4, $setitem1->get_children()[3]);
        $this->assertSame($courseitem5, $setitem1->get_children()[4]);

        $this->assertTrue($top->move_item($courseitem1->get_id(), $setitem3->get_id(), 0));
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(1, $setitem3->get_children());
        $this->assertSame($courseitem1, $setitem3->get_children()[0]);
        $this->assertCount(4, $setitem1->get_children());
        $this->assertSame($courseitem2, $setitem1->get_children()[0]);
        $this->assertSame($courseitem3, $setitem1->get_children()[1]);
        $this->assertSame($courseitem4, $setitem1->get_children()[2]);
        $this->assertSame($courseitem5, $setitem1->get_children()[3]);

        $this->assertTrue($top->move_item($setitem3->get_id(), $setitem1->get_id(), 2));
        $this->assertSame(false, $top->is_problem_detected());
        $this->assertCount(1, $setitem3->get_children());
        $this->assertSame($courseitem1, $setitem3->get_children()[0]);
        $this->assertCount(5, $setitem1->get_children());
        $this->assertSame($courseitem2, $setitem1->get_children()[0]);
        $this->assertSame($courseitem3, $setitem1->get_children()[1]);
        $this->assertSame($setitem3, $setitem1->get_children()[2]);
        $this->assertSame($courseitem4, $setitem1->get_children()[3]);
        $this->assertSame($courseitem5, $setitem1->get_children()[4]);

        // Test all invalid operations.
        $this->assertDebuggingNotCalled();

        $this->assertFalse($top->move_item($top->get_id(), $setitem1->get_id(), 0));
        $this->assertDebuggingCalled('Top item cannot be moved');

        $this->assertFalse($top->move_item($setitem1->get_id(), $setitem1->get_id(), 0));
        $this->assertDebuggingCalled('Item cannot be moved to self');

        $this->assertFalse($top->move_item(-1, $setitem1->get_id(), 0));
        $this->assertDebuggingCalled('Cannot find new item');

        $this->assertFalse($top->move_item($setitem1->get_id(), -1, 0));
        $this->assertDebuggingCalled('Cannot find new parent of item');

        $this->assertFalse($top->move_item($setitem1->get_id(), $setitem3->get_id(), 0));
        $this->assertDebuggingCalled('Cannot move item to own child');

        $top2 = top::load($program2->id);
        $this->assertFalse($top->move_item($setitem1->get_id(), $top2->get_id(), 0));
        $this->assertDebuggingCalled('Cannot find new parent of item');
    }

    public function test_delete_item() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['fullname' => 'pokus']);

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();
        $course4 = $this->getDataGenerator()->create_course();
        $course5 = $this->getDataGenerator()->create_course();

        $top = top::load($program1->id);
        $this->assertFalse($top->is_deletable());

        $top->append_course($top, $course1->id);
        /** @var course $courseitem1 */
        $courseitem1 = $top->get_children()[0];
        $top->append_set($top, 'Nice set', set::SEQUENCE_TYPE_ALLINORDER);
        /** @var set $setitem1 */
        $setitem1 = $top->get_children()[1];
        $top->append_set($top, 'Other set', set::SEQUENCE_TYPE_ATLEAST, 2);
        /** @var set $setitem2 */
        $setitem2 = $top->get_children()[2];
        $top->append_set($top, 'Third set', set::SEQUENCE_TYPE_ALLINANYORDER);
        /** @var set $setitem3 */
        $setitem3 = $top->get_children()[3];
        $top->append_course($setitem1, $course2->id);
        /** @var course $courseitem2 */
        $courseitem2 = $setitem1->get_children()[0];
        $top->append_course($setitem1, $course3->id);
        /** @var course $courseitem3 */
        $courseitem3 = $setitem1->get_children()[1];
        $top->append_course($setitem1, $course4->id);
        /** @var course $courseitem4 */
        $courseitem4 = $setitem1->get_children()[2];
        $top->append_course($setitem2, $course5->id);
        /** @var course $courseitem5 */
        $courseitem5 = $setitem2->get_children()[0];
        $this->assertSame(false, $top->is_problem_detected());

        $this->assertFalse($setitem2->is_deletable());
        $this->assertTrue($setitem3->is_deletable());
        $this->assertTrue($courseitem5->is_deletable());

        $this->assertFalse($top->delete_item($setitem2->get_id()));
        $this->assertTrue($top->delete_item($courseitem5->get_id()));
        $this->assertTrue($top->delete_item($setitem2->get_id()));
    }

    public function test_orphaned_items() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['fullname' => 'pokus']);

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();
        $course4 = $this->getDataGenerator()->create_course();
        $course5 = $this->getDataGenerator()->create_course();

        $top = top::load($program1->id);
        $top->append_course($top, $course1->id);
        /** @var course $courseitem1 */
        $courseitem1 = $top->get_children()[0];
        $top->append_set($top, 'Nice set', set::SEQUENCE_TYPE_ALLINORDER);
        /** @var set $setitem1 */
        $setitem1 = $top->get_children()[1];
        $top->append_set($setitem1, 'Other set', set::SEQUENCE_TYPE_ATLEAST, 2);
        /** @var set $setitem2 */
        $setitem2 = $setitem1->get_children()[0];
        $top->append_set($setitem2, 'Third set', set::SEQUENCE_TYPE_ALLINANYORDER);
        /** @var set $setitem3 */
        $setitem3 = $setitem2->get_children()[0];
        $top->append_course($setitem1, $course2->id);
        /** @var course $courseitem2 */
        $courseitem2 = $setitem1->get_children()[1];
        $top->append_course($setitem1, $course3->id);
        /** @var course $courseitem3 */
        $courseitem3 = $setitem1->get_children()[2];
        $top->append_course($setitem2, $course4->id);
        /** @var course $courseitem4 */
        $courseitem4 = $setitem2->get_children()[1];
        $top->append_course($setitem3, $course5->id);
        /** @var course $courseitem5 */
        $courseitem5 = $setitem3->get_children()[0];
        $this->assertSame(false, $top->is_problem_detected());

        $DB->delete_records('enrol_programs_items', ['id' => $setitem2->get_id()]);
        $this->assertDebuggingNotCalled();
        $top = top::load($program1->id);
        $this->assertTrue($top->is_problem_detected());
        $this->assertDebuggingCalled();
        $osets = $top->get_orphaned_sets();
        $this->assertCount(1, $osets);
        $this->assertArrayHasKey($setitem3->get_id(), $osets);
        $ocourses = $top->get_orphaned_courses();
        $this->assertCount(2, $ocourses);
        $this->assertArrayHasKey($courseitem4->get_id(), $ocourses);
        $this->assertArrayHasKey($courseitem5->get_id(), $ocourses);

        $this->assertTrue($top->delete_item($setitem3->get_id()));
        $this->assertTrue($top->delete_item($courseitem4->get_id()));
        $this->assertTrue($top->delete_item($courseitem5->get_id()));
        $this->assertTrue($top->is_problem_detected());

        $top = top::load($program1->id);
        $this->assertFalse($top->is_problem_detected());
        $this->assertDebuggingNotCalled();
        $this->assertCount(2, $top->get_children());
        $courseitem1 = $top->get_children()[0];
        $setitem1 = $top->get_children()[1];
        $this->assertCount(2, $setitem1->get_children());
    }

    public function test_autorepair() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['fullname' => 'pokus']);

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();
        $course4 = $this->getDataGenerator()->create_course();
        $course5 = $this->getDataGenerator()->create_course();

        $top = top::load($program1->id);
        $top->append_course($top, $course1->id);
        /** @var course $courseitem1 */
        $courseitem1 = $top->get_children()[0];
        $top->append_set($top, 'Nice set', set::SEQUENCE_TYPE_ALLINORDER);
        /** @var set $setitem1 */
        $setitem1 = $top->get_children()[1];
        $top->append_set($setitem1, 'Other set', set::SEQUENCE_TYPE_ATLEAST, 2);
        /** @var set $setitem2 */
        $setitem2 = $setitem1->get_children()[0];
        $top->append_set($setitem2, 'Third set', set::SEQUENCE_TYPE_ALLINANYORDER);
        /** @var set $setitem3 */
        $setitem3 = $setitem2->get_children()[0];
        $top->append_course($setitem1, $course2->id);
        /** @var course $courseitem2 */
        $courseitem2 = $setitem1->get_children()[1];
        $top->append_course($setitem1, $course3->id);
        /** @var course $courseitem3 */
        $courseitem3 = $setitem1->get_children()[2];
        $top->append_course($setitem2, $course4->id);
        /** @var course $courseitem4 */
        $courseitem4 = $setitem2->get_children()[1];
        $top->append_course($setitem3, $course5->id);
        /** @var course $courseitem5 */
        $courseitem5 = $setitem3->get_children()[0];

        $DB->delete_records('enrol_programs_prerequisites', []);
        $DB->set_field('enrol_programs_items', 'previtemid', null, []);

        $top = top::load($program1->id);
        $this->assertTrue($top->is_problem_detected());

        $top->autorepair();
        $top = top::load($program1->id);
        $this->assertFalse($top->is_problem_detected());
        $this->assertDebuggingNotCalled();
    }
}
