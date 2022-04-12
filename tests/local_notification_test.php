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

use enrol_programs\local\notification;
use enrol_programs\local\program;
use enrol_programs\local\allocation;
use enrol_programs\local\source\manual;

/**
 * Program notifications test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\notification
 */
final class local_notification_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_constants() {
        $this->assertGreaterThan(0, notification::TIME_SOON);
        $this->assertGreaterThan(0, notification::TIME_CUTOFF);
    }

    public function test_get_standard_placeholders() {
        global $DB, $CFG;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $strnotset = get_string('notset', 'enrol_programs');

        $result = notification::get_standard_placeholders($program1, $source1, $allocation, $user1);
        $this->assertInstanceOf('stdClass', $result);
        $this->assertSame(fullname($user1), $result->user_fullname);
        $this->assertSame($user1->firstname, $result->user_firstname);
        $this->assertSame($user1->lastname, $result->user_lastname);
        $this->assertSame($program1->fullname, $result->program_fullname);
        $this->assertSame($program1->idnumber, $result->program_idnumber);
        $this->assertSame("$CFG->wwwroot/enrol/programs/my/program.php?id=$program1->id", $result->program_url);
        $this->assertSame('Manual allocation', $result->program_sourcename);
        $this->assertSame('Open', $result->program_status);
        $this->assertSame(userdate($allocation->timeallocated), $result->program_allocationdate);
        $this->assertSame(userdate($allocation->timestart), $result->program_startdate);
        $this->assertSame($strnotset, $result->program_duedate);
        $this->assertSame($strnotset, $result->program_enddate);
        $this->assertSame($strnotset, $result->program_completeddate);

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 24 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 24 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 24 * 20);
        $allocation->timecompleted = (string)($now + 60 * 60 * 24 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $result = notification::get_standard_placeholders($program1, $source1, $allocation, $user1);
        $this->assertInstanceOf('stdClass', $result);
        $this->assertSame(fullname($user1), $result->user_fullname);
        $this->assertSame($user1->firstname, $result->user_firstname);
        $this->assertSame($user1->lastname, $result->user_lastname);
        $this->assertSame($program1->fullname, $result->program_fullname);
        $this->assertSame($program1->idnumber, $result->program_idnumber);
        $this->assertSame("$CFG->wwwroot/enrol/programs/my/program.php?id=$program1->id", $result->program_url);
        $this->assertSame('Manual allocation', $result->program_sourcename);
        $this->assertSame('Completed', $result->program_status);
        $this->assertSame(userdate($allocation->timeallocated), $result->program_allocationdate);
        $this->assertSame(userdate($allocation->timestart), $result->program_startdate);
        $this->assertSame(userdate($allocation->timedue), $result->program_duedate);
        $this->assertSame(userdate($allocation->timeend), $result->program_enddate);
        $this->assertSame(userdate($allocation->timecompleted), $result->program_completeddate);
    }

    public function test_get_notifier() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $admin = get_admin();

        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $this->setUser(null);
        $result = notification::get_notifier($program1, $source1, $allocation1, $user1);
        $this->assertSame($admin->id, $result->id);

        $this->setUser($user2);
        $result = notification::get_notifier($program1, $source1, $allocation1, $user1);
        $this->assertSame($admin->id, $result->id);
    }

    public function test_trigger_notifications() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $admin = get_admin();
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull($allocation->timenotifiedallocation);
        $this->assertNull($allocation->timenotifiedstart);
        $this->assertNull($allocation->timenotifiedcompleted);
        $this->assertNull($allocation->timenotifiedduesoon);
        $this->assertNull($allocation->timenotifieddue);
        $this->assertNull($allocation->timenotifiedendsoon);
        $this->assertNull($allocation->timenotifiedendcompleted);
        $this->assertNull($allocation->timenotifiedendfailed);

        $sink = $this->redirectMessages();
        notification::trigger_notifications(null, null);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $this->assertNull($allocation->timenotifiedallocation);
        $this->assertNull($allocation->timenotifiedstart);
        $this->assertNull($allocation->timenotifiedcompleted);
        $this->assertNull($allocation->timenotifiedduesoon);
        $this->assertNull($allocation->timenotifieddue);
        $this->assertNull($allocation->timenotifiedendsoon);
        $this->assertNull($allocation->timenotifiedendcompleted);
        $this->assertNull($allocation->timenotifiedendfailed);

        // Start notification.

        $data = (object)['id' => $program1->id, 'notifystart' => 1];
        $program1 = program::update_program_notifications($data, false);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedstart', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedstart);
        $allocation->timestart = (string)($now + 60 * 60 * 24 * 1);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedstart);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedstart', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedstart);
        $allocation->timestart = (string)($now - 60 * 60 * 24 * 3);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedstart);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedstart', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedstart);
        $allocation->timestart = (string)($now - 60 * 60 * 24 * 1);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertTimeCurrent($allocation->timenotifiedstart);
        $this->assertCount(1, $messages);
        $message = reset($messages);
        $this->assertSame('Program started', $message->subject);
        $this->assertStringContainsString('has started', $message->fullmessage);
        $this->assertSame($admin->id, $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);

        $DB->set_field('enrol_programs_allocations', 'timestart', ($now - 60 * 60 * 24 * 20), ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedstart', null, ['id' => $allocation->id]);
        $data = (object)['id' => $program1->id, 'notifystart' => 0];
        $program1 = program::update_program_notifications($data, false);

        // Completed notification.

        $data = (object)['id' => $program1->id, 'notifycompleted' => 1];
        $program1 = program::update_program_notifications($data, false);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedcompleted);
        $allocation->timecompleted = (string)($now + 60 * 60 * 24 * 1);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedcompleted);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedcompleted);
        $allocation->timecompleted = (string)($now - 60 * 60 * 24 * 4);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedcompleted);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedcompleted);
        $allocation->timecompleted = (string)($now - 60 * 60 * 24 * 1);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertTimeCurrent($allocation->timenotifiedcompleted);
        $this->assertCount(1, $messages);
        $message = reset($messages);
        $this->assertSame('Program completed', $message->subject);
        $this->assertStringContainsString('you have completed', $message->fullmessage);
        $this->assertSame($admin->id, $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);

        $DB->set_field('enrol_programs_allocations', 'timecompleted', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedcompleted', null, ['id' => $allocation->id]);
        $data = (object)['id' => $program1->id, 'notifycompleted' => 0];
        $program1 = program::update_program_notifications($data, false);

        // Due soon notification.

        $data = (object)['id' => $program1->id, 'notifyduesoon' => 1];
        $program1 = program::update_program_notifications($data, false);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedduesoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedduesoon);
        $allocation->timedue = null;
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedduesoon);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedduesoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedduesoon);
        $allocation->timedue = (string)($now - 60 * 60 * 24 * 3);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedduesoon);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedduesoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedduesoon);
        $allocation->timedue = (string)($now + 60 * 60 * 24 * 1);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertTimeCurrent($allocation->timenotifiedduesoon);
        $this->assertCount(1, $messages);
        $message = reset($messages);
        $this->assertSame('Program completion is expected soon', $message->subject);
        $this->assertStringContainsString('is expected on', $message->fullmessage);
        $this->assertSame($admin->id, $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedduesoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedduesoon);
        $allocation->timedue = (string)($now + 60 * 60 * 24 * 1);
        $allocation->timecompleted = (string)($now - 10);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);

        $DB->set_field('enrol_programs_allocations', 'timecompleted', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timedue', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedduesoon', null, ['id' => $allocation->id]);
        $data = (object)['id' => $program1->id, 'notifyduesoon' => 0];
        $program1 = program::update_program_notifications($data, false);

        // Past due notification.

        $data = (object)['id' => $program1->id, 'notifydue' => 1];
        $program1 = program::update_program_notifications($data, false);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifieddue', null, ['id' => $allocation->id]);
        unset($allocation->timenotifieddue);
        $allocation->timedue = null;
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifieddue);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifieddue', null, ['id' => $allocation->id]);
        unset($allocation->timenotifieddue);
        $allocation->timedue = (string)($now - 60 * 60 * 24 * 3);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifieddue);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifieddue', null, ['id' => $allocation->id]);
        unset($allocation->timenotifieddue);
        $allocation->timedue = (string)($now + 60 * 60);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifieddue);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifieddue', null, ['id' => $allocation->id]);
        unset($allocation->timenotifieddue);
        $allocation->timedue = (string)($now - 10);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertTimeCurrent($allocation->timenotifieddue);
        $this->assertCount(1, $messages);
        $message = reset($messages);
        $this->assertSame('Program completion was expected', $message->subject);
        $this->assertStringContainsString('was expected before', $message->fullmessage);
        $this->assertSame($admin->id, $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifieddue', null, ['id' => $allocation->id]);
        unset($allocation->timenotifieddue);
        $allocation->timedue = (string)($now - 10);
        $allocation->timecompleted = (string)($now - 100);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);

        $DB->set_field('enrol_programs_allocations', 'timecompleted', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timedue', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timenotifieddue', null, ['id' => $allocation->id]);
        $data = (object)['id' => $program1->id, 'notifydue' => 0];
        $program1 = program::update_program_notifications($data, false);

        // End soon notification.

        $data = (object)['id' => $program1->id, 'notifyendsoon' => 1];
        $program1 = program::update_program_notifications($data, false);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendsoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendsoon);
        $allocation->timeend = null;
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendsoon);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendsoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendsoon);
        $allocation->timeend = (string)($now - 60 * 60 * 24 * 3);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendsoon);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendsoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendsoon);
        $allocation->timeend = (string)($now + 60 * 60 * 24 * 1);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertTimeCurrent($allocation->timenotifiedendsoon);
        $this->assertCount(1, $messages);
        $message = reset($messages);
        $this->assertSame('Program ends soon', $message->subject);
        $this->assertStringContainsString('is ending on', $message->fullmessage);
        $this->assertSame($admin->id, $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendsoon', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendsoon);
        $allocation->timeend = (string)($now + 60 * 60 * 24 * 1);
        $allocation->timecompleted = (string)($now - 10);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);

        $DB->set_field('enrol_programs_allocations', 'timecompleted', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timeend', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendsoon', null, ['id' => $allocation->id]);
        $data = (object)['id' => $program1->id, 'notifyendsoon' => 0];
        $program1 = program::update_program_notifications($data, false);

        // End failed notification.

        $data = (object)['id' => $program1->id, 'notifyendfailed' => 1];
        $program1 = program::update_program_notifications($data, false);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendfailed', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendfailed);
        $allocation->timeend = null;
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendfailed);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendfailed', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendfailed);
        $allocation->timeend = (string)($now - 60 * 60 * 24 * 3);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendfailed);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendfailed', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendfailed);
        $allocation->timeend = (string)($now + 60 * 60);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendfailed);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendfailed', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendfailed);
        $allocation->timeend = (string)($now - 10);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertTimeCurrent($allocation->timenotifiedendfailed);
        $this->assertCount(1, $messages);
        $message = reset($messages);
        $this->assertSame('Failed program ended', $message->subject);
        $this->assertStringContainsString('you have failed to complete', $message->fullmessage);
        $this->assertSame($admin->id, $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendfailed', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendfailed);
        $allocation->timeend = (string)($now - 10);
        $allocation->timecompleted = (string)($now - 100);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);

        $DB->set_field('enrol_programs_allocations', 'timecompleted', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timeend', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendfailed', null, ['id' => $allocation->id]);
        $data = (object)['id' => $program1->id, 'notifyendfailed' => 0];
        $program1 = program::update_program_notifications($data, false);

        // End completed notification.

        $data = (object)['id' => $program1->id, 'notifyendcompleted' => 1];
        $program1 = program::update_program_notifications($data, false);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendcompleted);
        $allocation->timeend = null;
        $allocation->timecompleted = (string)($now - 60 * 60 * 24 * 10);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendcompleted);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendcompleted);
        $allocation->timeend = (string)($now - 60 * 60 * 24 * 3);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendcompleted);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendcompleted);
        $allocation->timeend = (string)($now + 60 * 60);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertNull($allocation->timenotifiedendcompleted);
        $this->assertCount(0, $messages);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendcompleted);
        $allocation->timeend = (string)($now - 10);
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertTimeCurrent($allocation->timenotifiedendcompleted);
        $this->assertCount(1, $messages);
        $message = reset($messages);
        $this->assertSame('Completed program ended', $message->subject);
        $this->assertStringContainsString('you have completed it earlier', $message->fullmessage);
        $this->assertSame($admin->id, $message->useridfrom);
        $this->assertSame($user1->id, $message->useridto);

        $now = time();
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendcompleted', null, ['id' => $allocation->id]);
        unset($allocation->timenotifiedendcompleted);
        $allocation->timeend = (string)($now - 10);
        $allocation->timecompleted = null;
        $sink = $this->redirectMessages();
        $this->setCurrentTimeStart();
        $allocation = allocation::update_user($allocation);
        $messages = $sink->get_messages();
        $sink->close();
        $this->assertCount(0, $messages);

        $DB->set_field('enrol_programs_allocations', 'timecompleted', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timeend', null, ['id' => $allocation->id]);
        $DB->set_field('enrol_programs_allocations', 'timenotifiedendcompleted', null, ['id' => $allocation->id]);
        $data = (object)['id' => $program1->id, 'notifyendcompleted' => 0];
        $program1 = program::update_program_notifications($data, false);
    }
}
