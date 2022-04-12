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
use enrol_programs\local\source\manual;

/**
 * Details tests for creation of program groups.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\allocation::fix_enrol_instances();
 * @covers \enrol_programs\local\allocation::fix_user_enrolments();
 */
final class groups_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_groups() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course([]);
        $course2 = $this->getDataGenerator()->create_course([]);
        $course3 = $this->getDataGenerator()->create_course([]);
        $course4 = $this->getDataGenerator()->create_course([]);

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program3 = $generator->create_program(['sources' => ['manual' => []]]);
        $source3 = $DB->get_record('enrol_programs_sources', ['programid' => $program3->id, 'type' => 'manual'], '*', MUST_EXIST);

        $top1 = program::load_content($program1->id);
        $item1x1 = $top1->append_course($top1, $course1->id);
        $item1x2 = $top1->append_course($top1, $course2->id);

        $top2 = program::load_content($program2->id);
        $item2x1 = $top2->append_course($top2, $course2->id);
        $item2x2 = $top2->append_course($top2, $course3->id);

        $top3 = program::load_content($program3->id);
        $item3x1 = $top3->append_course($top3, $course1->id);

        manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);
        manual::allocate_users($program2->id, $source2->id, [$user1->id]);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(0, $groups);

        $program1 = program::update_program_general((object)[
            'id' => $program1->id,
            'creategroups' => 1,
        ]);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(2, $groups);
        $groups = array_values($groups);
        $this->assertSame($program1->fullname, $groups[0]->name);
        $this->assertSame($course1->id, $groups[0]->courseid);
        $this->assertSame($program1->fullname, $groups[1]->name);
        $this->assertSame($course2->id, $groups[1]->courseid);
        $members = $DB->get_records('groups_members', [], 'userid ASC, groupid ASC');
        $this->assertCount(4, $members);
        $members = array_values($members);
        $this->assertSame($user1->id, $members[0]->userid);
        $this->assertSame($groups[0]->id, $members[0]->groupid);
        $this->assertSame($user1->id, $members[1]->userid);
        $this->assertSame($groups[1]->id, $members[1]->groupid);
        $this->assertSame($user2->id, $members[2]->userid);
        $this->assertSame($groups[0]->id, $members[2]->groupid);
        $this->assertSame($user2->id, $members[3]->userid);
        $this->assertSame($groups[1]->id, $members[3]->groupid);

        $program2 = program::update_program_general((object)[
            'id' => $program2->id,
            'creategroups' => 1,
        ]);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(4, $groups);
        $groups = array_values($groups);
        $this->assertSame($program1->fullname, $groups[0]->name);
        $this->assertSame($course1->id, $groups[0]->courseid);
        $this->assertSame($program1->fullname, $groups[1]->name);
        $this->assertSame($course2->id, $groups[1]->courseid);
        $this->assertSame($program2->fullname, $groups[2]->name);
        $this->assertSame($course2->id, $groups[2]->courseid);
        $this->assertSame($program2->fullname, $groups[3]->name);
        $this->assertSame($course3->id, $groups[3]->courseid);
        $members = $DB->get_records('groups_members', [], 'userid ASC, groupid ASC');
        $this->assertCount(6, $members);

        $program2 = program::update_program_general((object)[
            'id' => $program2->id,
            'creategroups' => 0,
        ]);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(2, $groups);
        $groups = array_values($groups);
        $this->assertSame($program1->fullname, $groups[0]->name);
        $this->assertSame($course1->id, $groups[0]->courseid);
        $this->assertSame($program1->fullname, $groups[1]->name);
        $this->assertSame($course2->id, $groups[1]->courseid);
        $members = $DB->get_records('groups_members', [], 'userid ASC, groupid ASC');
        $this->assertCount(4, $members);

        $program2 = program::update_program_general((object)[
            'id' => $program2->id,
            'creategroups' => 1,
        ]);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(4, $groups);
        program::delete_program($program2->id);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(2, $groups);
        $groups = array_values($groups);
        $this->assertSame($program1->fullname, $groups[0]->name);
        $this->assertSame($course1->id, $groups[0]->courseid);
        $this->assertSame($program1->fullname, $groups[1]->name);
        $this->assertSame($course2->id, $groups[1]->courseid);
        $members = $DB->get_records('groups_members', [], 'userid ASC, groupid ASC');
        $this->assertCount(4, $members);

        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        manual::deallocate_user($program1, $source1, $allocation1);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(2, $groups);
        $groups = array_values($groups);
        $this->assertSame($program1->fullname, $groups[0]->name);
        $this->assertSame($course1->id, $groups[0]->courseid);
        $this->assertSame($program1->fullname, $groups[1]->name);
        $this->assertSame($course2->id, $groups[1]->courseid);
        $members = $DB->get_records('groups_members', [], 'userid ASC, groupid ASC');
        $this->assertCount(2, $members);
        $members = array_values($members);
        $this->assertSame($user2->id, $members[0]->userid);
        $this->assertSame($groups[0]->id, $members[0]->groupid);
        $this->assertSame($user2->id, $members[1]->userid);
        $this->assertSame($groups[1]->id, $members[1]->groupid);

        $top1->delete_item($item1x1->get_id());
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(1, $groups);
        $groups = array_values($groups);
        $this->assertSame($program1->fullname, $groups[0]->name);
        $this->assertSame($course2->id, $groups[0]->courseid);
        $members = $DB->get_records('groups_members', [], 'userid ASC, groupid ASC');
        $this->assertCount(1, $members);
        $members = array_values($members);
        $this->assertSame($user2->id, $members[0]->userid);
        $this->assertSame($groups[0]->id, $members[0]->groupid);

        $group = $groups[0];
        $group->name = 'xxx';
        groups_update_group($group);
        \enrol_programs\local\allocation::fix_enrol_instances(null);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(1, $groups);
        $groups = array_values($groups);
        $this->assertSame('xxx', $groups[0]->name);
        $this->assertSame($course2->id, $groups[0]->courseid);

        $program1 = program::update_program_general((object)[
            'id' => $program1->id,
            'fullname' => 'yy',
        ]);
        $groups = $DB->get_records('groups', [], 'id ASC');
        $this->assertCount(1, $groups);
        $groups = array_values($groups);
        $this->assertSame($program1->fullname, $groups[0]->name);
        $this->assertSame($course2->id, $groups[0]->courseid);
    }
}
