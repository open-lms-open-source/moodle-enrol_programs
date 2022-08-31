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

use enrol_programs\local\content\set;
use enrol_programs\local\content\top;

/**
 * Edit program content item.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class item_set_edit extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB;

        $mform = $this->_form;
        /** @var set $set */
        $set = $this->_customdata['set'];

        $mform->addElement('text', 'fullname', get_string('fullname'), 'maxlength="254" size="50"');
        $mform->setType('fullname', PARAM_TEXT);
        $mform->setDefault('fullname', format_string($set->get_fullname()));
        if ($set instanceof top) {
            $mform->freeze('fullname');
        } else {
            $mform->addRule('fullname', get_string('required'), 'required', null, 'client');
        }

        $stypes = set::get_sequencetype_types();
        $mform->addElement('select', 'sequencetype', get_string('sequencetype', 'enrol_programs'), $stypes);
        $mform->setDefault('sequencetype', $set->get_sequencetype());

        $mform->addElement('text', 'minprerequisites', $stypes[set::SEQUENCE_TYPE_ATLEAST]);
        $mform->setType('minprerequisites', PARAM_INT);
        $mform->setDefault('minprerequisites', 1);
        $mform->hideIf('minprerequisites', 'sequencetype', 'noteq', set::SEQUENCE_TYPE_ATLEAST);
        $mform->setDefault('minprerequisites', $set->get_minprerequisites());

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $set->get_id());

        $this->add_action_buttons(true, get_string('updateset', 'enrol_programs'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (trim($data['fullname']) === '') {
            $errors['fullname'] = get_string('required');
        }
        if ($data['sequencetype'] === set::SEQUENCE_TYPE_ATLEAST) {
            if ($data['minprerequisites'] <= 0) {
                $errors['minprerequisites'] = get_string('required');
            }
        }

        return $errors;
    }
}
