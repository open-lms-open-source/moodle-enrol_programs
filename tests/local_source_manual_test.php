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
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
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
        $this->assertTrue(manual::is_new_allowed());
        set_config('source_manual_allownew', 0, 'enrol_programs');
        $this->assertTrue(manual::is_new_allowed());
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
}
