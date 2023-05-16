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
 * Tests for external source delete program allocation users.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @runTestsInSeparateProcesses
 * @covers \enrol_programs\external\delete_program_allocations_test
 */
final class delete_program_allocations_test extends \advanced_testcase {
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
            ['sources' => ['manual' => [], 'selfallocation' => []], 'public' => 1]);
        $source1m = $DB->get_record('enrol_programs_sources',
            ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1s = $DB->get_record('enrol_programs_sources',
            ['programid' => $program1->id, 'type' => 'selfallocation'], '*', MUST_EXIST);
        $program2 = $generator->create_program(
            ['sources' => ['manual' => [], 'cohort' => ['cohorts' => [$cohort1->id]]], 'contextid' => $catcontext1->id]);
        $source2 = $DB->get_record('enrol_programs_sources',
            ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $user5 = $this->getDataGenerator()->create_user();

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1m->id, [$user1->id, $user2->id]);
        $this->setUser($user3);
        selfallocation::signup($program1->id, $source1s->id);
        $this->setUser(null);
        \enrol_programs\local\source\manual::allocate_users($program2->id, $source2->id, [$user1->id, $user3->id]);
        cohort_add_member($cohort1->id, $user4->id);

        $allocatorroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:allocate', CAP_ALLOW, $allocatorroleid, $syscontext);
        role_assign($allocatorroleid, $user1->id, $syscontext->id);
        role_assign($allocatorroleid, $user2->id, $catcontext1->id);

        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user2->id, 'programid' => $program1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user4->id, 'programid' => $program2->id]));

        $this->setUser($user1);
        $result = delete_program_allocations::clean_returnvalue(delete_program_allocations::execute_returns(),
            delete_program_allocations::execute($program1->id, [$user1->id, $user3->id, $user5->id]));
        $this->assertSame([(int)$user1->id, (int)$user3->id], $result);
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user2->id, 'programid' => $program1->id]));
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user4->id, 'programid' => $program2->id]));

        $this->setUser($user2);
        $result = delete_program_allocations::clean_returnvalue(delete_program_allocations::execute_returns(),
            delete_program_allocations::execute($program2->id, [$user1->id]));
        $this->assertSame([(int)$user1->id], $result);
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program1->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user2->id, 'programid' => $program1->id]));
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program1->id]));
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user4->id, 'programid' => $program2->id]));

        $this->setUser($user2);
        try {
            delete_program_allocations::execute($program1->id, [$user2->id]);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\required_capability_exception::class, $ex);
        }
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user2->id, 'programid' => $program1->id]));

        $this->setUser($user2);
        try {
            delete_program_allocations::execute($program2->id, [$user2->id, $user4->id]);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\invalid_parameter_exception::class, $ex);
        }
        $this->assertFalse($DB->record_exists('enrol_programs_allocations', ['userid' => $user1->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user3->id, 'programid' => $program2->id]));
        $this->assertTrue($DB->record_exists('enrol_programs_allocations', ['userid' => $user4->id, 'programid' => $program2->id]));
    }
}
