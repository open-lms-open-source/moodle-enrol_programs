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

use enrol_programs\local\source\externaldb;

/**
 * Edit external database allocation settings.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_externaldb_edit extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $source = $this->_customdata['source'];
        $program = $this->_customdata['program'];

        $mform->addElement('select', 'enable', get_string('active'), ['1' => get_string('yes'), '0' => get_string('no')]);
        $mform->setDefault('enable', $source->enable);
        if (!empty($source->hasallocations)) {
            $mform->hardFreeze('enable');
        }

        $config = externaldb::get_connection_settings();
        if ($config) {
            $summary = (object)[
                'table' => $config->remotetable,
                'programfield' => $config->programfield,
                'userfield' => $config->userfield,
            ];
            $mform->addElement('static', 'externaldbinfo', '', get_string('source_externaldb_configinfo', 'enrol_programs', $summary));
        } else {
            $mform->addElement('static', 'externaldbwarning', '', get_string('source_externaldb_confignotset', 'enrol_programs'));
        }

        $mform->addElement('text', 'externaldb_programvalue', get_string('source_externaldb_programvalue', 'enrol_programs'));
        $mform->setType('externaldb_programvalue', PARAM_TEXT);
        $mform->setDefault('externaldb_programvalue', $source->externaldb_programvalue ?? '');
        $mform->addHelpButton('externaldb_programvalue', 'source_externaldb_programvalue', 'enrol_programs');
        $mform->hideIf('externaldb_programvalue', 'enable', 'eq', 0);

        $mform->addElement('advcheckbox', 'externaldb_archivemissing', get_string('source_externaldb_archivemissing', 'enrol_programs'));
        $mform->setType('externaldb_archivemissing', PARAM_BOOL);
        $mform->setDefault('externaldb_archivemissing', $source->externaldb_archivemissing ?? 1);
        $mform->addHelpButton('externaldb_archivemissing', 'source_externaldb_archivemissing', 'enrol_programs');
        $mform->hideIf('externaldb_archivemissing', 'enable', 'eq', 0);

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

        if (!empty($data['enable'])) {
            $config = externaldb::get_connection_settings();
            if (!$config) {
                $errors['enable'] = get_string('source_externaldb_confignotset', 'enrol_programs');
            } else if (trim($data['externaldb_programvalue'] ?? '') === '') {
                $field = $config->localprogramfield ?? 'idnumber';
                $program = $this->_customdata['program'];
                $value = $program->$field ?? '';
                if (trim((string)$value) === '') {
                    $errors['externaldb_programvalue'] = get_string('source_externaldb_missingprogramvalue', 'enrol_programs', $field);
                }
            }
        }

        return $errors;
    }
}
