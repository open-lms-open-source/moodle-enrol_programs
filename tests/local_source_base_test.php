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

use enrol_programs\local\source\base;
use enrol_programs\local\program;

/**
 * Allocation source base test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\source\manual
 */
final class local_source_base_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_is_valid_dateoverrides() {
        $syscontext = \context_system::instance();
        $data = (object)[
            'fullname' => 'Some program',
            'idnumber' => 'SP1',
            'contextid' => $syscontext->id,
        ];
        $program = program::add_program($data);
        $now = time();

        $data = (object)[
            'id' => $program->id,
            'programstart_type' => 'date',
            'programstart_date' => $now,
            'programdue_type' => 'date',
            'programdue_date' => $now + 100,
            'programend_type' => 'date',
            'programend_date' => $now + 200,
        ];
        $program = program::update_program_scheduling($data);

        $this->assertTrue(base::is_valid_dateoverrides($program, []));
        $this->assertTrue(base::is_valid_dateoverrides($program, ['timestart' => $now + 1]));
        $this->assertTrue(base::is_valid_dateoverrides($program, ['timestart' => $now + 1, 'timedue' => $now + 2]));
        $this->assertTrue(base::is_valid_dateoverrides($program, ['timestart' => $now + 1, 'timedue' => $now + 2, 'timeend' => $now + 2]));
        $this->assertTrue(base::is_valid_dateoverrides($program, ['timestart' => 0, 'timedue' => 0, 'timeend' => 0]));

        $this->assertFalse(base::is_valid_dateoverrides($program, ['timestart' => $now + 100]));
        $this->assertFalse(base::is_valid_dateoverrides($program, ['timedue' => $now]));
        $this->assertFalse(base::is_valid_dateoverrides($program, ['timedue' => $now - 1]));
        $this->assertFalse(base::is_valid_dateoverrides($program, ['timeend' => $now]));
        $this->assertFalse(base::is_valid_dateoverrides($program, ['timeend' => $now - 1]));
        $this->assertFalse(base::is_valid_dateoverrides($program, ['timedue' => $now + 5, 'timeend' => $now + 4]));
    }
}
