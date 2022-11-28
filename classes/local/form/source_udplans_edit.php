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
 * Edit UDP source settings.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_udplans_edit extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $context = $this->_customdata['context'];
        $source = $this->_customdata['source'];
        $program = $this->_customdata['program'];
        $sourceid = empty($source->id) ? null : $source->id;

        $mform->addElement('select', 'enable', get_string('active'), ['1' => get_string('yes'), '0' => get_string('no')]);
        $mform->setDefault('enable', $source->enable);
        if ($source->hasallocations) {
            $mform->hardFreeze('enable');
        }

        $mform->addElement('header', 'hdrframeworks', get_string('frameworks', 'tool_udplans'));

        $options = [
            -1 => get_string('source_udplans_notallowed', 'enrol_programs'),
            0 => get_string('source_udplans_allowed', 'enrol_programs'),
            1 => get_string('source_udplans_requirecap', 'enrol_programs'),
        ];
        $frameworks = \enrol_programs\local\source\udplans::get_relevant_frameworks($program->id, $sourceid);
        foreach ($frameworks as $framework) {
            $mform->addElement('select', 'framework['.$framework->id.']', format_string($framework->name), $options);
            $mform->setDefault('framework['.$framework->id.']', $framework->requirecap);
        }

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
