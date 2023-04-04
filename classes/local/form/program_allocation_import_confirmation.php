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
use enrol_programs\local\program;
use enrol_programs\local\util;

/**
 * Import program allocation
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_allocation_import_confirmation extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB, $PAGE;
        $mform = $this->_form;
        $customdata = $this->_customdata;
        $managementoutput = $PAGE->get_renderer('enrol_programs', 'management');
        $programid = $customdata['fromprogram'];
        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        $mform->addElement('html', get_string('importprogramallocationconfirmation', 'enrol_programs', $program->fullname));

        $programgeneraloutput = $managementoutput->render_program_general($program);
        $mform->addElement('html', $programgeneraloutput);

        $mform->addElement('html', '<h5>'.get_string('allocations', 'enrol_programs').'</h5>');
        $mform->addElement('html', '<dl class="row"><dt class="col-3">'.get_string('allocationstart', 'enrol_programs').' : </dt><dd>'.
            ($program->timeallocationstart ? userdate($program->timeallocationstart) : get_string('notset', 'enrol_programs')).'</dd></dl>');
        $mform->addElement('checkbox', 'importallocationstart', get_string('importallocationstart', 'enrol_programs'));
        $mform->addElement('html', '<dl class="row"><dt class="col-3">'.get_string('allocationend', 'enrol_programs').' : </dt><dd>'.
            ($program->timeallocationend ? userdate($program->timeallocationend) : get_string('notset', 'enrol_programs')).'</dd></dl>');
        $mform->addElement('checkbox', 'importallocationend', get_string('importallocationend', 'enrol_programs'));


        $mform->addElement('html', '<h5>'.get_string('scheduling', 'enrol_programs').'</h5>');

        $start = (object)json_decode($program->startdatejson);
        $types = program::get_program_startdate_types();

        if ($start->type === 'date') {
            $startdate = userdate($start->date);
        } else if ($start->type === 'delay') {
            $startdate = $types[$start->type] . ' - ' . util::format_delay($start->delay);
        } else {
            $startdate = $types[$start->type];
        }

        $mform->addElement('html', '<dl class="row"><dt class="col-3">'.get_string('programstart', 'enrol_programs').' : </dt><dd>'.
            $startdate.'</dd></dl>');
        $mform->addElement('checkbox', 'importprogramstart', get_string('importprogramstart', 'enrol_programs'));

        $due = (object)json_decode($program->duedatejson);
        $types = program::get_program_duedate_types();

        if ($due->type === 'date') {
            $duedate = userdate($due->date);
        } else if ($due->type === 'delay') {
            $duedate = $types[$due->type] . ' - ' . util::format_delay($due->delay);
        } else {
            $duedate = $types[$due->type];
        }

        $mform->addElement('html', '<dl class="row"><dt class="col-3">'.get_string('programdue', 'enrol_programs').' : </dt><dd>'.
            $duedate.'</dd></dl>');
        $mform->addElement('checkbox', 'importprogramdue', get_string('importprogramdue', 'enrol_programs'));

        $end = (object)json_decode($program->enddatejson);
        $types = program::get_program_enddate_types();

        if ($end->type === 'date') {
            $enddate = userdate($end->date);
        } else if ($end->type === 'delay') {
            $enddate = $types[$end->type] . ' - ' . util::format_delay($end->delay);
        } else {
            $enddate = $types[$end->type];
        }

        $mform->addElement('html', '<dl class="row"><dt class="col-3">'.get_string('programend', 'enrol_programs').' : </dt><dd>'.
            $enddate.'</dd></dl>');
        $mform->addElement('checkbox', 'importprogramend', get_string('importprogramend', 'enrol_programs'));

        $mform->addElement('html', '<h4>'.get_string('allocationsources', 'enrol_programs').'</h4>');

        $mform->addElement('html', get_string('importallocationsources', 'enrol_programs'));

        $sources = [];
        /** @var \enrol_programs\local\source\base[] $sourceclasses */
        $sourceclasses = \enrol_programs\local\allocation::get_source_classes();
        foreach ($sourceclasses as $sourcetype => $sourceclass) {
            $sourcerecord = $DB->get_record('enrol_programs_sources', ['type' => $sourcetype, 'programid' => $program->id]);
            if ($sourcerecord && $sourceclass::is_import_allowed($program)) {
                $sources[] = $sourcetype;
            }

        }

        foreach ($sources as $source) {
            $name = $sourceclasses[$source]::get_name();
            $mform->addElement('checkbox', 'importsource'.$source, $name);
        }

        $mform->addElement('hidden', 'fromprogram');
        $mform->setType('fromprogram', PARAM_INT);
        $mform->setDefault('fromprogram', $customdata['fromprogram']);


        $this->add_action_buttons(true, get_string('importprogramallocation', 'enrol_programs'));
    }

    public function validation($data, $files) {

    }
}
