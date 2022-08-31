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
 * Edit item completion data.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class user_completion_edit extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB;

        $mform = $this->_form;
        $context = $this->_customdata['context'];
        $allocation = $this->_customdata['allocation'];
        $item = $this->_customdata['item'];
        $completion = $this->_customdata['completion'];
        $evidence = $this->_customdata['evidence'];

        $mform->addElement('header', 'itemhdr', format_string($item->fullname));
        $mform->setExpanded('itemhdr', true, true);

        $mform->addElement('date_time_selector', 'timecompleted', get_string('completiondate', 'enrol_programs'), ['optional' => true]);
        if ($completion && $completion->timecompleted) {
            $mform->setDefault('timecompleted', $completion->timecompleted);
        }

        $mform->addElement('header', 'evidencehdr', get_string('evidence', 'enrol_programs'));
        $mform->setExpanded('evidencehdr', true, true);

        $mform->addElement('date_time_selector', 'evidencetimecompleted', get_string('completiondate', 'enrol_programs'), ['optional' => true]);
        if ($evidence && $evidence->timecompleted) {
            $mform->setDefault('evidencetimecompleted', $evidence->timecompleted);
        }

        $mform->addElement('text', 'evidencedetails', get_string('evidence_details' , 'enrol_programs'));
        $mform->setType('evidencedetails', PARAM_TEXT);
        if ($evidence && $evidence->evidencejson) {
            $data = (object)json_decode($evidence->evidencejson);
            if ($data->details) {
                $mform->setDefault('evidencedetails', $data->details);
            }
        }
        $mform->hideIf('evidencedetails', 'evidencetimecompleted[enabled]', 'notchecked');

        $mform->addElement('hidden', 'allocationid');
        $mform->setType('allocationid', PARAM_INT);
        $mform->setDefault('allocationid', $allocation->id);

        $mform->addElement('hidden', 'itemid');
        $mform->setType('itemid', PARAM_INT);
        $mform->setDefault('itemid', $item->id);

        $this->add_action_buttons(true, get_string('update'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if ($data['evidencetimecompleted']) {
            if (trim($data['evidencedetails']) === '') {
                $errors['evidencedetails'] = get_string('required');
            }
        }

        return $errors;
    }
}
