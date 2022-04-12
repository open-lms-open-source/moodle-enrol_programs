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

/**
 * Program helper test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\program
 */
final class local_program_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_add_program() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];

        $this->setCurrentTimeStart();
        $program = program::add_program($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame((string)$syscontext->id, $program->contextid);
        $this->assertSame($data->fullname, $program->fullname);
        $this->assertSame($data->idnumber, $program->idnumber);
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
        ];

        $this->setCurrentTimeStart();
        $program = program::add_program($data);
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
    }

    public function test_update_program_general() {
        global $DB;

        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];

        $this->setCurrentTimeStart();
        $oldprogram = program::add_program($data);

        $category = $this->getDataGenerator()->create_category([]);
        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();
        $catcontext = \context_coursecat::instance($category->id);
        $data = (object)[
            'id' => $oldprogram->id,
            'fullname' => 'Some other program',
            'idnumber' => 'SP2',
            'contextid' => $catcontext->id,
            'description' => 'Some desc',
            'descriptionformat' => '2',
            'presentation' => ['some' => 'test'],
            'public' => '1',
            'cohorts' => [$cohort1->id, $cohort2->id],
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
        ];

        $program = program::update_program_general($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame((string)$catcontext->id, $program->contextid);
        $this->assertSame($data->fullname, $program->fullname);
        $this->assertSame($data->idnumber, $program->idnumber);
        $this->assertSame($data->description, $program->description);
        $this->assertSame($data->descriptionformat, $program->descriptionformat);
        $this->assertSame('[]', $program->presentationjson);
        $this->assertSame('0', $program->public);
        $this->assertSame($data->archived, $program->archived);
        $this->assertSame($data->creategroups, $program->creategroups);
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
        $this->assertSame($oldprogram->timecreated, $program->timecreated);

        $cohorts = $DB->get_records_menu('enrol_programs_cohorts', ['programid' => $program->id], 'cohortid ASC', 'id, cohortid');
        $this->assertSame([], array_values($cohorts));
    }

    public function test_update_program_visibility() {
        global $DB;

        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];

        $this->setCurrentTimeStart();
        $oldprogram = program::add_program($data);

        $category = $this->getDataGenerator()->create_category([]);
        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();
        $catcontext = \context_coursecat::instance($category->id);
        $data = (object)[
            'id' => $oldprogram->id,
            'fullname' => 'Some other program',
            'idnumber' => 'SP2',
            'contextid' => $catcontext->id,
            'description' => 'Some desc',
            'descriptionformat' => '2',
            'presentation' => ['some' => 'test'],
            'public' => '1',
            'cohorts' => [$cohort1->id, $cohort2->id],
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
        ];

        $program = program::update_program_visibility($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame($oldprogram->contextid, $program->contextid);
        $this->assertSame($oldprogram->fullname, $program->fullname);
        $this->assertSame($oldprogram->idnumber, $program->idnumber);
        $this->assertSame($oldprogram->description, $program->description);
        $this->assertSame($oldprogram->descriptionformat, $program->descriptionformat);
        $this->assertSame('[]', $program->presentationjson);
        $this->assertSame('1', $program->public);
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
        $this->assertSame($oldprogram->timecreated, $program->timecreated);

        $cohorts = $DB->get_records_menu('enrol_programs_cohorts', ['programid' => $program->id], 'cohortid ASC', 'id, cohortid');
        $this->assertSame($data->cohorts, array_values($cohorts));
    }

    public function test_update_program_notifications() {
        global $DB;

        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];

        $this->setCurrentTimeStart();
        $oldprogram = program::add_program($data);

        $category = $this->getDataGenerator()->create_category([]);
        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();
        $catcontext = \context_coursecat::instance($category->id);
        $data = (object)[
            'id' => $oldprogram->id,
            'fullname' => 'Some other program',
            'idnumber' => 'SP2',
            'contextid' => $catcontext->id,
            'description' => 'Some desc',
            'descriptionformat' => '2',
            'presentation' => ['some' => 'test'],
            'public' => '1',
            'cohorts' => [$cohort1->id, $cohort2->id],
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
        ];

        $program = program::update_program_notifications($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame($oldprogram->contextid, $program->contextid);
        $this->assertSame($oldprogram->fullname, $program->fullname);
        $this->assertSame($oldprogram->idnumber, $program->idnumber);
        $this->assertSame($oldprogram->description, $program->description);
        $this->assertSame($oldprogram->descriptionformat, $program->descriptionformat);
        $this->assertSame('[]', $program->presentationjson);
        $this->assertSame($oldprogram->public, $program->public);
        $this->assertSame($oldprogram->archived, $program->archived);
        $this->assertSame($oldprogram->creategroups, $program->creategroups);
        $this->assertSame(null, $program->timeallocationstart);
        $this->assertSame(null, $program->timeallocationend);
        $this->assertSame('{"type":"allocation"}', $program->startdatejson);
        $this->assertSame('{"type":"notset"}', $program->duedatejson);
        $this->assertSame('{"type":"notset"}', $program->enddatejson);
        $this->assertSame('1', $program->notifystart);
        $this->assertSame('1', $program->notifycompleted);
        $this->assertSame('1', $program->notifyduesoon);
        $this->assertSame('1', $program->notifydue);
        $this->assertSame('1', $program->notifyendsoon);
        $this->assertSame('1', $program->notifyendcompleted);
        $this->assertSame('1', $program->notifyendfailed);
        $this->assertSame('1', $program->notifydeallocation);
        $this->assertSame($oldprogram->timecreated, $program->timecreated);

        $cohorts = $DB->get_records_menu('enrol_programs_cohorts', ['programid' => $program->id], 'cohortid ASC', 'id, cohortid');
        $this->assertSame([], array_values($cohorts));
    }

    public function test_update_program_allocation() {
        global $DB;

        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];

        $this->setCurrentTimeStart();
        $oldprogram = program::add_program($data);

        $category = $this->getDataGenerator()->create_category([]);
        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();
        $catcontext = \context_coursecat::instance($category->id);
        $data = (object)[
            'id' => $oldprogram->id,
            'fullname' => 'Some other program',
            'idnumber' => 'SP2',
            'contextid' => $catcontext->id,
            'description' => 'Some desc',
            'descriptionformat' => '2',
            'presentation' => ['some' => 'test'],
            'public' => '1',
            'cohorts' => [$cohort1->id, $cohort2->id],
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
        ];

        $program = program::update_program_allocation($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame($oldprogram->contextid, $program->contextid);
        $this->assertSame($oldprogram->fullname, $program->fullname);
        $this->assertSame($oldprogram->idnumber, $program->idnumber);
        $this->assertSame($oldprogram->description, $program->description);
        $this->assertSame($oldprogram->descriptionformat, $program->descriptionformat);
        $this->assertSame('[]', $program->presentationjson);
        $this->assertSame($oldprogram->public, $program->public);
        $this->assertSame($oldprogram->archived, $program->archived);
        $this->assertSame($oldprogram->creategroups, $program->creategroups);
        $this->assertSame($data->timeallocationstart, $program->timeallocationstart);
        $this->assertSame($data->timeallocationend, $program->timeallocationend);
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
        $this->assertSame($oldprogram->timecreated, $program->timecreated);

        $cohorts = $DB->get_records_menu('enrol_programs_cohorts', ['programid' => $program->id], 'cohortid ASC', 'id, cohortid');
        $this->assertSame([], array_values($cohorts));
    }

    public function test_get_program_startdate_types() {
        $types = program::get_program_startdate_types();
        $this->assertIsArray($types);
        $this->assertArrayHasKey('allocation', $types);
        $this->assertArrayHasKey('date', $types);
        $this->assertArrayHasKey('delay', $types);
    }

    public function test_get_program_duedate_types() {
        $types = program::get_program_duedate_types();
        $this->assertIsArray($types);
        $this->assertArrayHasKey('notset', $types);
        $this->assertArrayHasKey('date', $types);
        $this->assertArrayHasKey('delay', $types);
    }

    public function test_get_program_enddate_types() {
        $types = program::get_program_enddate_types();
        $this->assertIsArray($types);
        $this->assertArrayHasKey('notset', $types);
        $this->assertArrayHasKey('date', $types);
        $this->assertArrayHasKey('delay', $types);
    }

    public function test_update_program_scheduling() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];

        $oldprogram = program::add_program($data);

        $data = (object)[
            'id' => $oldprogram->id,
            'programstart_type' => 'allocation',
            'programdue_type' => 'notset',
            'programend_type' => 'notset',
        ];
        $program = program::update_program_scheduling($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame(util::json_encode(['type' => 'allocation']), $program->startdatejson);
        $this->assertSame(util::json_encode(['type' => 'notset']), $program->duedatejson);
        $this->assertSame(util::json_encode(['type' => 'notset']), $program->enddatejson);

        $data = (object)[
            'id' => $oldprogram->id,
            'programstart_type' => 'date',
            'programstart_date' => time() + 60 * 60,
            'programdue_type' => 'date',
            'programdue_date' => time() + 60 * 60 * 3,
            'programend_type' => 'date',
            'programend_date' => time() + 60 * 60 * 6,
        ];
        $program = program::update_program_scheduling($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame(util::json_encode(['type' => 'date', 'date' => $data->programstart_date]), $program->startdatejson);
        $this->assertSame(util::json_encode(['type' => 'date', 'date' => $data->programdue_date]), $program->duedatejson);
        $this->assertSame(util::json_encode(['type' => 'date', 'date' => $data->programend_date]), $program->enddatejson);

        $data = (object)[
            'id' => $oldprogram->id,
            'programstart_type' => 'delay',
            'programstart_delay' => ['type' => 'hours', 'value' => 3],
            'programdue_type' => 'delay',
            'programdue_delay' => ['type' => 'days', 'value' => 6],
            'programend_type' => 'delay',
            'programend_delay' => ['type' => 'months', 'value' => 2],
        ];
        $program = program::update_program_scheduling($data);
        $this->assertInstanceOf('stdClass', $program);
        $this->assertSame(util::json_encode(['type' => 'delay', 'delay' => 'PT3H']), $program->startdatejson);
        $this->assertSame(util::json_encode(['type' => 'delay', 'delay' => 'P6D']), $program->duedatejson);
        $this->assertSame(util::json_encode(['type' => 'delay', 'delay' => 'P2M']), $program->enddatejson);
    }

    public function test_delete_program() {
        global $DB;

        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $program = program::add_program($data);

        program::delete_program($program->id);
        $this->assertFalse($DB->record_exists('enrol_programs_programs', ['id' => $program->id]));
    }

    public function test_make_snapshot() {
        global $DB;

        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $program = program::add_program($data);
        $this->setAdminUser();
        $admin = get_admin();

        $this->setCurrentTimeStart();
        $DB->delete_records('enrol_programs_prg_snapshots', []);
        program::make_snapshot($program->id, 'test', 'some explanation');

        $records = $DB->get_records('enrol_programs_prg_snapshots', []);
        $this->assertCount(1, $records);

        $record = reset($records);
        $this->assertSame($program->id, $record->programid);
        $this->assertSame('test', $record->reason);
        $this->assertTimeCurrent($record->timesnapshot);
        $this->assertSame($admin->id, $record->snapshotby);
        $this->assertSame('some explanation', $record->explanation);

        program::delete_program($program->id);
        $this->setCurrentTimeStart();
        $DB->delete_records('enrol_programs_prg_snapshots', []);
        program::make_snapshot($program->id, 'test', 'some explanation');

        $records = $DB->get_records('enrol_programs_prg_snapshots', []);
        $this->assertCount(1, $records);

        $record = reset($records);
        $this->assertSame($program->id, $record->programid);
        $this->assertSame('test', $record->reason);
        $this->assertTimeCurrent($record->timesnapshot);
        $this->assertSame($admin->id, $record->snapshotby);
        $this->assertSame('some explanation', $record->explanation);
    }

    public function test_load_content() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $program = program::add_program($data);

        $top = program::load_content($program->id);
        $this->assertInstanceOf(\enrol_programs\local\content\top::class, $top);
    }

    public function test_category_pre_delete() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $syscontext = \context_system::instance();
        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);
        $category2 = $this->getDataGenerator()->create_category(['parent' => $category1->id]);
        $catcontext2 = \context_coursecat::instance($category2->id);
        $this->assertSame($category1->id, $category2->parent);

        $program1 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program2 = $generator->create_program(['contextid' => $catcontext2->id]);

        $this->assertSame((string)$catcontext1->id, $program1->contextid);
        $this->assertSame((string)$catcontext2->id, $program2->contextid);

        program::pre_course_category_delete($category2->get_db_record());
        $program2 = $DB->get_record('enrol_programs_programs', ['id' => $program2->id], '*', MUST_EXIST);
        $this->assertSame((string)$catcontext1->id, $program2->contextid);

        program::pre_course_category_delete($category1->get_db_record());
        $program1 = $DB->get_record('enrol_programs_programs', ['id' => $program1->id], '*', MUST_EXIST);
        $this->assertSame((string)$syscontext->id, $program1->contextid);
        $program2 = $DB->get_record('enrol_programs_programs', ['id' => $program2->id], '*', MUST_EXIST);
        $this->assertSame((string)$syscontext->id, $program2->contextid);
    }
}
