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
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_manual_allocate extends \local_openlms\dialog_form {
    /** @var array $arguments for WS call to get candidate users */
    protected $arguments;
    protected function definition() {
        $mform = $this->_form;
        $program = $this->_customdata['program'];
        $source = $this->_customdata['source'];
        $context = $this->_customdata['context'];

        $this->arguments = ['programid' => $program->id];
        \enrol_programs\external\form_source_manual_allocate_users::add_form_element(
            $mform, $this->arguments, 'users', get_string('users'));

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

        $context = $this->_customdata['context'];

        if ($data['cohortid']) {
            $cohort = $DB->get_record('cohort', ['id' => $data['cohortid']], '*', MUST_EXIST);
            $cohortcontext = \context::instance_by_id($cohort->contextid);
            if (!$cohort->visible && !has_capability('moodle/cohort:view', $cohortcontext)) {
                $errors['cohortid'] = get_string('error');
            }
            if (\enrol_programs\local\tenant::is_active()) {
                $tenantid = \tool_olms_tenant\tenants::get_context_tenant_id($context);
                if ($tenantid) {
                    $cohorttenantid = \tool_olms_tenant\tenants::get_context_tenant_id($cohortcontext);
                    if ($cohorttenantid && $cohorttenantid != $tenantid) {
                        $errors['cohortid'] = get_string('error');
                    }
                }
            }
        }

        if ($data['users']) {
            foreach ($data['users'] as $userid) {
                $error = \enrol_programs\external\form_source_manual_allocate_users::validate_form_value(
                    $this->arguments, $userid, $context);
                if ($error !== null) {
                    $errors['users'] = $error;
                    break;
                }
            }
        }

        return $errors;
    }

}
