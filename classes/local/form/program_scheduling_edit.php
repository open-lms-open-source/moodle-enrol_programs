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
 * Edit program scheduling settings.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_scheduling_edit extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $data = $this->_customdata['data'];
        $context = $this->_customdata['context'];

        $this->parse_program_allocation_date($data, 'start');
        $this->add_program_date('start');

        $this->parse_program_allocation_date($data, 'due');
        $this->add_program_date('due');

        $this->parse_program_allocation_date($data, 'end');
        $this->add_program_date('end');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $data->id);

        $this->add_action_buttons(true, get_string('updatescheduling', 'enrol_programs'));

        $this->set_data($data);
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        $this->validate_program_date('start', $data, $errors);
        $this->validate_program_date('due', $data, $errors);
        $this->validate_program_date('end', $data, $errors);

        return $errors;
    }

    protected function add_program_date(string $name): void {
        $mform = $this->_form;

        $delaytypes = [
            'months' => get_string('months'),
            'days' => get_string('days'),
            'hours' => get_string('hours'),
        ];

        $datetypes = program::{'get_program_' . $name . 'date_types'}();

        $mform->addElement('select', 'program' . $name. '_type', get_string('program' . $name, 'enrol_programs'), $datetypes);
        $mform->addHelpButton('program' . $name. '_type', 'program' . $name, 'enrol_programs');
        $mform->addElement('date_time_selector', 'program' . $name . '_date', get_string('program' . $name . '_date', 'enrol_programs'), ['optional' => false]);
        $mform->hideIf('program' . $name . '_date', 'program' . $name . '_type', 'notequal', 'date');
        $dvalue = $mform->createElement('text', 'value', '');
        $dtype = $mform->createElement('select', 'type', '', $delaytypes);
        $mform->addGroup([$dvalue, $dtype], 'program' . $name . '_delay', get_string('program' . $name . '_delay', 'enrol_programs'));
        $mform->setType('program' . $name . '_delay[value]', PARAM_INT);
        $mform->hideIf('program' . $name . '_delay', 'program' . $name . '_type', 'notequal', 'delay');
    }

    protected function validate_program_date(string $name, array $data, array &$errors): void {
        if ($data['program' . $name . '_type'] === 'delay') {
            if ($data['program' . $name . '_delay']['value'] <= 0) {
                $errors['program' . $name . '_delay'] = get_string('required');
            }
        }
        if ($name !== 'start') {
            if ($data['program' . $name . '_type'] === 'date') {
                if ($data['programstart_type'] === 'date') {
                    if ($data['programstart_date'] >= $data['program' . $name . '_date']) {
                        $errors['program' . $name . '_date'] = get_string('error');
                    }
                }
            }
            if ($name === 'end') {
                if ($data['programdue_type'] === 'date' && $data['programend_type'] === 'date') {
                    if ($data['programdue_date'] > $data['programend_date']) {
                        $errors['programend_date'] = get_string('error');
                    }
                }
            }
        }
    }

    protected function parse_program_allocation_date(\stdClass $program, string $name): void {
        if (!$program->{$name . 'datejson'}) {
            return;
        }

        $start = (array)json_decode($program->{$name . 'datejson'});
        foreach ($start as $k => $v) {
            $program->{'program' . $name . '_' . $k} = $v;
        }

        if (isset($program->{'program' . $name . '_delay'})) {
            $di = new \DateInterval($program->{'program' . $name . '_delay'});
            $program->{'program' . $name . '_delay'} = [];
            if ($di->m) {
                $program->{'program' . $name . '_delay'}['type'] = 'months';
                $program->{'program' . $name . '_delay'}['value'] = $di->m;
            } else if ($di->d) {
                $program->{'program' . $name . '_delay'}['type'] = 'days';
                $program->{'program' . $name . '_delay'}['value'] = $di->d;
            } else if ($di->h) {
                $program->{'program' . $name . '_delay'}['type'] = 'hours';
                $program->{'program' . $name . '_delay'}['value'] = $di->h;
            }
        }
    }
}
