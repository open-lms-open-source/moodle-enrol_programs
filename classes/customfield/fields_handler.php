<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Custom fields handler for programs.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace enrol_programs\customfield;

use core_customfield\field_controller;

/**
 * Custom fields handler for programs.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class fields_handler extends \core_customfield\handler {

    /**
     * Context that should be used for new categories created by this handler.
     *
     * @return \context the context for configuration
     */
    public function get_configuration_context(): \context {
        return \context_system::instance();
    }

    /**
     * URL for configuration of the fields on this handler.
     *
     * @return \moodle_url The URL to configure custom fields for this component
     */
    public function get_configuration_url(): \moodle_url {
        return new \moodle_url('/enrol/programs/customfield.php', []);
    }

    /**
     * Returns the context for the data associated with the given instanceid.
     *
     * @param int $instanceid id of the record to get the context for
     * @return \context the context for the given record, returns system context if instanceid = 0 when created
     */
    public function get_instance_context(int $instanceid = 0): \context {
        global $DB;
        if ($instanceid > 0) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $instanceid], '*', MUST_EXIST);
            $context = \context::instance_by_id($program->contextid);
            return $context;
        } else {
            return \context_system::instance();
        }
    }

    /**
     * The current user can configure custom fields on this component.
     *
     * @return bool true if the current can configure custom fields, false otherwise
     */
    public function can_configure(): bool {
        return has_capability('enrol/programs:configurecustomfields', $this->get_configuration_context());
    }

    /**
     * The current user can edit custom fields on the given program.
     *
     * @param field_controller $field
     * @param int $instanceid id of the program to test edit permission
     * @return bool true if the current can edit custom field, false otherwise
     */
    public function can_edit(\core_customfield\field_controller $field, int $instanceid = 0): bool {
        return has_capability('enrol/programs:edit', $this->get_instance_context($instanceid));
    }

    /**
     * The current user can view custom fields on the given program.
     *
     * @param field_controller $field
     * @param int $instanceid id of the program to test edit permission
     * @return bool true if the current can view custom field, false otherwise
     */
    public function can_view(\core_customfield\field_controller $field, int $instanceid): bool {
        global $USER, $DB;
        $context = $this->get_instance_context($instanceid);
        $program = $DB->get_record('enrol_programs_programs', ['id' => $instanceid]);

        if ($field->get_configdata_property('visibilitymanagers')) {
            if (has_capability('enrol/programs:view', $context)) {
                return true;
            }
        }

        if ($field->get_configdata_property('visibilityallocated')) {
            $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $USER->id]);
            if ($allocation && !$allocation->archived) {
                return true;
            }
        }

        if ($field->get_configdata_property('visibilityeveryone')) {
            if (\enrol_programs\local\catalogue::is_program_visible($program)) {
                return true;
            }
        }
        // Fall back to enrol/programs:edit in case the visibility is not configured.
        return has_capability('enrol/programs:edit', $context);
    }

    /**
     * Allows to add custom controls to the field configuration form that will be saved in configdata
     *
     * @param \MoodleQuickForm $mform
     */
    public function config_form_definition(\MoodleQuickForm $mform) {
        $mform->addElement('header', 'programcustomfields', get_string('customfieldsettings', 'enrol_programs'));
        $mform->setExpanded('programcustomfields', true);
        $mform->addElement('static', 'customfieldvisibleto', get_string('customfieldvisibleto', 'enrol_programs'));
        $mform->addElement('advcheckbox', 'configdata[visibilitymanagers]',
            '', get_string('customfieldvisible:viewcapability', 'enrol_programs'), ['group' => 1]);
        $mform->addHelpButton('configdata[visibilitymanagers]', 'customfieldvisible:viewcapability', 'enrol_programs');
        $mform->addElement('advcheckbox', 'configdata[visibilityallocated]',
            '', get_string('customfieldvisible:allocated', 'enrol_programs'), ['group' => 1]);
        $mform->addHelpButton('configdata[visibilityallocated]', 'customfieldvisible:allocated', 'enrol_programs');
        $mform->addElement('advcheckbox', 'configdata[visibilityeveryone]',
            '', get_string('customfieldvisible:everyone', 'enrol_programs'), ['group' => 1]);
        $mform->addHelpButton('configdata[visibilityeveryone]', 'customfieldvisible:viewcapability', 'enrol_programs');
    }

}
