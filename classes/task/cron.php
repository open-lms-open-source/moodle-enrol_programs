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

/**
 * Program cron.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cron extends \core\task\scheduled_task {

    /**
     * Name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskcron', 'enrol_programs');
    }

    /**
     * Run task for all program cron stuff.
     */
    public function execute() {
        if (!enrol_is_enabled('programs')) {
            return;
        }

        $trace = new \null_progress_trace();

        \enrol_programs\local\allocation::fix_allocation_sources(null, null);
        \enrol_programs\local\allocation::fix_enrol_instances(null);
        \enrol_programs\local\allocation::fix_user_enrolments(null, null);
        \enrol_programs\local\allocation_calendar_event::fix_allocation_calendar_events(null);

        \enrol_programs\local\notification_manager::trigger_notifications(null, null);

        \enrol_programs\local\source\manual::cleanup_uploaded_data();

        $trace->finished();
    }
}
