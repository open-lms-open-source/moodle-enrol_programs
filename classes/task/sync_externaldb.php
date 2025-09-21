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

namespace enrol_programs\task;

use enrol_programs\local\allocation;
use enrol_programs\local\source\externaldb;

/**
 * Scheduled task that synchronises program allocations with external databases.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class sync_externaldb extends \core\task\scheduled_task {
    /**
     * Task name shown in admin UI.
     */
    public function get_name(): string {
        return get_string('taskexternaldbsync', 'enrol_programs');
    }

    /**
     * Execute the synchronisation task.
     */
    public function execute(): void {
        if (!enrol_is_enabled('programs')) {
            return;
        }
        if (!externaldb::is_configured()) {
            return;
        }

        $updated = externaldb::fix_allocations(null, null);
        if ($updated) {
            allocation::fix_user_enrolments(null, null);
        }
    }
}
