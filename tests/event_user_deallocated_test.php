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
 * User deallocated event test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\event\user_deallocated
 */
final class event_user_deallocated_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_event() {
        global $DB;

        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
            'sources' => ['manual' => []],
        ];
        $admin = get_admin();
        $user = $this->getDataGenerator()->create_user();
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $this->setAdminUser();
        $program = $generator->create_program($data);
        $source = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => 'manual']);

        $this->setAdminUser();
        \enrol_programs\local\source\manual::allocate_users($program->id, $source->id, [$user->id]);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id]);

        $sink = $this->redirectEvents();
        \enrol_programs\local\source\manual::deallocate_user($program, $source, $allocation);
        $events = $sink->get_events();
        $sink->close();

        $this->assertCount(1, $events);
        $event = reset($events);
        $this->assertInstanceOf('enrol_programs\event\user_deallocated', $event);
        $this->assertEquals($syscontext->id, $event->contextid);
        $this->assertSame($allocation->id, $event->objectid);
        $this->assertSame($admin->id, $event->userid);
        $this->assertSame($user->id, $event->relateduserid);
        $this->assertSame('c', $event->crud);
        $this->assertSame($event::LEVEL_OTHER, $event->edulevel);
        $this->assertSame('enrol_programs_allocations', $event->objecttable);
        $description = $event->get_description();
        $programurl = new \moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);
        $this->assertSame($programurl->out(false), $event->get_url()->out(false));
    }
}
