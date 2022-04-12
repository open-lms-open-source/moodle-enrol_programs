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

use enrol_programs\local\source\approval;
use enrol_programs\local\source\manual;
use enrol_programs\local\program;

/**
 * Approval allocation source test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\source\approval
 */
final class local_source_approval_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_get_type() {
        $this->assertSame('approval', approval::get_type());
    }

    public function test_is_new_alloved() {
        $this->assertTrue(approval::is_new_allowed());
        set_config('source_approval_allownew', 0, 'enrol_programs');
        $this->assertFalse(approval::is_new_allowed());
    }

    public function test_can_user_request() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'approval'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []]]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2a = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'approval'], '*', MUST_EXIST);

        $program3 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []], 'archived' => 1]);
        $source3m = $DB->get_record('enrol_programs_sources', ['programid' => $program3->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source3a = $DB->get_record('enrol_programs_sources', ['programid' => $program3->id, 'type' => 'approval'], '*', MUST_EXIST);

        $guest = guest_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $cohort1 = $this->getDataGenerator()->create_cohort();

        cohort_add_member($cohort1->id, $user1->id);

        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));

        // Must not be archived.

        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 1]);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user1->id));
        $program1 = program::update_program_general((object)['id' => $program1->id, 'archived' => 0]);

        // Real user required.

        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));

        $this->assertFalse(approval::can_user_request($program1, $source1a, $guest->id));

        $this->assertFalse(approval::can_user_request($program1, $source1a, 0));

        // Allocation start-end observed.

        $this->setUser($user1);
        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => time() + 100, 'timeallocationend' => null]);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => null, 'timeallocationend' => time() - 100]);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => time() - 100, 'timeallocationend' => time() + 100]);
        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_allocation((object)['id' => $program1->id,
            'timeallocationstart' => null, 'timeallocationend' => null]);

        // Must be visible.

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 1]);
        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 0, 'cohorts' => [$cohort1->id]]);
        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 0, 'cohorts' => []]);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user1->id));

        $program1 = program::update_program_visibility((object)['id' => $program1->id,
            'public' => 1, 'cohorts' => [$cohort1->id]]);
        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));

        // Allocated already.

        manual::allocate_users($program1->id, $source1m->id, [$user1->id]);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user1->id));

        // Not rejected or pending.

        $this->assertTrue(approval::can_user_request($program1, $source1a, $user2->id));
        $this->setUser($user2);

        $request = approval::request($program1->id, $source1a->id);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user2->id));

        approval::reject_request($request->id, 'oh well');
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user2->id));

        approval::delete_request($request->id);
        $this->assertTrue(approval::can_user_request($program1, $source1a, $user2->id));

        // Disabled requests.

        $source1a = approval::update_source((object)[
            'programid' => $program1->id,
            'type' => 'approval',
            'enable' => 1,
            'approval_allowrequest' => 0,
        ]);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user2->id));
    }

    public function test_request() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'approval'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []]]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2a = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'approval'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $this->setUser($user1);
        $request = approval::request($program1->id, $source1a->id);
        $this->assertSame($source1a->id, $request->sourceid);
        $this->assertSame($user1->id, $request->userid);

        $request = approval::request($program1->id, $source1a->id);
        $this->assertNull($request);
    }

    public function test_approve_request() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'approval'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []]]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2a = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'approval'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $this->setUser($user1);
        $request = approval::request($program1->id, $source1a->id);

        $this->setUser($user2);
        $allocation = approval::approve_request($request->id);
        $this->assertSame($program1->id, $allocation->programid);
        $this->assertSame($source1a->id, $allocation->sourceid);
        $this->assertSame($user1->id, $allocation->userid);
        $this->assertFalse($DB->record_exists('enrol_programs_requests', ['sourceid' => $source1a->id, 'userid' => $user1->id]));
    }

    public function test_reject_request() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'approval'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []]]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2a = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'approval'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $this->setUser($user1);
        $request = approval::request($program1->id, $source1a->id);

        $this->setUser($user2);
        $this->setCurrentTimeStart();
        approval::reject_request($request->id, 'sorry mate');
        $request = $DB->get_record('enrol_programs_requests', ['sourceid' => $source1a->id, 'userid' => $user1->id]);
        $this->assertSame($source1a->id, $request->sourceid);
        $this->assertSame($user1->id, $request->userid);
        $this->assertTimeCurrent($request->timerejected);
        $this->assertFalse(approval::can_user_request($program1, $source1a, $user1->id));
    }

    public function test_delete_request() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'approval'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => [], 'approval' => []]]);
        $source2m = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2a = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'approval'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $this->setUser($user1);
        $request = approval::request($program1->id, $source1a->id);

        $this->setUser($user2);
        approval::delete_request($request->id);
        $this->assertTrue(approval::can_user_request($program1, $source1a, $user1->id));
    }

    public function test_notify_allocation() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $guest = guest_user();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $program1 = $generator->create_program(['sources' => ['approval' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'approval'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['approval' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'approval'], '*', MUST_EXIST);

        $sink = $this->redirectMessages();
        $this->setUser($user1);
        $request = approval::request($program1->id, $source1->id);
        $this->setAdminUser();
        approval::approve_request($request->id);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull($allocation->timenotifiedallocation);

        $program1 = program::update_program_notifications((object)[
            'id' => $program1->id,
            'allocation_approval' => 1,
        ], false);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $this->setUser($user2);
        $request = approval::request($program1->id, $source1->id);
        $this->setUser($user3);
        approval::approve_request($request->id);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $this->assertTimeCurrent($allocation->timenotifiedallocation);
        $message = $messages[0];
        $this->assertSame('Program approval notification', $message->subject);
        $this->assertStringContainsString('was approved', $message->fullmessage);
        $this->assertSame($user2->id, $message->useridto);
        $this->assertSame($user3->id, $message->useridfrom);
    }
}
