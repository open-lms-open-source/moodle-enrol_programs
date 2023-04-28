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
 * Completed program end notification test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\notification\endcompleted
 */
final class endcompleted_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_notify_users() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id, $user3->id, $user4->id]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user2->id], '*', MUST_EXIST);
        $allocation3 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user3->id], '*', MUST_EXIST);
        $allocation4 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user4->id], '*', MUST_EXIST);
        manual::allocate_users($program2->id, $source2->id, [$user1->id, $user2->id]);
        $allocation5 = $DB->get_record('enrol_programs_allocations', ['programid' => $program2->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $allocation6 = $DB->get_record('enrol_programs_allocations', ['programid' => $program2->id, 'userid' => $user2->id], '*', MUST_EXIST);

        $now = time();
        $allocation1->timeend = $now - endcompleted::TIME_CUTOFF + 100;
        $allocation1->timecompleted = $now;
        $DB->update_record('enrol_programs_allocations', $allocation1);
        $allocation2->timeend = $now - endcompleted::TIME_CUTOFF - 100;
        $allocation2->timecompleted = $now;
        $DB->update_record('enrol_programs_allocations', $allocation2);
        $allocation3->timeend = $now + endcompleted::TIME_SOON - 100;
        $allocation3->timecompleted = $now;
        $DB->update_record('enrol_programs_allocations', $allocation3);
        $allocation4->timeend = $now + endcompleted::TIME_SOON + 100;
        $allocation4->timecompleted = $now;
        $DB->update_record('enrol_programs_allocations', $allocation4);
        $allocation5->timeend = $now - 100;
        $allocation5->timecompleted = $now;
        $DB->update_record('enrol_programs_allocations', $allocation5);
        $allocation6->timeend = $now - 100;
        $allocation6->timecompleted = $now;
        $DB->update_record('enrol_programs_allocations', $allocation6);
        $generator->create_program_notification(['notificationtype' => 'endcompleted', 'programid' => $program1->id]);
        $generator->create_program_notification(['notificationtype' => 'endcompleted', 'programid' => $program2->id]);

        $this->setCurrentTimestart();
        $sink = $this->redirectMessages();
        endcompleted::notify_users($program1, null);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $message = $messages[0];
        $this->assertSame('Completed program ended', $message->subject);
        $this->assertSame('-10', $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);
        $this->assertSame('enrol_programs', $message->component);
        $this->assertSame('endcompleted_notification', $message->eventtype);
        $this->assertSame($program1->fullname, $message->contexturlname);
        $this->assertTimeCurrent(notification_manager::get_timenotified($user1->id, $program1->id, 'endcompleted'));
        $this->assertNull(notification_manager::get_timenotified($user2->id, $program1->id, 'endcompleted'));

        $this->setCurrentTimestart();
        $sink = $this->redirectMessages();
        endcompleted::notify_users(null, $user1);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $message = $messages[0];
        $this->assertSame('Completed program ended', $message->subject);
        $this->assertSame('-10', $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);
        $this->assertSame('enrol_programs', $message->component);
        $this->assertSame('endcompleted_notification', $message->eventtype);
        $this->assertSame($program2->fullname, $message->contexturlname);
        $this->assertTimeCurrent(notification_manager::get_timenotified($user1->id, $program2->id, 'endcompleted'));
        $this->assertNull(notification_manager::get_timenotified($user2->id, $program2->id, 'endcompleted'));

        $this->setCurrentTimestart();
        $sink = $this->redirectMessages();
        endcompleted::notify_users(null, null);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $message = $messages[0];
        $this->assertSame('Completed program ended', $message->subject);
        $this->assertSame('-10', $message->useridfrom);
        $this->assertSame($user2->id, $message->useridto);
        $this->assertSame('enrol_programs', $message->component);
        $this->assertSame('endcompleted_notification', $message->eventtype);
        $this->assertSame($program2->fullname, $message->contexturlname);
        $this->assertTimeCurrent(notification_manager::get_timenotified($user2->id, $program2->id, 'endcompleted'));

        $this->setCurrentTimestart();
        $sink = $this->redirectMessages();
        endcompleted::notify_users(null, null);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);
    }
}
