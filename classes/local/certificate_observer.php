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
 * Program certificate observer.
 *
 * NOTE: This should be refactored into an independent subplugin in tool_certificate.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class certificate_observer {
    /**
     * Called after certificate template is deleted.
     *
     * @param \tool_certificate\event\template_deleted $event
     * @return void
     */
    public static function template_deleted(\tool_certificate\event\template_deleted $event): void {
        global $DB;
        $DB->delete_records('enrol_programs_certs', ['templateid' => $event->objectid]);
    }

    /**
     * Called after program is deleted.
     *
     * @param \enrol_programs\event\program_deleted $event
     * @return void
     */
    public static function program_deleted(\enrol_programs\event\program_deleted $event): void {
        global $DB;
        $DB->delete_records('enrol_programs_certs_issues', ['programid' => $event->objectid]);
        $DB->delete_records('enrol_programs_certs', ['programid' => $event->objectid]);
    }

    /**
     * Called after user is deallocated from program.
     *
     * @param \enrol_programs\event\user_deallocated $event
     * @return void
     */
    public static function user_deallocated(\enrol_programs\event\user_deallocated $event): void {
        global $DB;
        $issues = $DB->get_records('enrol_programs_certs_issues', ['allocationid' => $event->objectid]);
        foreach ($issues as $issue) {
            $DB->set_field('tool_certificate_issues', 'archived', 1, ['id' => $issue->issueid]);
            $DB->set_field('enrol_programs_certs_issues', 'allocationid', null, ['id' => $issue->id]);
        }
    }
}
