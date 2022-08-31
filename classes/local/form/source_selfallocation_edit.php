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
 * Edit program self allocation settings.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_selfallocation_edit extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $context = $this->_customdata['context'];
        $source = $this->_customdata['source'];
        $program = $this->_customdata['program'];

        $mform->addElement('select', 'enable', get_string('active'), ['1' => get_string('yes'), '0' => get_string('no')]);
        $mform->setDefault('enable', $source->enable);
        if ($source->hasallocations) {
            $mform->hardFreeze('enable');
        }

        $mform->addElement('select', 'selfallocation_allowsignup', get_string('source_selfallocation_allowsignup', 'enrol_programs'),
            ['1' => get_string('yes'), '0' => get_string('no')]);
        $mform->setDefault('selfallocation_allowsignup', 1);
        $mform->hideIf('selfallocation_allowsignup', 'enable', 'eq', '0');

        $mform->addElement('passwordunmask', 'selfallocation_key', get_string('source_selfallocation_key', 'enrol_programs'));
        $mform->setDefault('selfallocation_key', $source->selfallocation_key);
        $mform->hideIf('selfallocation_key', 'enable', 'eq', '0');

        $mform->addElement('text', 'selfallocation_maxusers', get_string('source_selfallocation_maxusers', 'enrol_programs'), 'size="8"');
        $mform->setType('selfallocation_maxusers', PARAM_RAW);
        $mform->setDefault('selfallocation_maxusers', $source->selfallocation_maxusers);
        $mform->hideIf('selfallocation_maxusers', 'enable', 'eq', '0');

        $mform->addElement('hidden', 'programid');
        $mform->setType('programid', PARAM_INT);
        $mform->setDefault('programid', $program->id);

        $mform->addElement('hidden', 'type');
        $mform->setType('type', PARAM_ALPHANUMEXT);
        $mform->setDefault('type', $source->type);

        $this->add_action_buttons(true, get_string('update'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if ($data['selfallocation_maxusers'] !== '') {
            if (!is_number($data['selfallocation_maxusers'])) {
                $errors['selfallocation_maxusers'] = get_string('error');
            } else if ($data['selfallocation_maxusers'] < 0) {
                $errors['selfallocation_maxusers'] = get_string('error');
            }
        }

        return $errors;
    }
}
