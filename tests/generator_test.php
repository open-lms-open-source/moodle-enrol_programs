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

namespace enrol_programs;

use enrol_programs\local\program;
use enrol_programs\local\util;
use enrol_programs\local\content\course;
use enrol_programs\local\content\set;

/**
 * Program generator test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs_generator
 */
final class generator_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_create_program() {
        global $DB;

        $syscontext = \context_system::instance();

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $this->assertInstanceOf('enrol_programs_generator', $generator);

        $this->setCurrentTimeStart();
        $program = $generator->create_program([]);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame((string)$syscontext->id, $program->contextid);
        $this->assertSame('Program 1', $program->fullname);
        $this->assertSame('prg1', $program->idnumber);
        $this->assertSame('', $program->description);
        $this->assertSame('1', $program->descriptionformat);
        $this->assertSame('[]', $program->presentationjson);
        $this->assertSame('0', $program->public);
        $this->assertSame('0', $program->archived);
        $this->assertSame('0', $program->creategroups);
        $this->assertSame(null, $program->timeallocationstart);
        $this->assertSame(null, $program->timeallocationend);
        $this->assertSame('{"type":"allocation"}', $program->startdatejson);
        $this->assertSame('{"type":"notset"}', $program->duedatejson);
        $this->assertSame('{"type":"notset"}', $program->enddatejson);
        $this->assertSame('0', $program->notifystart);
        $this->assertSame('0', $program->notifycompleted);
        $this->assertSame('0', $program->notifyduesoon);
        $this->assertSame('0', $program->notifydue);
        $this->assertSame('0', $program->notifyendsoon);
        $this->assertSame('0', $program->notifyendcompleted);
        $this->assertSame('0', $program->notifyendfailed);
        $this->assertSame('0', $program->notifydeallocation);
        $this->assertTimeCurrent($program->timecreated);

        $sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id]);
        $this->assertCount(0, $sources);

        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();

        $category = $this->getDataGenerator()->create_category([]);
        $catcontext = \context_coursecat::instance($category->id);
        $data = (object)[
            'fullname' => 'Some other program',
            'idnumber' => 'SP2',
            'contextid' => $catcontext->id,
            'description' => 'Some desc',
            'descriptionformat' => '2',
            'presentation' => ['some' => 'test'],
            'public' => '1',
            'archived' => '1',
            'creategroups' => '1',
            'timeallocationstart' => (string)(time() - 60 * 60 * 24),
            'timeallocationend' => (string)(time() + 60 * 60 * 24),
            'notifystart' => '1',
            'notifycompleted' => '1',
            'notifyduesoon' => '1',
            'notifydue' => '1',
            'notifyendsoon' => '1',
            'notifyendcompleted' => '1',
            'notifyendfailed' => '1',
            'notifydeallocation' => '1',
            'sources' => ['manual' => []],
            'cohorts' => [$cohort1->id, $cohort2->name],
        ];

        $this->setCurrentTimeStart();
        $program = $generator->create_program($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame((string)$catcontext->id, $program->contextid);
        $this->assertSame($data->fullname, $program->fullname);
        $this->assertSame($data->idnumber, $program->idnumber);
        $this->assertSame($data->description, $program->description);
        $this->assertSame($data->descriptionformat, $program->descriptionformat);
        $this->assertSame('[]', $program->presentationjson);
        $this->assertSame($data->public, $program->public);
        $this->assertSame($data->archived, $program->archived);
        $this->assertSame($data->creategroups, $program->creategroups);
        $this->assertSame($data->timeallocationstart, $program->timeallocationstart);
        $this->assertSame($data->timeallocationend, $program->timeallocationend);
        $this->assertSame('{"type":"allocation"}', $program->startdatejson);
        $this->assertSame('{"type":"notset"}', $program->duedatejson);
        $this->assertSame('{"type":"notset"}', $program->enddatejson);
        $this->assertSame($data->notifystart, $program->notifystart);
        $this->assertSame($data->notifycompleted, $program->notifycompleted);
        $this->assertSame($data->notifyduesoon, $program->notifyduesoon);
        $this->assertSame($data->notifydue, $program->notifydue);
        $this->assertSame($data->notifyendsoon, $program->notifyendsoon);
        $this->assertSame($data->notifyendcompleted, $program->notifyendcompleted);
        $this->assertSame($data->notifyendfailed, $program->notifyendfailed);
        $this->assertSame($data->notifydeallocation, $program->notifydeallocation);
        $this->assertTimeCurrent($program->timecreated);

        $sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id]);
        $this->assertCount(1, $sources);
        $source = reset($sources);
        $this->assertSame('manual', $source->type);
        $cs = $DB->get_records('enrol_programs_cohorts', ['programid' => $program->id], 'cohortid ASC');
        $this->assertCount(2, $cs);
        $cs = array_values($cs);
        $this->assertSame($cohort1->id, $cs[0]->cohortid);
        $this->assertSame($cohort2->id, $cs[1]->cohortid);

        $category2 = $this->getDataGenerator()->create_category([]);
        $catcontext2 = \context_coursecat::instance($category2->id);
        $program = $generator->create_program(['category' => $category2->name]);
        $this->assertSame((string)$catcontext2->id, $program->contextid);

        $data = (object)[
            'cohorts' => "$cohort1->name, $cohort2->id",
        ];
        $program = $generator->create_program($data);
        $cs = $DB->get_records('enrol_programs_cohorts', ['programid' => $program->id]);
        $this->assertCount(2, $cs);
        $this->assertCount(2, $cs);
        $cs = array_values($cs);
        $this->assertSame($cohort1->id, $cs[0]->cohortid);
        $this->assertSame($cohort2->id, $cs[1]->cohortid);
    }

    public function test_create_program_item() {
        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $course3 = $this->getDataGenerator()->create_course();

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $this->assertInstanceOf('enrol_programs_generator', $generator);

        $program = $generator->create_program([]);

        $record = [
            'programid' => $program->id,
            'courseid' => $course1->id,
        ];
        $item1 = $generator->create_program_item($record);
        $this->assertInstanceOf(course::class, $item1);
        $this->assertSame($program->id, (string)$item1->get_programid());
        $this->assertSame($course1->id, (string)$item1->get_courseid());

        $record = [
            'program' => $program->fullname,
            'course' => $course2->fullname,
        ];
        $item2 = $generator->create_program_item($record);
        $this->assertInstanceOf(course::class, $item2);
        $this->assertSame($program->id, (string)$item2->get_programid());
        $this->assertSame($course2->id, (string)$item2->get_courseid());

        $record = [
            'program' => $program->fullname,
            'fullname' => 'First set',
        ];
        /** @var set $item3 */
        $item3 = $generator->create_program_item($record);
        $this->assertInstanceOf(set::class, $item3);
        $this->assertSame($program->id, (string)$item3->get_programid());
        $this->assertSame('First set', $item3->get_fullname());
        $this->assertSame(1, $item3->get_minprerequisites());
        $this->assertSame(set::SEQUENCE_TYPE_ALLINANYORDER, $item3->get_sequencetype());
        $top = program::load_content($program->id);
        $this->assertSame($item3->get_id(), $top->get_children()[2]->get_id());

        $record = [
            'programid' => $program->id,
            'fullname' => 'Second set',
            'parent' => 'First set',
            'minprerequisites' => 3,
            'sequencetype' => set::SEQUENCE_TYPE_ATLEAST,
        ];
        /** @var set $item4 */
        $item4 = $generator->create_program_item($record);
        $this->assertInstanceOf(set::class, $item4);
        $this->assertSame($program->id, (string)$item4->get_programid());
        $this->assertSame('Second set', $item4->get_fullname());
        $this->assertSame(3, $item4->get_minprerequisites());
        $this->assertSame(set::SEQUENCE_TYPE_ATLEAST, $item4->get_sequencetype());
        $top = program::load_content($program->id);
        $this->assertSame($item4->get_id(), $top->get_children()[2]->get_children()[0]->get_id());

        $record = [
            'programid' => $program->id,
            'courseid' => $course3->id,
            'parent' => 'First set',
        ];
        $item5 = $generator->create_program_item($record);
        $this->assertInstanceOf(course::class, $item5);
        $this->assertSame($program->id, (string)$item5->get_programid());
        $this->assertSame($course3->id, (string)$item5->get_courseid());
        $top = program::load_content($program->id);
        $this->assertSame($item5->get_id(), $top->get_children()[2]->get_children()[1]->get_id());
    }

    public function test_create_program_allocation() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');
        $this->assertInstanceOf('enrol_programs_generator', $generator);

        $program = $generator->create_program([]);
        $user1 = $this->getDataGenerator()->create_user();
        $user2 = $this->getDataGenerator()->create_user();
        $user3 = $this->getDataGenerator()->create_user();

        $allocation1 = $generator->create_program_allocation(['programid' => $program->id, 'userid' => $user1->id]);
        $source = $DB->get_record('enrol_programs_sources', ['type' => 'manual', 'programid' => $program->id]);
        $this->assertSame($user1->id, $allocation1->userid);
        $this->assertSame($program->id, $allocation1->programid);
        $this->assertSame($source->id, $allocation1->sourceid);

        $allocation2 = $generator->create_program_allocation(['program' => $program->fullname, 'user' => $user2->username]);
        $this->assertSame($user2->id, $allocation2->userid);
        $this->assertSame($program->id, $allocation2->programid);
        $this->assertSame($source->id, $allocation2->sourceid);
    }
}
