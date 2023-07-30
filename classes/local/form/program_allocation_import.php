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

namespace enrol_programs\local\form;

/**
 * Import program allocation - program selection step.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_allocation_import extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $customdata = $this->_customdata;

        $this->arguments = ['programid' => $customdata['id']];
        \enrol_programs\external\form_program_allocation_import_fromprogram::add_form_element(
            $mform, $this->arguments, 'fromprogram', get_string('importselectprogram', 'enrol_programs'));
        $mform->addRule('fromprogram', null, 'required', null, 'client');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $customdata['id']);

        $this->add_action_buttons(true, get_string('continue'));
    }

    public function validation($data, $files) {
        global $DB;
        $errors = parent::validation($data, $files);

        // Check if the user has capability to copy the selected program.
        $programid = $data['fromprogram'];
        $programcontextid = $DB->get_field('enrol_programs_programs', 'contextid', ['id' => $programid]);
        $context = \context::instance_by_id($programcontextid);
        if (!has_capability('enrol/programs:clone', $context )) {
            $errors['fromprogram'] = get_string('error');
        }
        return $errors;
    }
}
