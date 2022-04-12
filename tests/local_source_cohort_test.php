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

use enrol_programs\local\source\cohort;
use enrol_programs\local\source\manual;
use enrol_programs\local\program;

/**
 * Visible cohort allocation source test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\source\cohort
 */
final class local_source_cohort_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_get_type() {
        $this->assertSame('cohort', cohort::get_type());
    }

    public function test_is_new_alloved() {
        $this->assertTrue(cohort::is_new_allowed());
        set_config('source_cohort_allownew', 0, 'enrol_programs');
        $this->assertFalse(cohort::is_new_allowed());
    }

    public function test_allocations() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $guest = guest_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'cohort' => []]]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1c = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'cohort'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        cohort_add_member($cohort1->id, $user1->id);
        cohort_add_member($cohort2->id, $user1->id);
        cohort_add_member($cohort2->id, $user2->id);

        manual::allocate_users($program1->id, $source1m->id, [$user1->id]);

        // Adding and removing cohorts in program visibility settings.

        $program1 = program::update_program_visibility(
            (object)['id' => $program1->id, 'public' => 1, 'cohorts' => [$cohort1->id]]);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(1, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);

        $program1 = program::update_program_visibility(
            (object)['id' => $program1->id, 'public' => 1, 'cohorts' => [$cohort1->id, $cohort2->id]]);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(2, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);

        $program1 = program::update_program_visibility(
            (object)['id' => $program1->id, 'public' => 1, 'cohorts' => []]);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(2, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('1', $allocations[1]->archived);

        $program1 = program::update_program_visibility(
            (object)['id' => $program1->id, 'public' => 1, 'cohorts' => [$cohort1->id, $cohort2->id]]);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(2, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);

        // Cohort membership changes.

        cohort_add_member($cohort2->id, $user3->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(3, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);
        $this->assertSame($user3->id, $allocations[2]->userid);
        $this->assertSame($source1c->id, $allocations[2]->sourceid);
        $this->assertSame('0', $allocations[2]->archived);

        cohort_remove_member($cohort2->id, $user3->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(3, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);
        $this->assertSame($user3->id, $allocations[2]->userid);
        $this->assertSame($source1c->id, $allocations[2]->sourceid);
        $this->assertSame('1', $allocations[2]->archived);

        // Freezing of archived program.

        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 1]);

        cohort_remove_member($cohort2->id, $user2->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(3, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);
        $this->assertSame($user3->id, $allocations[2]->userid);
        $this->assertSame($source1c->id, $allocations[2]->sourceid);
        $this->assertSame('1', $allocations[2]->archived);

        $program1 = program::update_program_visibility(
            (object)['id' => $program1->id, 'public' => 1, 'cohorts' => []]);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(3, $allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);
        $this->assertSame($user3->id, $allocations[2]->userid);
        $this->assertSame($source1c->id, $allocations[2]->sourceid);
        $this->assertSame('1', $allocations[2]->archived);

        manual::deallocate_user($program1, $source1m, $allocations[0]);

        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 0]);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(2, $allocations);
        $this->assertSame($user2->id, $allocations[0]->userid);
        $this->assertSame($source1c->id, $allocations[0]->sourceid);
        $this->assertSame('1', $allocations[0]->archived);
        $this->assertSame($user3->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('1', $allocations[1]->archived);

        // Check there are no SQL syntax errors with different parameters.
        cohort::fix_allocations(null, null);
        cohort::fix_allocations($program1->id, null);
        cohort::fix_allocations($program1->id, $user1->id);
        cohort::fix_allocations(null, $user1->id);

        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $allocations = array_values($allocations);
        $this->assertCount(2, $allocations);
        $this->assertSame($user2->id, $allocations[0]->userid);
        $this->assertSame($source1c->id, $allocations[0]->sourceid);
        $this->assertSame('1', $allocations[0]->archived);
        $this->assertSame($user3->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('1', $allocations[1]->archived);
    }

    /**
     * @return void
     *
     * @covers \enrol_programs\local\event_observer::cohort_member_added()
     * @covers \enrol_programs\local\event_observer::cohort_member_removed()
     */
    public function test_cohort_observers() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $guest = guest_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();
        $cohort3 = $this->getDataGenerator()->create_cohort();

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'cohort' => []], 'cohorts' => [$cohort1->id, $cohort2->id]]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1c = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'cohort'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => [], 'cohort' => []], 'cohorts' => [$cohort1->id], 'archived' => 1]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2c = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'cohort'], '*', MUST_EXIST);

        manual::allocate_users($program1->id, $source1m->id, [$user1->id]);
        cohort_add_member($cohort3->id, $user1->id);

        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $this->assertCount(1, $allocations);
        $allocations = array_values($allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);

        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program2->id], 'userid ASC');
        $this->assertCount(0, $allocations);

        cohort_add_member($cohort1->id, $user2->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $this->assertCount(2, $allocations);
        $allocations = array_values($allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);

        cohort_add_member($cohort2->id, $user2->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $this->assertCount(2, $allocations);
        $allocations = array_values($allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);

        cohort_remove_member($cohort2->id, $user2->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $this->assertCount(2, $allocations);
        $allocations = array_values($allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('0', $allocations[1]->archived);

        cohort_remove_member($cohort1->id, $user2->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $this->assertCount(2, $allocations);
        $allocations = array_values($allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('1', $allocations[1]->archived);

        cohort_remove_member($cohort1->id, $user1->id);
        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program1->id], 'userid ASC');
        $this->assertCount(2, $allocations);
        $allocations = array_values($allocations);
        $this->assertSame($user1->id, $allocations[0]->userid);
        $this->assertSame($source1m->id, $allocations[0]->sourceid);
        $this->assertSame('0', $allocations[0]->archived);
        $this->assertSame($user2->id, $allocations[1]->userid);
        $this->assertSame($source1c->id, $allocations[1]->sourceid);
        $this->assertSame('1', $allocations[1]->archived);
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

        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();

        $program1 = $generator->create_program(['sources' => ['cohort' => []], 'cohorts' => [$cohort1->id]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'cohort'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['cohort' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'cohort'], '*', MUST_EXIST);

        $this->setUser($user3);

        $sink = $this->redirectMessages();
        cohort_add_member($cohort1->id, $user1->id);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull($allocation->timenotifiedallocation);

        $program1 = program::update_program_notifications((object)[
            'id' => $program1->id,
            'allocation_cohort' => 1,
        ], false);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        cohort_add_member($cohort1->id, $user2->id);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($allocation->timenotifiedallocation);
        $message = $messages[0];
        $this->assertSame('Program allocation notification', $message->subject);
        $this->assertStringContainsString('you have been allocated to program', $message->fullmessage);
        $this->assertSame($user2->id, $message->useridto);
        $this->assertSame($admin->id, $message->useridfrom);
    }

}
