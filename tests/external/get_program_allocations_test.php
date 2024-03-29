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
final class get_program_allocations_test extends \advanced_testcase {
    public function setUp(): void {
        global $CFG;
        require_once("$CFG->dirroot/lib/externallib.php");
        $this->resetAfterTest();
    }

    public function test_get_program_allocations_test() {
        global $DB;
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $syscontext = \context_system::instance();
        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);

        $program1 = $generator->create_program(['fullname' => 'pokus', 'contextid' => $catcontext1->id, 'public' => 1,
            'sources' => ['manual' => [], 'selfallocation' => []]]);
        $program2 = $generator->create_program(['fullname' => 'hokus',
            'sources' => ['manual' => []]]);
        $program3 = $generator->create_program(['fullname' => 'abraka',
            'sources' => ['manual' => []]]);
        $source1a = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);
        $source1b = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'selfallocation'], '*', MUST_EXIST);
        $source2 = $DB->get_record('enrol_programs_sources', ['programid' => $program2->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();
        $user4 = $this->getDataGenerator()->create_user();

        \enrol_programs\local\source\manual::allocate_users($program1->id, $source1a->id, [$user1->id, $user2->id]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['sourceid' => $source1a->id, 'userid' => $user1->id]);
        $allocation2 = $DB->get_record('enrol_programs_allocations', ['sourceid' => $source1a->id, 'userid' => $user2->id]);
        $allocation2->timecompleted = (string)time();
        $DB->update_record('enrol_programs_allocations', $allocation2);
        $this->setUser($user4);
        $allocation3 = selfallocation::signup($program1->id, $source1b->id);
        $this->setUser(null);
        \enrol_programs\local\source\manual::allocate_users($program2->id, $source2->id, [$user2->id]);

        $viewerroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:view', CAP_ALLOW, $viewerroleid, $syscontext);
        role_assign($viewerroleid, $user1->id, $catcontext1->id);

        $this->setUser($user1->id);

        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(),
            get_program_allocations::execute($program1->id));
        $this->assertCount(3, $results);
        $result = (object)$results[0];
        $this->assertSame((int)$allocation1->id, $result->id);
        $this->assertSame((int)$allocation1->programid, $result->programid);
        $this->assertSame((int)$allocation1->sourceid, $result->sourceid);
        $this->assertSame((int)$allocation1->userid, $result->userid);
        $this->assertSame((bool)$allocation1->archived, $result->archived);
        $this->assertSame($allocation1->sourcedatajson, $result->sourcedatajson);
        $this->assertSame(null, $result->sourceinstanceid);
        $this->assertSame((int)$allocation1->timeallocated, $result->timeallocated);
        $this->assertSame((int)$allocation1->timestart, $result->timestart);
        $this->assertSame(null, $result->timedue);
        $this->assertSame(null, $result->timeend);
        $this->assertSame(null, $result->timecompleted);
        $this->assertSame((int)$allocation1->timecreated, $result->timecreated);
        $this->assertSame('manual', $result->sourcetype);
        $this->assertSame(true, $result->deletesupported);
        $this->assertSame(true, $result->editsupported);
        $result = (object)$results[1];
        $this->assertSame((int)$allocation2->id, $result->id);
        $this->assertSame((int)$allocation2->programid, $result->programid);
        $this->assertSame((int)$allocation2->sourceid, $result->sourceid);
        $this->assertSame((int)$allocation2->userid, $result->userid);
        $this->assertSame((int)$allocation2->timecompleted, $result->timecompleted);
        $this->assertSame('manual', $result->sourcetype);
        $this->assertSame(true, $result->deletesupported);
        $this->assertSame(true, $result->editsupported);
        $result = (object)$results[2];
        $this->assertSame((int)$allocation3->id, $result->id);
        $this->assertSame((int)$allocation3->programid, $result->programid);
        $this->assertSame((int)$allocation3->sourceid, $result->sourceid);
        $this->assertSame((int)$allocation3->userid, $result->userid);
        $this->assertSame(null, $result->timecompleted);
        $this->assertSame('selfallocation', $result->sourcetype);
        $this->assertSame(true, $result->deletesupported);
        $this->assertSame(true, $result->editsupported);

        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(),
            get_program_allocations::execute($program1->id, []));
        $this->assertCount(3, $results);

        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(),
            get_program_allocations::execute($program1->id, [$user1->id, $user3->id]));
        $this->assertCount(1, $results);
        $result = (object)$results[0];
        $this->assertSame((int)$allocation1->id, $result->id);
        $this->assertSame((int)$allocation1->programid, $result->programid);
        $this->assertSame((int)$allocation1->sourceid, $result->sourceid);
        $this->assertSame((int)$allocation1->userid, $result->userid);

        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(),
            get_program_allocations::execute($program1->id, [$user3->id]));
        $this->assertCount(0, $results);

        try {
            get_program_allocations::execute($program2->id);
            $this->fail('Exception expected');
        } catch (\moodle_exception $ex) {
            $this->assertInstanceOf(\required_capability_exception::class, $ex);
            $this->assertSame('Sorry, but you do not currently have permissions to do that (View program management).', $ex->getMessage());
        }

        $this->setAdminUser();
        $results = get_program_allocations::clean_returnvalue(
            get_program_allocations::execute_returns(),
            get_program_allocations::execute($program3->id));
        $this->assertCount(0, $results);
    }
}
