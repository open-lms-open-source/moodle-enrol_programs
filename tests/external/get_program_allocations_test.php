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
 * External API for get program list
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\external\get_programs
 */
final class get_program_allocations_test extends \advanced_testcase {
    public function setUp(): void {
        global $CFG;
        require_once("$CFG->dirroot/lib/externallib.php");
        $this->resetAfterTest();
    }

    public function test_get_program_allocations_test() {
        global $DB;
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $program2 = $generator->create_program(['fullname' => 'pokus', 'sources' => ['manual' => [], 'selfallocation' => []], 'public' => 1]);
        $source2a = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'selfallocation'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1->id, [$user1->id, $user2->id]);

        $this->setAdminUser();

        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(), get_program_allocations::execute($program1->id, []));

        $this->assertCount(2, $results);
        $this->assertSame($results[0]['userid'], (int) $user1->id);
        $this->assertSame($results[1]['userid'], (int) $user2->id);
        $this->assertSame($results[1]['sourcename'], 'manual');

        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(), get_program_allocations::execute($program1->id, [$user1->id]));
        $this->assertCount(1, $results);
        $results =get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(), get_program_allocations::execute($program1->id, [$user1->id, $user3->id]));
        $this->assertCount(1, $results);

        $this->setUser($user4);
        $allocation = selfallocation::signup($program2->id, $source2a->id);

        $this->setAdminUser();
        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(), get_program_allocations::execute($program2->id, [$user4->id]));
        $this->assertSame($results[0]['sourcename'], 'selfallocation');
        $this->assertSame($results[0]['userid'], (int) $user4->id);

        $completiontime = (string) time();
        $allocation->timecompleted = $completiontime;
        $DB->update_record('enrol_programs_allocations', $allocation);

        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(), get_program_allocations::execute($program2->id, [$user4->id]));
        $this->assertSame($results[0]['timecompleted'], (int) $completiontime);
    }

}
