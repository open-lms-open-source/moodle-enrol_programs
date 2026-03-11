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
 * Program start related user notification test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2026 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\notification\start
 */
final class start_relateduser_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_notify_users() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $relatedgenerator = $this->getDataGenerator()->get_plugin_generator('profilefield_relateduser');

        $categoryid = $relatedgenerator->add_profile_category();
        $profilefieldid = $relatedgenerator->add_profile_field($categoryid, 'relateduser');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $related1 = $this->getDataGenerator()->create_user();
        $relatedgenerator->add_user_info_data($user1->id, $profilefieldid, $related1->id);
        set_config('notification_relateduserfield', $profilefieldid, 'enrol_programs');

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
        $allocation1->timestart = $now - start::TIME_CUTOFF + 100;
        $DB->update_record('enrol_programs_allocations', $allocation1);
        $allocation2->timestart = $now - start::TIME_CUTOFF - 100;
        $DB->update_record('enrol_programs_allocations', $allocation2);
        $allocation3->timestart = $now + start::get_time_soon() - 100;
        $DB->update_record('enrol_programs_allocations', $allocation3);
        $allocation4->timestart = $now + start::get_time_soon() + 100;
        $DB->update_record('enrol_programs_allocations', $allocation4);
        $generator->create_program_notification(['notificationtype' => 'start_relateduser', 'programid' => $program1->id]);
        $generator->create_program_notification(['notificationtype' => 'start_relateduser', 'programid' => $program2->id]);

        $this->setCurrentTimeStart();
        $sink = $this->redirectMessages();
        start_relateduser::notify_users($program1, $user1);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(1, $messages);
        $message = $messages[0];
        $this->assertSame('Program started - related user', $message->subject);
        $this->assertSame('-10', $message->useridfrom);
        $this->assertSame($related1->id, $message->useridto);
        $this->assertSame('enrol_programs', $message->component);
        $this->assertSame('start_relateduser_notification', $message->eventtype);
        $this->assertSame($program1->fullname, $message->contexturlname);
        $this->assertTimeCurrent(notification_manager::get_timenotified($user1->id, $program1->id, 'start_relateduser'));
        $this->assertNull(notification_manager::get_timenotified($user2->id, $program1->id, 'start_relateduser'));
    }
}
