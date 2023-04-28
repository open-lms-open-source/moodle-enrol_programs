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

namespace enrol_programs\local\notification;

use enrol_programs\local\source\manual;
use enrol_programs\local\notification_manager;

/**
 * Program allocation notifications test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\notification\allocation
 */
final class allocation_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_notification() {
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
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull(notification_manager::get_timenotified($user1->id, $program1->id, 'allocation'));

        $notification = $generator->create_program_notification(['programid' => $program1->id, 'notificationtype' => 'allocation']);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        manual::allocate_users($program1->id, $source1->id, [$user2->id]);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $this->assertTimeCurrent(notification_manager::get_timenotified($user2->id, $program1->id, 'allocation'));
        $message = $messages[0];
        $this->assertSame('Program allocation notification', $message->subject);
        $this->assertStringContainsString('you have been allocated to program', $message->fullmessage);
        $this->assertSame($user2->id, $message->useridto);
        $this->assertSame('-10', $message->useridfrom);
    }
}
