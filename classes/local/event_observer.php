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
 * Program event observer.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class event_observer {
    public static function course_updated(\core\event\course_updated $event) {
        global $DB;

        if (!get_config('enrol_programs')) {
            return;
        }

        $course = $event->get_record_snapshot('course', $event->objectid);
        if (!$course) {
            return;
        }

        $items = $DB->get_records('enrol_programs_items', ['courseid' => $course->id]);
        foreach ($items as $item) {
            if ($item->fullname !== $course->fullname) {
                // No need for snapshot, the course fullname is just a perfomrance thing
                // and a fallback for deleted courses.
                $DB->set_field('enrol_programs_items', 'fullname', $course->fullname, ['id' => $item->id]);
            }
        }
    }

    public static function course_deleted(\core\event\course_deleted $event) {
        // Not sure what to do here...
    }

    public static function course_category_deleted(\core\event\course_category_deleted $event) {
        global $DB;

        // Programs should have been already moved to the deleted category context,
        // let's move them to system as a fallback.
        $syscontext = \context_system::instance();
        $programs = $DB->get_records('enrol_programs_programs', ['contextid' => $event->contextid]);
        foreach ($programs as $program) {
            $data = (object)[
                'id' => $program->id,
                'contextid' => $syscontext->id,
            ];
            program::update_program_general($data);
        }
    }

    public static function user_deleted(\core\event\user_deleted $event) {
        allocation::deleted_user_cleanup($event->objectid);
    }

    public static function cohort_member_added(\core\event\cohort_member_added $event) {
        $updated = \enrol_programs\local\source\cohort::fix_allocations(null, $event->relateduserid);
        if ($updated) {
            allocation::fix_user_enrolments(null, $event->relateduserid);
        }
    }

    public static function cohort_member_removed(\core\event\cohort_member_removed $event) {
        $updated = \enrol_programs\local\source\cohort::fix_allocations(null, $event->relateduserid);
        if ($updated) {
            allocation::fix_user_enrolments(null, $event->relateduserid);
        }
    }

    public static function course_completed(\core\event\course_completed $event) {
        allocation::fix_user_enrolments(null, $event->relateduserid);
    }

    public static function group_deleted(\core\event\group_deleted $event) {
        global $DB;
        // We cannot do much to prevent the deletion, the group will be recreated if necessary.
        $DB->delete_records('enrol_programs_groups', ['groupid' => $event->objectid]);
    }
}
