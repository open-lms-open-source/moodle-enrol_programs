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

namespace enrol_programs\external;

use enrol_programs\local\source\selfallocation;

/**
 * External API for get program allocations
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @runTestsInSeparateProcesses
 * @covers \enrol_programs\external\get_program_allocations
 */
final class update_program_allocation_test extends \advanced_testcase {
    public function setUp(): void {
        global $CFG;
        require_once("$CFG->dirroot/lib/externallib.php");
        $this->resetAfterTest();
    }

    public function test_execute() {
        global $DB;
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $syscontext = \context_system::instance();
        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);

        $cohort1 = $this->getDataGenerator()->create_cohort();

        $program1 = $generator->create_program(
            ['sources' => ['manual' => [], 'selfallocation' => []], 'public' => 1, 'contextid' => $catcontext1->id]);
        $source1m = $DB->get_record('enrol_programs_sources',
            ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1s = $DB->get_record('enrol_programs_sources',
            ['programid' => $program1->id, 'type' => 'selfallocation'], '*', MUST_EXIST);
        $program2 = $generator->create_program(
            ['sources' => ['manual' => [], 'cohort' => ['cohorts' => [$cohort1->id]]]]);
        $source2 = $DB->get_record('enrol_programs_sources',
            ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        cohort_add_member($cohort1->id, $user4->id);

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1m->id, [$user2->id, $user3->id]);

        $viewerroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:admin', CAP_ALLOW, $viewerroleid, $syscontext);
        role_assign($viewerroleid, $user1->id, $catcontext1->id);

        $this->setUser($user1->id);

        $timestart = time() + YEARSECS;

        $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
            update_program_allocation::execute($program1->id, $user2->id, ['timestart' => $timestart], true));

        $result = (object) $result;

        $this->assertSame((int) $program1->id, $result->programid);
        $this->assertSame((int) $user2->id, $result->userid);
        $this->assertSame((int) $result->timestart, $timestart);
        $this->assertTrue($result->archived);

        $timedue = time() + YEARSECS + (7 * DAYSECS);
        $timeend = time() + YEARSECS + (30 * DAYSECS);
        $timecompleted = time() + YEARSECS + (6 * DAYSECS);
        $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
            update_program_allocation::execute($program1->id, $user2->id,
                ['timedue' => $timedue, 'timeend' => $timeend, 'timecompleted' => $timecompleted], false));

        $result = (object) $result;

        $this->assertSame((int) $program1->id, $result->programid);
        $this->assertSame((int) $user2->id, $result->userid);
        $this->assertSame((int) $source1m->id, $result->sourceid);
        $this->assertSame((int) $result->timedue, $timedue);
        $this->assertSame((int) $result->timeend, $timeend);
        $this->assertSame((int) $result->timestart, $timestart);
        $this->assertSame((int) $result->timecompleted, $timecompleted);
        $this->assertSame('manual', $result->sourcetype);
        $this->assertFalse($result->archived);

        $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
            update_program_allocation::execute($program1->id, $user2->id, [], true));

        $result = (object) $result;
        $this->assertTrue($result->archived);

        $this->setUser($user3);

        try {
            $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
                update_program_allocation::execute($program1->id, $user2->id, ['timedue' => $timedue, 'timeend' => $timeend], false));
            $this->fail('Exception expected');
        } catch (\moodle_exception $exception) {
            $this->assertInstanceOf(\required_capability_exception::class, $exception);
            $this->assertSame('Sorry, but you do not currently have permissions to do that (Advanced program administration).', $exception->getMessage());
        }

        \enrol_programs\local\source\manual::allocate_users($program2->id, $source2->id, [$user3->id]);
        $this->setUser($user1);

        try {
            $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
                update_program_allocation::execute($program2->id, $user3->id, [], true));
            $this->fail('Exception expected');
        } catch (\moodle_exception $exception) {
            $this->assertInstanceOf(\required_capability_exception::class, $exception);
            $this->assertSame('Sorry, but you do not currently have permissions to do that (Advanced program administration).', $exception->getMessage());
        }

        $this->setUser($user4);
        selfallocation::signup($program1->id, $source1s->id);

        $this->setAdminUser();
        $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
            update_program_allocation::execute($program2->id, $user4->id, [], true));
        $result = (object) $result;
        $this->assertTrue($result->archived);

        $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
            update_program_allocation::execute($program2->id, $user4->id, [], false));
        $result = (object) $result;
        $this->assertFalse($result->archived);

        try {
            $result = update_program_allocation::clean_returnvalue(update_program_allocation::execute_returns(),
                update_program_allocation::execute($program2->id, $user1->id, [], false));
            $this->fail('Exception expected');
        } catch (\moodle_exception $exception) {
            $this->assertInstanceOf(\moodle_exception::class, $exception);
            $this->assertSame('Program is not allocated', $exception->getMessage());
        }

    }
}
