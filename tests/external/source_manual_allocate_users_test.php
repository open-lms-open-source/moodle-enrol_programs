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
 * Tests for external source manual allocate users.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @runTestsInSeparateProcesses
 * @covers \enrol_programs\external\source_manual_allocate_users
 */
final class source_manual_allocate_users_test extends \advanced_testcase {
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

        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $program2 = $generator->create_program(['contextid' => $catcontext1->id, 'sources' => ['manual' => []]]);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();
        $user5 = $this->getDataGenerator()->create_user();
        $user6 = $this->getDataGenerator()->create_user();
        $user7 = $this->getDataGenerator()->create_user();
        $user8 = $this->getDataGenerator()->create_user();
        $user9 = $this->getDataGenerator()->create_user();

        $viewerroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:allocate', CAP_ALLOW, $viewerroleid, $syscontext);
        assign_capability('moodle/cohort:view', CAP_ALLOW, $viewerroleid, $syscontext);
        role_assign($viewerroleid, $user1->id, $syscontext->id);
        role_assign($viewerroleid, $user2->id, $catcontext1->id);

        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort(['contextid' => $catcontext1->id]);

        cohort_add_member($cohort1->id, $user4->id);
        cohort_add_member($cohort1->id, $user5->id);
        cohort_add_member($cohort1->id, $user6->id);
        cohort_add_member($cohort2->id, $user7->id);

        $this->setUser($user1);
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [$user1->id, $user2->id]));
        $this->assertCount(2, $results);
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [$user1->id, $user2->id, $user3->id]));
        $this->assertCount(1, $results);
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [], [$cohort1->id]));
        $this->assertCount(3, $results);

        $timestart = time() + YEARSECS;
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [$user7->id], [], ['timestart' => $timestart]));
        $this->assertCount(1, $results);
        $record = $DB->get_record('enrol_programs_allocations', ['userid' => $user7->id, 'programid' => $program1->id]);
        $this->assertSame($timestart, (int)$record->timestart);

        $timeend = time() + (2 * YEARSECS);
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [$user8->id], [], ['timeend' => $timeend]));
        $this->assertCount(1, $results);
        $record = $DB->get_record('enrol_programs_allocations', ['userid' => $user8->id, 'programid' => $program1->id]);
        $this->assertSame($timeend, (int)$record->timeend);

        $timedue = time() + (30 * DAYSECS);
        $timestart = time() + YEARSECS;
        try {
            source_manual_allocate_users::execute($program1->id, [$user9->id], [], ['timedue' => $timedue, 'timestart' => $timestart]);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\invalid_parameter_exception::class, $ex);
            $this->assertSame('Invalid program allocation dates', $ex->debuginfo);
        }
        $record = $DB->get_record('enrol_programs_allocations', ['userid' => $user8->id, 'programid' => $program1->id]);
        $this->assertSame($timeend, (int)$record->timeend);

        $this->setUser($user3);
        try {
            source_manual_allocate_users::execute($program1->id, [], [$cohort1->id]);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\required_capability_exception::class, $ex);
            $this->assertSame('Sorry, but you do not currently have permissions to do that (Allocate students to programs).',
                $ex->getMessage());
        }

        $this->setUser($user2);
        $results = source_manual_allocate_users::execute($program2->id, [], [$cohort2->id]);
        $this->assertCount(1, $results);

        $this->setAdminUser();
        \enrol_programs\local\program::update_program_general((object)['id' => $program1->id, 'archived' => 1]);
        try {
            source_manual_allocate_users::execute($program1->id, [], [$cohort1->id]);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\invalid_parameter_exception::class, $ex);
            $this->assertSame('Program is archived', $ex->debuginfo);
        }
    }

    public function test_execute_tenants() {
        global $DB;
        if (!\enrol_programs\local\tenant::is_available()) {
            $this->markTestSkipped('tenant support not available');
        }

        /** @var \tool_olms_tenant_generator $generator */
        $tenantgenerator = $this->getDataGenerator()->get_plugin_generator('tool_olms_tenant');
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        \tool_olms_tenant\tenants::activate_tenants();

        $tenant1 = $tenantgenerator->create_tenant();
        $tenantcontext1 = \context_coursecat::instance($tenant1->categoryid);
        $tenant2 = $tenantgenerator->create_tenant();
        $tenantcontext2 = \context_coursecat::instance($tenant2->categoryid);
        $program0 = $generator->create_program([
            'fullname' => 'Prog 0',
            'sources' => ['manual' => []]
        ]);
        $program1 = $generator->create_program([
            'fullname' => 'Prog 1',
            'contextid' => $tenantcontext1->id,
            'sources' => ['manual' => []]
        ]);
        $program2 = $generator->create_program([
            'fullname' => 'Prog 2',
            'contextid' => $tenantcontext2->id,
            'sources' => ['manual' => []]
        ]);

        $user0 = $this->getDataGenerator()->create_user(['tenantid' => null]);
        $user1 = $this->getDataGenerator()->create_user(['tenantid' => $tenant1->id]);
        $user2 = $this->getDataGenerator()->create_user(['tenantid' => $tenant2->id]);

        $this->setAdminUser();

        $results = source_manual_allocate_users::execute($program0->id, [$user0->id, $user1->id, $user2->id]);
        $this->assertCount(3, $results);
        $this->assertContainsEquals($user0->id, $results);
        $this->assertContainsEquals($user1->id, $results);
        $this->assertContainsEquals($user2->id, $results);

        $DB->delete_records('enrol_programs_allocations', []);

        $results = source_manual_allocate_users::execute($program1->id, [$user0->id, $user1->id]);
        $this->assertCount(2, $results);
        $this->assertContainsEquals($user0->id, $results);
        $this->assertContainsEquals($user1->id, $results);

        try {
            source_manual_allocate_users::execute($program1->id, [$user2->id]);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\invalid_parameter_exception::class, $ex);
            $this->assertSame('Tenant mismatch', $ex->debuginfo);
        }
    }
}
