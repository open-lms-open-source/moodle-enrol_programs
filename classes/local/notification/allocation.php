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

namespace enrol_programs\local\notification;

use stdClass;

/**
 * Program allocation notification.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class allocation extends base {
    /**
     * Send notifications.
     *
     * @param stdClass|null $program
     * @param stdClass|null $user
     * @return void
     */
    public static function notify_users(?stdClass $program, ?stdClass $user): void {
        // Nothing to do, we notify during allocation.
    }

    /**
     * Send notifications related to allocation.
     *
     * @param stdClass $user
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return void
     */
    public static function notify_now(stdClass $user, stdClass $program, stdClass $source, stdClass $allocation): void {
        self::notify_allocated_user($program, $source, $allocation, $user);
    }
}
