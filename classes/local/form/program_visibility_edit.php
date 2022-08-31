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

use enrol_programs\local\management;

/**
 * Edit program visibility.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_visibility_edit extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $data = $this->_customdata['data'];
        $context = $this->_customdata['context'];

        $mform->addElement('select', 'public', get_string('public', 'enrol_programs'), [0 => get_string('no'), 1 => get_string('yes')]);
        $mform->setDefault('public', $data->public);
        $mform->addHelpButton('public', 'public', 'enrol_programs');

        $options = ['contextid' => $context->id, 'multiple' => true];
        /** @var \MoodleQuickForm_cohort $cohortsel */
        $cohortsel = $mform->addElement('cohort', 'cohorts', get_string('cohorts', 'enrol_programs'), $options);
        $mform->addHelpButton('cohorts', 'cohorts', 'enrol_programs');
        // WARNING: The cohort element is not great at all, work around the current value problems here in a very hacky way.
        $cohorts = management::fetch_current_cohorts_menu($data->id);
        $cohorts = array_map('format_string', $cohorts);
        foreach ($cohorts as $cid => $cname) {
            $cohortsel->addOption($cname, $cid);
        }
        $cohortsel->setSelected(array_keys($cohorts));

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $data->id);

        $this->add_action_buttons(true, get_string('updateprogram', 'enrol_programs'));
    }

    public function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);

        $currentcohorts = management::fetch_current_cohorts_menu($data['id']);
        foreach ($data['cohorts'] as $cohortid) {
            if (isset($currentcohorts[$cohortid])) {
                // Allow current.
                continue;
            }
            $cohort = $DB->get_record('cohort', array('id' => $cohortid), 'id, contextid, visible');
            if ($cohort->visible) {
                // NOTE: add some tenant restrictions here if necessary.
                continue;
            }
            $cohortcontext = \context::instance_by_id($cohort->contextid);
            if (has_capability('moodle/cohort:view', $cohortcontext)) {
                continue;
            }
            $errors['cohorts'] = get_string('error');
            break;
        }

        return $errors;
    }
}
