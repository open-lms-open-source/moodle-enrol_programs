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
 * External API for form import program allocation
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @runTestsInSeparateProcesses
 * @covers \enrol_programs\external\form_program_allocation_import_fromprogram
 */
final class form_program_allocation_import_fromprogram_test extends \advanced_testcase {
    public function setUp(): void {
        global $CFG;
        require_once("$CFG->dirroot/lib/externallib.php");
        $this->resetAfterTest();
    }

    public function test_execute() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $syscontext = \context_system::instance();
        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);

        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();

        $program1 = $generator->create_program([
            'fullname' => 'hokus',
            'idnumber' => 'p1',
            'description' => 'some desc 1',
            'descriptionformat' => FORMAT_MARKDOWN,
            'public' => 1,
            'archived' => 0,
            'contextid' => $syscontext->id,
            'sources' => ['manual' => []],
            'cohorts' => [$cohort1->id],
        ]);
        $program2 = $generator->create_program([
            'fullname' => 'pokus',
            'idnumber' => 'p2',
            'description' => '<b>some desc 2</b>',
            'descriptionformat' => FORMAT_HTML,
            'public' => 0,
            'archived' => 0,
            'contextid' => $catcontext1->id,
            'sources' => ['manual' => [], 'cohort' => []],
            'cohorts' => [$cohort1->id, $cohort2->id],
        ]);
        $program3 = $generator->create_program([
            'fullname' => 'Prog3',
            'idnumber' => 'p3',
            'public' => 1,
            'archived' => 1,
            'contextid' => $syscontext->id,
            'sources' => ['manual' => []]
        ]);

        $user1 = $this->getDataGenerator()->create_user();

        $this->setAdminUser();
        $response = form_program_allocation_import_fromprogram::execute ('', $program1->id);
        $results = form_program_allocation_import_fromprogram::clean_returnvalue(form_program_allocation_import_fromprogram::execute_returns(), $response);
        $this->assertSame(null, $results['notice']);
        $this->assertCount(2, $results['list']);

        $this->setUser($user1);
        try {
            $response = form_program_allocation_import_fromprogram::execute ('', $program1->id);
            $this->fail('Exception excepted');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\required_capability_exception::class, $ex);
            $this->assertSame('Sorry, but you do not currently have permissions to do that (Add and update programs).',
                $ex->getMessage());
        }
    }

    public function test_execute_tenant() {
        global $DB, $CFG;
        if (!\enrol_programs\local\tenant::is_available()) {
            $this->markTestSkipped('tenant support not available');
        }

        \tool_olms_tenant\tenants::activate_tenants();

        /** @var \tool_olms_tenant_generator $generator */
        $tenantgenerator = $this->getDataGenerator()->get_plugin_generator('tool_olms_tenant');

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $tenant1 = $tenantgenerator->create_tenant();
        $tenant1context = \context_tenant::instance($tenant1->id);
        $tenant1catcontext = \context_coursecat::instance($tenant1->categoryid);
        $tenant2 = $tenantgenerator->create_tenant();
        $tenant2context = \context_tenant::instance($tenant2->id);
        $tenant2catcontext = \context_coursecat::instance($tenant2->categoryid);

        $program0 = $generator->create_program(['fullname' => 'prg0', 'sources' => ['manual' => []]]);
        $source0 = $DB->get_record('enrol_programs_sources', ['programid' => $program0->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program1 = $generator->create_program(['idnumber' => 'prg2', 'contextid' => $tenant1catcontext->id, 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program2 = $generator->create_program(['idnumber' => 'prg3', 'contextid' => $tenant2catcontext->id, 'sources' => ['manual' => []]]);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);
        $program3 = $generator->create_program(['idnumber' => 'prg4', 'contextid' => $tenant1catcontext->id, 'sources' => ['manual' => []]]);

        $admin = get_admin();
        $user0 = $this->getDataGenerator()->create_user(['lastname' => 'Prijmeni 1', 'tenantid' => 0]);
        $user1 = $this->getDataGenerator()->create_user(['lastname' => 'Prijmeni 1', 'tenantid' => $tenant1->id]);
        $user2 = $this->getDataGenerator()->create_user(['lastname' => 'Prijmeni 2', 'tenantid' => $tenant2->id]);

        $syscontext = \context_system::instance();
        $editorroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:edit', CAP_ALLOW, $editorroleid, $syscontext);
        assign_capability('enrol/programs:clone', CAP_ALLOW, $editorroleid, $syscontext);
        role_assign($editorroleid, $user1->id, $tenant1catcontext->id);


        $this->setAdminUser();
        $response = form_program_allocation_import_fromprogram::execute('', $program0->id);
        $this->assertCount(3, $response['list']);

        $this->setUser($user0);
        try {
            $response = form_program_allocation_import_fromprogram::execute ('', $program1->id);
            $this->fail('Exception excepted');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\required_capability_exception::class, $ex);
            $this->assertSame('Sorry, but you do not currently have permissions to do that (Add and update programs).',
                $ex->getMessage());
        }

        $this->setUser($user1);
        $response = form_program_allocation_import_fromprogram::execute ('', $program1->id);
        $this->assertCount(1, $response['list']);
        $program3resp = array_pop($response['list']);
        $this->assertSame($program3->id, $program3resp['value']);
        $this->assertSame($program3->fullname, $program3resp['label']);
    }
}
