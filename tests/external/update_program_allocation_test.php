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

/**
 * External API for updating of program allocations
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @runTestsInSeparateProcesses
 * @covers \enrol_programs\external\update_program_allocation
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

        $program1 = $generator->create_program(['fullname' => 'pokus', 'contextid' => $catcontext1->id,
            'sources' => ['manual' => []]]);
        $program2 = $generator->create_program(['fullname' => 'hokus',
            'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $now = time();

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id,
            [$user1->id], ['timestart' => $now - 120, 'timedue' => $now + 60, 'timeend' => $now + 120]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['sourceid' => $source1->id, 'userid' => $user1->id]);

        \enrol_programs\local\source\manual::allocate_users($program2->id, $source2->id,
            [$user2->id], ['timestart' => $now - 1200, 'timedue' => $now + 600, 'timeend' => $now + 1200]);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['sourceid' => $source2->id, 'userid' => $user1->id]);

        $adminroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:admin', CAP_ALLOW, $adminroleid, $syscontext);
        role_assign($adminroleid, $user2->id, $catcontext1->id);

        $this->setUser($user2);

        $result = update_program_allocation::clean_returnvalue(
            update_program_allocation::execute_returns(),
            update_program_allocation::execute($program1->id, $user1->id,
                ['timestart' => $now - 10], true));
        $result = (object)$result;
        $this->assertSame((int)$allocation1->id, $result->id);
        $this->assertSame((int)$source1->id, $result->sourceid);
        $this->assertSame((int)$user1->id, $result->userid);
        $this->assertSame($now - 10, $result->timestart);
        $this->assertSame($now + 60, $result->timedue);
        $this->assertSame($now + 120, $result->timeend);
        $this->assertSame(true, $result->archived);
        $this->assertSame('manual', $result->sourcetype);
        $this->assertSame(true, $result->deletesupported);
        $this->assertSame(true, $result->editsupported);

        $result = update_program_allocation::clean_returnvalue(
            update_program_allocation::execute_returns(),
            update_program_allocation::execute($program1->id, $user1->id,
                ['timestart' => $now - 10, 'timedue' => null, 'timeend' => $now + 60]));
        $result = (object)$result;
        $this->assertSame((int)$allocation1->id, $result->id);
        $this->assertSame($now - 10, $result->timestart);
        $this->assertSame(null, $result->timedue);
        $this->assertSame($now + 60, $result->timeend);
        $this->assertSame(true, $result->archived);

        $result = update_program_allocation::clean_returnvalue(
            update_program_allocation::execute_returns(),
            update_program_allocation::execute($program1->id, $user1->id,
                [], false));
        $result = (object)$result;
        $this->assertSame((int)$allocation1->id, $result->id);
        $this->assertSame($now - 10, $result->timestart);
        $this->assertSame(null, $result->timedue);
        $this->assertSame($now + 60, $result->timeend);
        $this->assertSame(false, $result->archived);

        try {
            update_program_allocation::execute($program1->id, $user1->id,
                ['timestart' => $now - 10, 'timecompleted' => $now], true);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\invalid_parameter_exception::class, $ex);
        }

        try {
            update_program_allocation::execute($program1->id, $user1->id,
                ['timestart' => 0]);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\invalid_parameter_exception::class, $ex);
        }

        try {
            update_program_allocation::execute($program1->id, $user3->id, [], true);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\dml_missing_record_exception::class, $ex);
        }

        try {
            update_program_allocation::execute($program2->id, $user2->id, [], true);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\required_capability_exception::class, $ex);
        }
    }
}
