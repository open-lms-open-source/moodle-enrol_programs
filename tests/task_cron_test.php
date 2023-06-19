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

/**
 * Programs cron test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\task\cron
 */
final class task_cron_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_get_name() {
        $task = new \enrol_programs\task\cron();
        $this->assertNotNull($task->get_name());
    }

    public function test_execute() {
        global $DB;
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $course1 = $this->getDataGenerator()->create_course();
        $context1 = \context_course::instance($course1->id);
        $course2 = $this->getDataGenerator()->create_course();
        $context2 = \context_course::instance($course2->id);
        $course3 = $this->getDataGenerator()->create_course();
        $context3 = \context_course::instance($course3->id);
        $course4 = $this->getDataGenerator()->create_course();
        $context4 = \context_course::instance($course4->id);

        $program1 = $generator->create_program(['sources' => ['manual' => []], 'creategroups' => 1]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $top1 = program::load_content($program1->id);
        $top1->append_course($top1, $course1->id);
        $top1->append_course($top1, $course2->id);
        $top1->append_course($top1, $course3->id);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);

        $this->assertTrue(is_enrolled($context1, $user1, '', true));
        $this->assertTrue(is_enrolled($context2, $user1, '', true));
        $this->assertTrue(is_enrolled($context3, $user1, '', true));

        $candidates = \enrol_programs\local\notification_manager::get_candidate_types($program1->id);
        foreach ($candidates as $type => $name) {
            $generator->create_program_notification(['programid' => $program1->id, 'notificationtype' => $type]);
        }

        delete_course($course3->id, false);
        delete_user($user2);
        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user3->id]);

        // Just make sure there are no obvious errors.
        $this->setAdminUser();
        $task = new \enrol_programs\task\cron();
        $task->execute();
    }
}
