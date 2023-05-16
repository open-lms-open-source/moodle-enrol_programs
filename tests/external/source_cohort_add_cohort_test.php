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

use enrol_programs\local\program;

/**
 * External API for adding cohort to the list or cohorts that are synced with the program.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @runTestsInSeparateProcesses
 * @covers \enrol_programs\external\source_cohort_add_cohort
 */
final class source_cohort_add_cohort_test extends \advanced_testcase {
    public function setUp(): void
    {
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
        $cohort2 = $this->getDataGenerator()->create_cohort();
        $cohort3 = $this->getDataGenerator()->create_cohort();

        $program1 = $generator->create_program([
            'contextid' => $catcontext1->id,
            'sources' => ['cohort' => ['cohorts' => [$cohort1->id]]]
        ]);
        $source1c = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'cohort'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();

        $viewerroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:view', CAP_ALLOW, $viewerroleid, $syscontext);
        role_assign($viewerroleid, $user1->id, $catcontext1->id);

        $this->setUser($user1);

        $cohorts = $DB->get_records('enrol_programs_src_cohorts', ['sourceid' => $source1c->id]);
        $this->assertCount(1, $cohorts);

        $result = source_cohort_add_cohort::clean_returnvalue(source_cohort_add_cohort::execute_returns(),
            source_cohort_add_cohort::execute($program1->id, $cohort2->id));

        $this->assertCount(2, $result);
        $result = (object) $result[1];
        $this->assertSame((int) $cohort2->id, $result->id);

        $cohorts = $DB->get_records('enrol_programs_src_cohorts', ['sourceid' => $source1c->id]);
        $this->assertCount(2, $cohorts);

        $this->setUser($user2);
        try {
            $result = source_cohort_add_cohort::clean_returnvalue(source_cohort_add_cohort::execute_returns(),
                source_cohort_add_cohort::execute($program1->id, $cohort3->id));
            $this->fail('Exception excepted');
        } catch (\moodle_exception $exception) {
            $this->assertInstanceOf(\required_capability_exception::class, $exception);
            $this->assertSame('Sorry, but you do not currently have permissions to do that (View program management).', $exception->getMessage());
        }

    }
}