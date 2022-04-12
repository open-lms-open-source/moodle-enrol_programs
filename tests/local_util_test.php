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

use enrol_programs\local\util;

/**
 * Program helper test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\util
 */
final class local_util_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_json_encode() {
        $this->assertSame('{"abc":"\\\\šk\"\'"}', util::json_encode(['abc' => '\šk"\'']));
    }

    public function test_normalise_delay() {
        $this->assertSame('P1M', util::normalise_delay('P1M'));
        $this->assertSame('P99D', util::normalise_delay('P99D'));
        $this->assertSame('PT9H', util::normalise_delay('PT9H'));
        $this->assertDebuggingNotCalled();
        $this->assertSame(null, util::normalise_delay(''));
        $this->assertSame(null, util::normalise_delay(null));
        $this->assertSame(null, util::normalise_delay('P0M'));
        $this->assertDebuggingNotCalled();

        $this->assertSame(null, util::normalise_delay('P9X'));
        $this->assertDebuggingCalled();
        $this->assertSame(null, util::normalise_delay('P1M1D'));
        $this->assertDebuggingCalled();
    }

    public function test_format_delay() {
        $this->assertSame('2 months', util::format_delay('P2M'));
        $this->assertSame('2 days', util::format_delay('P2D'));
        $this->assertSame('2 hours', util::format_delay('PT2H'));
        $this->assertSame('1 month, 2 days, 3 hours', util::format_delay('P1M2DT3H'));
        $this->assertSame('', util::format_delay(''));
        $this->assertSame('', util::format_delay(null));
    }

    public function test_convert_to_count_sql() {
        $sql = 'SELECT *
                  FROM {user}
              ORDER BY id';
        $expected = 'SELECT COUNT(\'x\') FROM {user}';
        $this->assertSame($expected, util::convert_to_count_sql($sql));
    }
}
