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
 * Simple confirmation form for triggering external DB allocation.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class externaldb_run extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $program = $this->_customdata['program'];

        $mform->addElement('static', 'info', '', get_string('source_externaldb_runconfirm', 'enrol_programs'));

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $program->id);

        $this->add_action_buttons(true, get_string('source_externaldb_run', 'enrol_programs'));

        $this->set_data(['id' => $program->id]);
    }
}
