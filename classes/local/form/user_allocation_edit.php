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
 * Edit user allocation.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class user_allocation_edit extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB;

        $mform = $this->_form;
        $allocation = $this->_customdata['allocation'];
        $user = $this->_customdata['user'];
        $context = $this->_customdata['context'];

        $mform->addElement('static', 'userfullname', get_string('user'), fullname($user));

        $mform->addElement('date_time_selector', 'timeallocated', get_string('allocationdate', 'enrol_programs'), ['optional' => false]);
        $mform->freeze('timeallocated');

        $mform->addElement('date_time_selector', 'timestart', get_string('programstart_date', 'enrol_programs'), ['optional' => false]);

        $mform->addElement('date_time_selector', 'timedue', get_string('programdue_date', 'enrol_programs'), ['optional' => true]);

        $mform->addElement('date_time_selector', 'timeend', get_string('programend_date', 'enrol_programs'), ['optional' => true]);

        $mform->addElement('date_time_selector', 'timecompleted', get_string('completiondate', 'enrol_programs'), ['optional' => true]);

        $mform->addElement('select', 'archived', get_string('archived', 'enrol_programs'), [0 => get_string('no'), 1 => get_string('yes')]);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $allocation->id);

        $this->add_action_buttons(true, get_string('updateallocation', 'enrol_programs'));

        $this->set_data($allocation);
    }

    public function validation($allocation, $files) {
        $errors = parent::validation($allocation, $files);

        $errors = array_merge($errors, \enrol_programs\local\allocation::validate_allocation_dates(
            $allocation['timestart'], $allocation['timedue'], $allocation['timeend']));

        return $errors;
    }
}
