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

use enrol_programs\local\notification\base;
use enrol_programs\local\program;
use enrol_programs\local\allocation;
use enrol_programs\local\source\manual;

/**
 * Program notifications test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\notification\deallocation
 */
final class deallocation_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_deallocation() {
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
        $notification = $generator->create_program_notification(['programid' => $program1->id, 'notificationtype' => 'deallocation']);
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
        $this->assertSame('-10', $message->useridfrom);
    }
}
