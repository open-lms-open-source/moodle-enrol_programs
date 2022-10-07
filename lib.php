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

/**
 * Program enrolment plugin lib functions and enrol class.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Program enrolment plugin class.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 */
class enrol_programs_plugin extends enrol_plugin {
    /**
     * Returns localised name of enrol instance
     *
     * @param stdClass $instance (null is accepted too)
     * @return string
     */
    public function get_instance_name($instance) {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $instance->customint1]);

        $name = get_string('program', 'enrol_programs');

        if ($program) {
            $name = $name . ' (' . format_string($program->fullname) . ')';
        }

        return $name;
    }

    /**
     * Do not allow manual adding of enrol instances, everything is managed via programs.
     *
     * @param int $courseid
     * @return boolean
     */
    public function can_add_instance($courseid): bool {
        return false;
    }

    /**
     * Do not allow manual deleting of enrol instances, everything is managed via programs.
     *
     * @param object $instance
     * @return bool
     */
    public function can_delete_instance($instance): bool {
        return false;
    }

    /**
     * Do not allow manual hiding and showing of enrol instances, everything is managed via programs.
     *
     * @param stdClass $instance
     * @return bool
     */
    public function can_hide_show_instance($instance): bool {
        return false;
    }

    /**
     * Do not allow manual unenrolling, everything is managed via programs.
     *
     * @param stdClass $instance course enrol instance
     * @return bool
     */
    public function allow_unenrol(stdClass $instance): bool {
        return false;
    }

    /**
     * Do not show any enrolment UI.
     *
     * @return bool
     */
    public function use_standard_editing_ui(): bool {
        return false;
    }

    /**
     * Ignore restoring of program enrol instances.
     *
     * @param restore_enrolments_structure_step $step
     * @param stdClass $data
     * @param stdClass $course
     * @param int $oldid
     */
    public function restore_instance(restore_enrolments_structure_step $step, stdClass $data, $course, $oldid): void {
        return;
    }
}

function enrol_programs_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    global $DB;

    if ($context->contextlevel != CONTEXT_SYSTEM && $context->contextlevel != CONTEXT_COURSECAT) {
        send_file_not_found();
    }

    if ($filearea !== 'description' && $filearea !== 'image') {
        send_file_not_found();
    }

    $programid = (int)array_shift($args);

    $program = $DB->get_record('enrol_programs_programs', ['id' => $programid]);
    if (!$program) {
        send_file_not_found();
    }
    if (!has_capability('enrol/programs:view', $context)
        && !\enrol_programs\local\catalogue::is_program_visible($program)
    ) {
        send_file_not_found();
    }

    $filename = array_pop($args);
    $filepath = implode('/', $args) . '/';

    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'enrol_programs', $filearea, $programid, $filepath, $filename);
    if (!$file || $file->is_directory()) {
        send_file_not_found();
    }

    send_stored_file($file, 60 * 60, 0, $forcedownload, $options);
}

/**
 * Hook called before a course category is deleted.
 *
 * @param \stdClass $category The category record.
 */
function enrol_programs_pre_course_category_delete(\stdClass $category) {
    \enrol_programs\local\program::pre_course_category_delete($category);
}

/**
 * This function receives a calendar event and returns the action associated with it, or null if there is none.
 *
 * This is used by block_myoverview in order to display the event appropriately. If null is returned then the event
 * is not displayed on the block.
 *
 * @param calendar_event $event
 * @param \core_calendar\action_factory $factory
 * @param int $userid ID override for calendar events
 * @return \core_calendar\local\event\entities\action_interface|null
 */
function enrol_programs_core_calendar_provide_event_action(calendar_event $event,
        \core_calendar\action_factory $factory, $userid = 0) {

    global $USER, $DB;
    if (empty($userid)) {
        $userid = $USER->id;
    }

    // The event object (core_calendar\local\event\entities\event) passed does not include an instance property so we need to pull the DB record.
    $event = $DB->get_record('event', ['id' => $event->id], '*', MUST_EXIST);
    $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $event->instance], '*', MUST_EXIST);

    return $factory->create_instance(
        get_string('view'),
        new \moodle_url('/enrol/programs/view.php', ['id' => $allocation->programid]),
        1,
        true
    );
}

/**
 * Map icons for font-awesome themes.
 */
function enrol_programs_get_fontawesome_icon_map() {
    return [
        'enrol_programs:appenditem' => 'fa-plus-square',
        'enrol_programs:catalogue' => 'fa-cubes',
        'enrol_programs:deleteitem' => 'fa-trash-o',
        'enrol_programs:itemcourse' => 'fa-graduation-cap',
        'enrol_programs:itemset' => 'fa-list',
        'enrol_programs:itemtop' => 'fa-cubes',
        'enrol_programs:move' => 'fa-arrows',
        'enrol_programs:program' => 'fa-cubes',
        'enrol_programs:myprograms' => 'fa-cubes',
        'enrol_programs:requestapprove' => 'fa-check-square-o',
        'enrol_programs:requestreject' => 'fa-times-rectangle-o',
    ];
}
