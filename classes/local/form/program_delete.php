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
 * Delete program.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_delete extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $program = $this->_customdata['program'];

        $mform->addElement('static', 'fullname', get_string('programname', 'enrol_programs'), format_string($program->fullname));

        $mform->addElement('static', 'idnumber', get_string('idnumber'), format_string($program->idnumber));

        $mform->addElement('select', 'archived', get_string('archived', 'enrol_programs'), [0 => get_string('no'), 1 => get_string('yes')]);
        $mform->freeze('archived');
        $mform->setDefault('archived', $program->archived);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $program->id);

        $this->add_action_buttons(true, get_string('deleteprogram', 'enrol_programs'));
    }
}
