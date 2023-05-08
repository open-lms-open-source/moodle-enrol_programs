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
final class get_programs_test extends \advanced_testcase {
    public function setUp(): void {
        global $CFG;
        require_once("$CFG->dirroot/lib/externallib.php");
        $this->resetAfterTest();
    }

    public function test_get_programs() {

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $admin = get_admin();
        $this->setUser($admin);
        $fieldvalues = [['field' => 'fullname', 'value' => 'hokus']];
        $results = get_programs::execute($fieldvalues);
        $this->assertSame($program1->id, $results[0]->id);
        $this->assertSame($program1->fullname, $results[0]->fullname);
        $results = get_programs::execute([['field' => 'fullname', 'value' => 'pokus']]);
        $this->assertEmpty($results);

    }

    public function test_get_programs_multiparams() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $admin = get_admin();
        $this->setUser($admin);

        $results = get_programs::execute([['field' => 'fullname', 'value' => 'hokus'], ['field' => 'id', 'value' => $program1->id]]);
        $this->assertSame($program1->id, $results[0]->id);
        $this->assertSame($program1->fullname, $results[0]->fullname);
    }

    public function test_get_programs_invalidparams() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $admin = get_admin();
        $this->setUser($admin);
        $this->expectException('invalid_parameter_exception');

        $results = get_programs::execute([['field' => 'arar', 'value' => 'hokus']]);
    }

    public function test_get_programs_list() {

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $program2 = $generator->create_program(['fullname' => 'pokus', 'sources' => ['cohort' => []]]);
        $program3 = $generator->create_program(['fullname' => 'hokuspokus', 'sources' => ['cohort' => [], 'manual' => []]]);
        $admin = get_admin();
        $this->setUser($admin);
        $results = get_programs::execute([['field' => 'contextid', 'value' => 1]]);

        $this->assertSame($program1->id, $results[0]->id);
        $this->assertSame($program1->fullname, $results[0]->fullname);
        $this->assertSame($results[0]->sources[0], 'manual');
        $this->assertSame($program2->id, $results[1]->id);
        $this->assertSame($program2->fullname, $results[1]->fullname);
        $this->assertSame($results[1]->sources[0], 'cohort');
        $this->assertSame($program3->id, $results[2]->id);
        $this->assertSame($program3->fullname, $results[2]->fullname);
        $this->assertContains('cohort', $results[2]->sources);
        $this->assertContains('manual', $results[2]->sources);

    }

    public function test_get_programs_api_tenants() {
        if (!\enrol_programs\local\tenant::is_available()) {
            $this->markTestSkipped('tenant support not available');
        }

        \tool_olms_tenant\tenants::activate_tenants();

        /** @var \tool_olms_tenant_generator $generator */
        $tenantgenerator = $this->getDataGenerator()->get_plugin_generator('tool_olms_tenant');

        $tenant1 = $tenantgenerator->create_tenant();
        $user1 = $this->getDataGenerator()->create_user(['tenantid' => $tenant1->id]);
        $catcontext1 = \context_coursecat::instance($tenant1->categoryid);
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $program2 = $generator->create_program(['fullname' => 'pokus', 'contextid' => $catcontext1->id, 'sources' => ['manual' => []]]);
        $admin = get_admin();
        $this->setUser($admin);
        $results = get_programs::execute([['field' => 'tenantid', 'value' => $tenant1->id], ['field' => 'fullname', 'value' => 'pokus']]);
        $this->assertCount(1, $results);
        $this->assertSame($program2->fullname, $results[0]->fullname);
    }
}