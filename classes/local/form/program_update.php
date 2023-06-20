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
 * Update program.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_update extends \local_openlms\dialog_form {
    protected function definition() {
        global $CFG;

        $mform = $this->_form;
        $editoroptions = $this->_customdata['editoroptions'];
        $data = $this->_customdata['data'];

        $mform->addElement('text', 'fullname', get_string('programname', 'enrol_programs'), 'maxlength="254" size="50"');
        $mform->addRule('fullname', get_string('required'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_TEXT);

        $mform->addElement('text', 'idnumber', get_string('idnumber'), 'maxlength="254" size="50"');
        $mform->addRule('idnumber', get_string('required'), 'required', null, 'client');
        $mform->setType('idnumber', PARAM_RAW); // Idnumbers are plain text.

        $options = $this->get_category_options($data->contextid);
        $mform->addElement('autocomplete', 'contextid', get_string('context', 'role'), $options);
        $mform->addRule('contextid', null, 'required', null, 'client');

        $mform->addElement('select', 'creategroups', get_string('creategroups', 'enrol_programs'), [0 => get_string('no'), 1 => get_string('yes')]);
        $mform->addHelpButton('creategroups', 'creategroups', 'enrol_programs');

        if ($CFG->usetags) {
            $mform->addElement('tags', 'tags', get_string('tags'), ['itemtype' => 'program', 'component' => 'enrol_programs']);
        }

        $options = \enrol_programs\local\program::get_image_filemanager_options();
        $mform->addElement('filemanager', 'image', get_string('programimage', 'enrol_programs'), null, $options);

        $mform->addElement('editor', 'description_editor', get_string('description'), ['rows' => 5], $editoroptions);
        $mform->setType('description_editor', PARAM_RAW);

        $mform->addElement('select', 'archived', get_string('programsarchived', 'enrol_programs'), [0 => get_string('no'), 1 => get_string('yes')]);
        $mform->addHelpButton('archived', 'programsarchived', 'enrol_programs');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons(true, get_string('updateprogram', 'enrol_programs'));

        $this->set_data($data);
    }

    public function validation($data, $files) {
        global $DB;

        $olddata = $this->_customdata['data'];

        $errors = parent::validation($data, $files);

        if (trim($data['fullname']) === '') {
            $errors['fullname'] = get_string('required');
        }

        if (trim($data['idnumber']) === '') {
            $errors['idnumber'] = get_string('required');
        } else if (trim($data['idnumber']) !== $data['idnumber']) {
            $errors['idnumber'] = get_string('error');
        } else {
            if ($olddata->idnumber !== $data['idnumber']) {
                $select = 'idnumber = :idnumber AND id <> :id';
                $params = ['idnumber' => $data['idnumber'], 'id' => $olddata->id];
                if ($DB->record_exists_select('enrol_programs_programs', $select, $params)) {
                    $errors['idnumber'] = get_string('error');
                }
            }
        }

        $context = \context::instance_by_id($data['contextid'], IGNORE_MISSING);
        if (!$context) {
            $errors['contextid'] = get_string('required');
        } else if ($olddata->contextid != $data['contextid']) {
            if ($context->contextlevel != CONTEXT_SYSTEM && $context->contextlevel != CONTEXT_COURSECAT) {
                $errors['contextid'] = get_string('error');
            } else if (!has_capability('enrol/programs:edit', $context)) {
                $errors['contextid'] = get_string('error');
            }
        }

        return $errors;
    }

    protected function get_category_options(int $currentcontextid): array {
        $displaylist = \core_course_category::make_categories_list('enrol/programs:edit');
        $options = array();
        $syscontext = \context_system::instance();
        if (has_capability('enrol/programs:edit', $syscontext)) {
            $options[$syscontext->id] = $syscontext->get_context_name();
        }
        foreach ($displaylist as $cid => $name) {
            $context = \context_coursecat::instance($cid);
            $options[$context->id] = $name;
        }
        if (!isset($options[$currentcontextid])) {
            $context = \context::instance_by_id($currentcontextid, MUST_EXIST);
            $options[$context->id] = $syscontext->get_context_name();
        }
        return $options;
    }
}
