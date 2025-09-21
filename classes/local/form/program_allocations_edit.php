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
<<<<<<< HEAD
=======
use html_writer;
>>>>>>> e3f9c16 (Add privacy provider tests and cron task tests for enrol_programs plugin)

/**
 * Edit program allocation.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_allocations_edit extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $data = $this->_customdata['data'];
        $context = $this->_customdata['context'];

        $mform->addElement('date_time_selector', 'timeallocationstart', get_string('allocationstart', 'enrol_programs'), ['optional' => true]);
        $mform->addHelpButton('timeallocationstart', 'allocationstart', 'enrol_programs');

        $mform->addElement('date_time_selector', 'timeallocationend', get_string('allocationend', 'enrol_programs'), ['optional' => true]);
        $mform->addHelpButton('timeallocationend', 'allocationend', 'enrol_programs');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $data->id);

<<<<<<< HEAD
=======
        $mform->addElement('static', 'sourcesummary', get_string('allocationsources', 'enrol_programs'),
            $this->get_sources_overview($data));
        $mform->setType('sourcesummary', PARAM_RAW);

>>>>>>> e3f9c16 (Add privacy provider tests and cron task tests for enrol_programs plugin)
        $this->add_action_buttons(true, get_string('updateallocations', 'enrol_programs'));

        $this->set_data($data);
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if ($data['timeallocationstart'] && $data['timeallocationend']
            && $data['timeallocationstart'] >= $data['timeallocationend']) {
            $errors['timeallocationend'] = get_string('error');
        }

        return $errors;
    }
<<<<<<< HEAD
=======

    /**
     * Render allocation source overview with management links.
     *
     * @param \stdClass $program
     * @return string
     */
    protected function get_sources_overview(\stdClass $program): string {
        global $DB;

        $sourceclasses = allocation::get_source_classes();
        $items = [];
        foreach ($sourceclasses as $type => $class) {
            $record = $DB->get_record('enrol_programs_sources', ['type' => $type, 'programid' => $program->id]);
            if (!$record && !$class::is_new_allowed($program)) {
                continue;
            }
            $items[$type] = $class::render_status($program, $record ?: null);
        }

        if (!$items) {
            return get_string('notavailable');
        }

        $output = html_writer::start_tag('dl', ['class' => 'row']);
        foreach ($items as $type => $status) {
            $name = $sourceclasses[$type]::get_name();
            $output .= html_writer::tag('dt', $name . ':', ['class' => 'col-3']);
            $output .= html_writer::tag('dd', $status, ['class' => 'col-9']);
        }
        $output .= html_writer::end_tag('dl');
        return $output;
    }
>>>>>>> e3f9c16 (Add privacy provider tests and cron task tests for enrol_programs plugin)
}
