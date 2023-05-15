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
 * @covers \enrol_programs\external\source_manual_allocate_users
 */
final class source_manual_allocate_users_test extends \advanced_testcase
{
    public function setUp(): void
    {
        global $CFG;
        require_once("$CFG->dirroot/lib/externallib.php");
        $this->resetAfterTest();
    }

    public function test_execute() {
        global $DB;
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $program1 = $generator->create_program(['sources' => ['manual' => []]]);
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $user4 = $this->getDataGenerator()->create_user();
        $user5 = $this->getDataGenerator()->create_user();
        $user6 = $this->getDataGenerator()->create_user();

        $user7 = $this->getDataGenerator()->create_user();
        $user8 = $this->getDataGenerator()->create_user();
        $user9 = $this->getDataGenerator()->create_user();

        $cohort1 = $this->getDataGenerator()->create_cohort();

        cohort_add_member($cohort1->id, $user4->id);
        cohort_add_member($cohort1->id, $user5->id);
        cohort_add_member($cohort1->id, $user6->id);

        $this->setAdminUser();
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
        $record = $DB->get_record('enrol_programs_allocations', ['userid' => $user7->id, 'programid' => $program1->id]);
        $this->assertSame($timestart, (int) $record->timestart);

        $timeend = time() + (2 * YEARSECS);
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [$user8->id], [], ['timeend' => $timeend]));
        $record = $DB->get_record('enrol_programs_allocations', ['userid' => $user8->id, 'programid' => $program1->id]);
        $this->assertSame($timeend, (int) $record->timeend);

        $timedue = time() + (30 * DAYSECS);
        $timestart = time() + YEARSECS;
        try {
            $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
                source_manual_allocate_users::execute($program1->id, [$user9->id], [], ['timedue' => $timedue, 'timestart' => $timestart]));
            $this->fail('Exception expected');
        } catch (\moodle_exception $exception) {
            $this->assertInstanceOf(\moodle_exception::class, $exception);
            $this->assertSame($exception->getMessage(), 'Invalid date overrides');
        }
        $record = $DB->get_record('enrol_programs_allocations', ['userid' => $user8->id, 'programid' => $program1->id]);
        $this->assertSame($timeend, (int) $record->timeend);

    }

    public function test_execute_tenants() {
        global $DB;
        if (!\enrol_programs\local\tenant::is_available()) {
            $this->markTestSkipped('tenant support not available');
        }

        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        \tool_olms_tenant\tenants::activate_tenants();

        $tenantgenerator = $this->getDataGenerator()->get_plugin_generator('tool_olms_tenant');
        $tenant1 = $tenantgenerator->create_tenant();
        $tenantcontext1 = \context_coursecat::instance($tenant1->categoryid);
        $tenant2 = $tenantgenerator->create_tenant();
        $tenantcontext2 = \context_coursecat::instance($tenant2->categoryid);
        $program1 = $generator->create_program([
            'fullname' => 'Prog 1',
            'contextid' => $tenantcontext1->id,
            'sources' => ['manual' => []]
        ]);

        $program2 = $generator->create_program([
            'fullname' => 'Prog 1',
            'contextid' => $tenantcontext2->id,
            'sources' => ['manual' => []]
        ]);
        $user1 = $this->getDataGenerator()->create_user(['tenantid' => $tenant2->id]);

        $this->setAdminUser();
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [$user1->id]));
        $this->assertEmpty($results);

        $cohort2id = $DB->get_field('cohort', 'id', ['name' => $tenant2->name]);
        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program1->id, [], [$cohort2id]));
        $this->assertEmpty($results);

        $results = source_manual_allocate_users::clean_returnvalue(source_manual_allocate_users::execute_returns(),
            source_manual_allocate_users::execute($program2->id, [], [$cohort2id]));
        $this->assertNotEmpty($results);

    }
}