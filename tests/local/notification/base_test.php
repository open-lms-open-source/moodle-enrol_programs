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
 * Program notifications base test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\notification\base
 */
final class base_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_constants() {
        $this->assertGreaterThan(0, base::get_time_soon());
        $this->assertGreaterThan(0, base::TIME_CUTOFF);
    }

    public function test_get_allocation_placeholders() {
        global $DB, $CFG;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $program2 = $generator->create_program(['sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $related1 = $this->getDataGenerator()->create_user();

        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $strnotset = get_string('notset', 'enrol_programs');

        $result = base::get_allocation_placeholders($program1, $source1, $allocation, $user1);
        $this->assertIsArray($result);
        $this->assertSame(fullname($user1), $result['user_fullname']);
        $this->assertSame($user1->firstname, $result['user_firstname']);
        $this->assertSame($user1->lastname, $result['user_lastname']);
        $this->assertSame($program1->fullname, $result['program_fullname']);
        $this->assertSame($program1->idnumber, $result['program_idnumber']);
        $this->assertSame("$CFG->wwwroot/enrol/programs/my/program.php?id=$program1->id", $result['program_url']);
        $this->assertSame('Manual allocation', $result['program_sourcename']);
        $this->assertSame('Open', $result['program_status']);
        $this->assertSame(userdate($allocation->timeallocated), $result['program_allocationdate']);
        $this->assertSame(userdate($allocation->timestart), $result['program_startdate']);
        $this->assertSame($strnotset, $result['program_duedate']);
        $this->assertSame($strnotset, $result['program_enddate']);
        $this->assertSame($strnotset, $result['program_completeddate']);

        $result = base::get_allocation_placeholders($program1, $source1, $allocation, $user1, $related1);
        $this->assertIsArray($result);
        $this->assertSame(fullname($user1), $result['user_fullname']);
        $this->assertSame($user1->firstname, $result['user_firstname']);
        $this->assertSame($user1->lastname, $result['user_lastname']);
        $this->assertSame(fullname($related1), $result['relateduser_fullname']);
        $this->assertSame($related1->firstname, $result['relateduser_firstname']);
        $this->assertSame($related1->lastname, $result['relateduser_lastname']);
        $this->assertSame($program1->fullname, $result['program_fullname']);
        $this->assertSame($program1->idnumber, $result['program_idnumber']);
        $this->assertSame("$CFG->wwwroot/enrol/programs/catalogue/program.php?id=$program1->id", $result['program_url']);
        $this->assertSame('Manual allocation', $result['program_sourcename']);
        $this->assertSame('Open', $result['program_status']);
        $this->assertSame(userdate($allocation->timeallocated), $result['program_allocationdate']);
        $this->assertSame(userdate($allocation->timestart), $result['program_startdate']);
        $this->assertSame($strnotset, $result['program_duedate']);
        $this->assertSame($strnotset, $result['program_enddate']);
        $this->assertSame($strnotset, $result['program_completeddate']);

        $now = time();
        $allocation->archived = '0';
        $allocation->timeallocated = (string)$now;
        $allocation->timestart = (string)($now - 60 * 60 * 24 * 1);
        $allocation->timedue = (string)($now + 60 * 60 * 24 * 10);
        $allocation->timeend = (string)($now + 60 * 60 * 24 * 20);
        $allocation->timecompleted = (string)($now + 60 * 60 * 24 * 1);
        allocation::update_user($allocation);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $result = base::get_allocation_placeholders($program1, $source1, $allocation, $user1);
        $this->assertIsArray($result);
        $this->assertSame(fullname($user1), $result['user_fullname']);
        $this->assertSame($user1->firstname, $result['user_firstname']);
        $this->assertSame($user1->lastname, $result['user_lastname']);
        $this->assertSame($program1->fullname, $result['program_fullname']);
        $this->assertSame($program1->idnumber, $result['program_idnumber']);
        $this->assertSame("$CFG->wwwroot/enrol/programs/my/program.php?id=$program1->id", $result['program_url']);
        $this->assertSame('Manual allocation', $result['program_sourcename']);
        $this->assertSame('Completed', $result['program_status']);
        $this->assertSame(userdate($allocation->timeallocated), $result['program_allocationdate']);
        $this->assertSame(userdate($allocation->timestart), $result['program_startdate']);
        $this->assertSame(userdate($allocation->timedue), $result['program_duedate']);
        $this->assertSame(userdate($allocation->timeend), $result['program_enddate']);
        $this->assertSame(userdate($allocation->timecompleted), $result['program_completeddate']);
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

        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $this->setUser(null);
        $result = base::get_notifier($program1, $allocation1);
        $this->assertSame(-10, $result->id);

        $this->setUser($user2);
        $result = base::get_notifier($program1, $allocation1);
        $this->assertSame(-10, $result->id);
    }

    function test_get_relateduser_fieldid() {
        $this->assertNull(base::get_relateduser_fieldid());

        if (!get_config('profilefield_relateduser', 'version')) {
            $this->markTestSkipped('profilefield_relateduser not installed');
        }

        /** @var \profilefield_relateduser_generator $relatedgenerator */
        $relatedgenerator = $this->getDataGenerator()->get_plugin_generator('profilefield_relateduser');

        $this->assertNull(base::get_relateduser_fieldid());

        $categoryid = $relatedgenerator->add_profile_category();
        $profilefieldid1 = $relatedgenerator->add_profile_field($categoryid, 'relateduser');
        $profilefieldid2 = $relatedgenerator->add_profile_field($categoryid, 'relateduser');

        $this->assertNull(base::get_relateduser_fieldid());

        set_config('notification_relateduserfield', $profilefieldid1, 'enrol_programs');
        $this->assertSame($profilefieldid1, base::get_relateduser_fieldid());

        unset_config('version', 'profilefield_relateduser');
        $this->assertNull(base::get_relateduser_fieldid());
    }

    public function test_get_relateduser() {
        if (!get_config('profilefield_relateduser', 'version')) {
            $this->markTestSkipped('profilefield_relateduser not installed');
        }

        /** @var \profilefield_relateduser_generator $relatedgenerator */
        $relatedgenerator = $this->getDataGenerator()->get_plugin_generator('profilefield_relateduser');

        $categoryid = $relatedgenerator->add_profile_category();
        $profilefieldid = $relatedgenerator->add_profile_field($categoryid, 'relateduser');
        $profilefieldid2 = $relatedgenerator->add_profile_field($categoryid, 'relateduser');

        $related1 = $this->getDataGenerator()->create_user();
        $related2 = $this->getDataGenerator()->create_user();

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $this->assertNull(base::get_relateduser($user1->id));
        $this->assertNull(base::get_relateduser($user2->id));
        $this->assertNull(base::get_relateduser($user3->id));

        set_config('notification_relateduserfield', $profilefieldid, 'enrol_programs');
        $this->assertNull(base::get_relateduser($user1->id));
        $this->assertNull(base::get_relateduser($user2->id));
        $this->assertNull(base::get_relateduser($user3->id));

        $relatedgenerator->add_user_info_data($user1->id, $profilefieldid, $related1->id);
        $relatedgenerator->add_user_info_data($user2->id, $profilefieldid, $related2->id);
        $this->assertSame((array)$related1, (array)base::get_relateduser($user1->id));
        $this->assertSame((array)$related2, (array)base::get_relateduser($user2->id));
        $this->assertNull(base::get_relateduser($user3->id));
    }
}