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

/**
 * Program updated event test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\event\program_updated
 */
final class event_program_updated_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_update_program_general() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $this->setAdminUser();
        $program = program::add_program($data);

        $sink = $this->redirectEvents();
        $program->fullname = 'Another program';
        $program = program::update_program_general($program);
        $events = $sink->get_events();
        $sink->close();

        $this->assertCount(1, $events);
        $event = reset($events);
        $this->assertInstanceOf('enrol_programs\event\program_updated', $event);
        $this->assertEquals($syscontext->id, $event->contextid);
        $this->assertSame($program->id, $event->objectid);
        $this->assertSame('u', $event->crud);
        $this->assertSame($event::LEVEL_OTHER, $event->edulevel);
        $this->assertSame('enrol_programs_programs', $event->objecttable);
        $description = $event->get_description();
        $programurl = new \moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);
        $this->assertSame($programurl->out(false), $event->get_url()->out(false));
    }

    public function test_update_program_visibility() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $this->setAdminUser();
        $program = program::add_program($data);

        $data = (object)['id' => $program->id, 'public' => 1];
        $sink = $this->redirectEvents();
        $program = program::update_program_visibility($data);
        $events = $sink->get_events();
        $sink->close();

        $this->assertCount(1, $events);
        $event = reset($events);
        $this->assertInstanceOf('enrol_programs\event\program_updated', $event);
        $this->assertEquals($syscontext->id, $event->contextid);
        $this->assertSame($program->id, $event->objectid);
        $this->assertSame('u', $event->crud);
        $this->assertSame($event::LEVEL_OTHER, $event->edulevel);
        $this->assertSame('enrol_programs_programs', $event->objecttable);
        $description = $event->get_description();
        $programurl = new \moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);
        $this->assertSame($programurl->out(false), $event->get_url()->out(false));
    }

    public function test_update_program_notifications() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $this->setAdminUser();
        $program = program::add_program($data);

        $data = (object)['id' => $program->id, 'notifystart' => 1];
        $sink = $this->redirectEvents();
        $program = program::update_program_notifications($data);
        $events = $sink->get_events();
        $sink->close();

        $this->assertCount(1, $events);
        $event = reset($events);
        $this->assertInstanceOf('enrol_programs\event\program_updated', $event);
        $this->assertEquals($syscontext->id, $event->contextid);
        $this->assertSame($program->id, $event->objectid);
        $this->assertSame('u', $event->crud);
        $this->assertSame($event::LEVEL_OTHER, $event->edulevel);
        $this->assertSame('enrol_programs_programs', $event->objecttable);
        $description = $event->get_description();
        $programurl = new \moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);
        $this->assertSame($programurl->out(false), $event->get_url()->out(false));
    }
}
