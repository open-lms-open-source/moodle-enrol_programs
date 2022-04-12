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

use enrol_programs\local\source\selfallocation;
use enrol_programs\local\source\manual;
use enrol_programs\local\program;

/**
 * Manual allocation source test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\source\selfallocation
 */
final class local_source_selfallocation_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_get_type() {
        $this->assertSame('selfallocation', selfallocation::get_type());
    }

    public function test_is_new_alloved() {
        $this->assertTrue(selfallocation::is_new_allowed());
        set_config('source_selfallocation_allownew', 0, 'enrol_programs');
        $this->assertFalse(selfallocation::is_new_allowed());
    }

    public function test_can_user_request() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'selfallocation' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'selfallocation'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => [], 'selfallocation' => []]]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2a = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'selfallocation'], '*', MUST_EXIST);

        $program3 = $generator->create_program(['sources' => ['manual' => [], 'selfallocation' => []], 'archived' => 1]);
        $source3m = $DB->get_record('enrol_programs_sources', ['programid' => $program3->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source3a = $DB->get_record('enrol_programs_sources', ['programid' => $program3->id, 'type' => 'selfallocation'], '*', MUST_EXIST);

        $guest = guest_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $cohort1 = $this->getDataGenerator()->create_cohort();

        cohort_add_member($cohort1->id, $user1->id);

        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user1->id));

        // Must not be archived.

        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 1]);
        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $user1->id));
        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 0]);

        // Real user required.

        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $guest->id));

        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, 0));

        // Allocation start-end observed.

        $this->setUser($user1);
        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => time() + 100, 'timeallocationend' => null]);
        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => null, 'timeallocationend' => time() - 100]);
        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => time() - 100, 'timeallocationend' => time() + 100]);
        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => null, 'timeallocationend' => null]);

        // Must be visible.

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 1]);
        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 0, 'cohorts' => [$cohort1->id]]);
        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 0, 'cohorts' => []]);
        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 1, 'cohorts' => [$cohort1->id]]);
        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user1->id));

        // Allocated already.

        manual::allocate_users($program1->id, $source1m->id, [$user1->id]);
        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $user1->id));

        // Max users.

        manual::allocate_users($program1->id, $source1m->id, [$user3->id]);
        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user2->id));

        $source1a = selfallocation::update_source((object)[
            'programid' => $program1->id,
            'type' => 'selfallocation',
            'enable' => 1,
            'selfallocation_maxusers' => 2,
        ]);
        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $user2->id));

        $source1a = selfallocation::update_source((object)[
            'programid' => $program1->id,
            'type' => 'selfallocation',
            'enable' => 1,
            'selfallocation_maxusers' => 3,
        ]);
        $this->assertTrue(selfallocation::can_user_request($program1, $source1a, $user2->id));

        // Disabled new allocations.

        $source1a = selfallocation::update_source((object)[
            'programid' => $program1->id,
            'type' => 'selfallocation',
            'enable' => 1,
            'selfallocation_allowsignup' => 0,
        ]);
        $this->assertFalse(selfallocation::can_user_request($program1, $source1a, $user2->id));
    }

    public function test_signup() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'selfallocation' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'selfallocation'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $this->setUser($user1);
        $allocation = selfallocation::signup($program1->id, $source1a->id);
        $this->assertSame($user1->id, $allocation->userid);
        $this->assertSame($program1->id, $allocation->programid);
        $this->assertSame($source1a->id, $allocation->sourceid);

        $allocation2 = selfallocation::signup($program1->id, $source1a->id);
        $this->assertEquals($allocation, $allocation2);
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

        $program1 = $generator->create_program(['sources' => ['selfallocation' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'selfallocation'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['selfallocation' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'selfallocation'], '*', MUST_EXIST);

        $sink = $this->redirectMessages();
        $this->setUser($user1);
        selfallocation::signup($program1->id, $source1->id);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull($allocation->timenotifiedallocation);

        $program1 = program::update_program_notifications((object)[
            'id' => $program1->id,
            'allocation_selfallocation' => 1,
        ], false);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $this->setUser($user2);
        selfallocation::signup($program1->id, $source1->id);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($allocation->timenotifiedallocation);
        $message = $messages[0];
        $this->assertSame('Program allocation notification', $message->subject);
        $this->assertStringContainsString('you have signed up for program', $message->fullmessage);
        $this->assertSame($user2->id, $message->useridto);
        $this->assertSame($admin->id, $message->useridfrom);
    }
}
