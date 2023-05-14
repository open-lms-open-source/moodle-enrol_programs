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
use enrol_programs\local\source\cohort;

/**
 * Edit cohort allocation settings.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_cohort_edit extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB;
        $mform = $this->_form;
        $context = $this->_customdata['context'];
        $source = $this->_customdata['source'];
        $program = $this->_customdata['program'];

        $mform->addElement('select', 'enable', get_string('active'), ['1' => get_string('yes'), '0' => get_string('no')]);
        $mform->setDefault('enable', $source->enable);
        if ($source->hasallocations) {
            $mform->hardFreeze('enable');
        }

        $options = ['contextid' => $context->id, 'multiple' => true];
        /** @var \MoodleQuickForm_cohort $cohortsel */
        $cohortsel = $mform->addElement('cohort', 'cohorts', get_string('source_cohort_cohortstoallocate',
            'enrol_programs'), $options);
        // WARNING: The cohort element is not great at all, work around the current value problems here in a very hacky way.
        if (!empty($source->id)) {
            $cohorts = cohort::fetch_allocation_cohorts_menu($source->id);
            $cohorts = array_map('format_string', $cohorts);
            foreach ($cohorts as $cid => $cname) {
                $cohortsel->addOption($cname, $cid);
            }
            $cohortsel->setSelected(array_keys($cohorts));
        }
        $mform->hideIf('cohorts', 'enable', 'eq', 0);

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

        return $errors;
    }
}
