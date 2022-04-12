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
 * Program deleted event test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\event\program_deleted
 */
final class event_program_deleted_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_delete_program() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $this->setAdminUser();
        $program = program::add_program($data);

        $sink = $this->redirectEvents();
        program::delete_program($program->id);
        $events = $sink->get_events();
        $sink->close();

        $this->assertCount(1, $events);
        $event = reset($events);
        $this->assertInstanceOf('enrol_programs\event\program_deleted', $event);
        $this->assertEquals($syscontext->id, $event->contextid);
        $this->assertSame($program->id, $event->objectid);
        $this->assertSame('d', $event->crud);
        $this->assertSame($event::LEVEL_OTHER, $event->edulevel);
        $this->assertSame('enrol_programs_programs', $event->objecttable);
        $description = $event->get_description();
        $programurl = new \moodle_url('/enrol/programs/management/index.php', ['contextid' => $program->contextid]);
        $this->assertSame($programurl->out(false), $event->get_url()->out(false));
    }
}
