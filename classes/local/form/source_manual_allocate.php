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
 * Allocate users and cohorts manually.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_manual_allocate extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $program = $this->_customdata['program'];
        $source = $this->_customdata['source'];
        $context = $this->_customdata['context'];

        $attributes = [
            'multiple' => true,
            'ajax' => 'enrol_programs/form_candidate_selector',
            'valuehtmlcallback' => function($userid) {
                global $OUTPUT;

                $context = \context_system::instance();
                $fields = \core_user\fields::for_name()->with_identity($context, false);
                $record = \core_user::get_user($userid, 'id' . $fields->get_sql()->selects, MUST_EXIST);

                $user = (object) [
                    'id' => $record->id,
                    'fullname' => fullname($record, has_capability('moodle/site:viewfullnames', $context)),
                    'extrafields' => [],
                ];

                foreach ($fields->get_required_fields([\core_user\fields::PURPOSE_IDENTITY]) as $extrafield) {
                    $user->extrafields[] = (object) [
                        'name' => $extrafield,
                        'value' => s($record->$extrafield),
                    ];
                }

                return $OUTPUT->render_from_template('core_user/form_user_selector_suggestion', $user);
            },
        ];
        $mform->addElement('autocomplete', 'users', get_string('users'), [], $attributes);

        $options = ['contextid' => $context->id, 'multiple' => false];
        $mform->addElement('cohort', 'cohortid', get_string('cohort', 'cohort'), $options);

        $mform->addElement('hidden', 'programid');
        $mform->setType('programid', PARAM_INT);
        $mform->setDefault('programid', $source->programid);

        $mform->addElement('hidden', 'sourceid');
        $mform->setType('sourceid', PARAM_INT);
        $mform->setDefault('sourceid', $source->id);

        $this->add_action_buttons(true, get_string('source_manual_allocateusers', 'enrol_programs'));
    }

    public function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);

        if ($data['cohortid']) {
            $cohort = $DB->get_record('cohort', array('id' => $data['cohortid']), 'id, contextid, visible');
            if (!$cohort->visible) {
                $cohortcontext = \context::instance_by_id($cohort->contextid);
                if (!has_capability('moodle/cohort:view', $cohortcontext)) {
                    $errors['cohortid'] = get_string('error');
                }
            }
            // NOTE: Later add tenant access restrictions if cohort visible.
        }

        if ($data['users']) {
            foreach ($data['users'] as $userid) {
                $user = $DB->get_record('user', ['id' => $userid, 'deleted' => 0, 'confirmed' => 1], '*', MUST_EXIST);
                // NOTE: Later add tenant access restrictions here.
            }
        }

        return $errors;
    }

}
