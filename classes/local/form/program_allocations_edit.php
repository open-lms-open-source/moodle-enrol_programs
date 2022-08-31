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

use enrol_programs\local\program;
use enrol_programs\local\allocation;

/**
 * Edit program allocation.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_allocations_edit extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $data = $this->_customdata['data'];
        $context = $this->_customdata['context'];

        $mform->addElement('date_time_selector', 'timeallocationstart', get_string('allocationstart', 'enrol_programs'), ['optional' => true]);
        $mform->addHelpButton('timeallocationstart', 'allocationstart', 'enrol_programs');

        $mform->addElement('date_time_selector', 'timeallocationend', get_string('allocationend', 'enrol_programs'), ['optional' => true]);
        $mform->addHelpButton('timeallocationend', 'allocationend', 'enrol_programs');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $data->id);

        $this->add_action_buttons(true, get_string('updateallocations', 'enrol_programs'));

        $this->set_data($data);
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if ($data['timeallocationstart'] && $data['timeallocationend']
            && $data['timeallocationstart'] >= $data['timeallocationend']) {
            $errors['timeallocationend'] = get_string('error');
        }

        return $errors;
    }
}
