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

namespace enrol_programs\local;

/**
 * Utility class for programs.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class util {

    /**
     * Encode JSON date in a consistent way.
     *
     * @param $data
     * @return string
     */
    public static function json_encode($data): string {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Normalise delays used in allocation settings.
     *
     * NOTE: for now only simple P22M, P22D and PT22H formats are supported,
     *       support for more options may be added later.
     *
     * @param string|null $string
     * @return string|null
     */
    public static function normalise_delay(?string $string): ?string {
        if (trim($string ?? '') === '') {
            return null;
        }

        if (preg_match('/^P\d+M$/D', $string)) {
            if ($string === 'P0M') {
                return null;
            }
            return $string;
        }
        if (preg_match('/^P\d+D$/D', $string)) {
            if ($string === 'P0D') {
                return null;
            }
            return $string;
        }
        if (preg_match('/^PT\d+H$/D', $string)) {
            if ($string === 'PT0H') {
                return null;
            }
            return $string;
        }

        debugging('Unsupported delay format: ' . $string, DEBUG_DEVELOPER);
        return null;
    }

    /**
     * Format delay that was stored in format of PHP DateInterval
     * to human readable form.
     *
     * @param string|null $string
     * @return string
     */
    public static function format_delay(?string $string): string {
        if (!$string) {
            return '';
        }

        $interval = new \DateInterval($string);

        $result = [];
        if ($interval->y) {
            if ($interval->y == 1) {
                $result[] = get_string('numyear', 'core', $interval->y);
            } else {
                $result[] = get_string('numyears', 'core', $interval->y);
            }
        }
        if ($interval->m) {
            if ($interval->m == 1) {
                $result[] = get_string('nummonth', 'core', $interval->m);
            } else {
                $result[] = get_string('nummonths', 'core', $interval->m);
            }
        }
        if ($interval->d) {
            if ($interval->d == 1) {
                $result[] = get_string('numday', 'core', $interval->d);
            } else {
                $result[] = get_string('numdays', 'core', $interval->d);
            }
        }
        if ($interval->h) {
            $result[] = get_string('numhours', 'core', $interval->h);
        }
        if ($interval->i) {
            $result[] = get_string('numminutes', 'core', $interval->i);
        }
        if ($interval->s) {
            $result[] = get_string('numseconds', 'core', $interval->s);
        }

        if ($result) {
            return implode(', ', $result);
        } else {
            return '';
        }
    }

    /**
     * Convert SELECT query to format suitable for $DB->count_records_sql().
     *
     * @param string $sql
     * @return string
     */
    public static function convert_to_count_sql(string $sql): string {
        $count = null;
        $sql = preg_replace('/^\s*SELECT.*FROM/Uis', "SELECT COUNT('x') FROM", $sql, 1, $count);
        if ($count !== 1) {
            debugging('Cannot convert SELECT query to count compatible form', DEBUG_DEVELOPER);
        }
        // Subqueries should not have ORDER BYs, so this should be safe,
        // worst case there will be a fatal error caused by cutting the query short.
        $sql = preg_replace('/\s*ORDER BY.*$/is', '', $sql);
        return $sql;
    }
}
