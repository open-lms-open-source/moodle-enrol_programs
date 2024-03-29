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
use enrol_programs\local\util;

/**
 * Import program allocation - confirmation step.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_allocation_import_confirmation extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB, $PAGE, $OUTPUT;
        $mform = $this->_form;

        $renderer = $PAGE->get_renderer('core', null, RENDERER_TARGET_GENERAL);

        $targetprogram = $DB->get_record('enrol_programs_programs', ['id' => $this->_customdata['id']], '*', MUST_EXIST);
        $fromprogram = $DB->get_record('enrol_programs_programs', ['id' => $this->_customdata['fromprogram']], '*', MUST_EXIST);

        $fromcontext = \context::instance_by_id($fromprogram->contextid);

        $a = new \stdClass();
        $a->fullname = format_string($fromprogram->fullname);
        $a->idnumber = s($fromprogram->idnumber);
        $a->category = $fromcontext->get_context_name(false);
        $message = get_string('importprogramallocationconfirmation', 'enrol_programs', $a);
        $message = markdown_to_html($message);
        $message = $renderer->notification($message, \core\notification::INFO);
        $mform->addElement('html', $message);

        $mform->addElement('header', 'allocationheading', get_string('allocations', 'enrol_programs'));
        $mform->setExpanded('allocationheading', true, true);
        $a = $fromprogram->timeallocationstart ? userdate($fromprogram->timeallocationstart) : get_string('notset', 'enrol_programs');
        $mform->addElement('advcheckbox', 'importallocationstart', get_string('importallocationstart', 'enrol_programs', $a));
        $a = $fromprogram->timeallocationend ? userdate($fromprogram->timeallocationend) : get_string('notset', 'enrol_programs');
        $mform->addElement('advcheckbox', 'importallocationend', get_string('importallocationend', 'enrol_programs', $a));

        $mform->addElement('header', 'schedulingheading', get_string('scheduling', 'enrol_programs'));
        $mform->setExpanded('schedulingheading', true, true);

        $start = (object)json_decode($fromprogram->startdatejson);
        $types = program::get_program_startdate_types();

        if ($start->type === 'date') {
            $startdate = userdate($start->date);
        } else if ($start->type === 'delay') {
            $startdate = $types[$start->type] . ' - ' . util::format_delay($start->delay);
        } else {
            $startdate = $types[$start->type];
        }
        $mform->addElement('advcheckbox', 'importprogramstart', get_string('importprogramstart', 'enrol_programs', $startdate));

        $due = (object)json_decode($fromprogram->duedatejson);
        $types = program::get_program_duedate_types();

        if ($due->type === 'date') {
            $duedate = userdate($due->date);
        } else if ($due->type === 'delay') {
            $duedate = $types[$due->type] . ' - ' . util::format_delay($due->delay);
        } else {
            $duedate = $types[$due->type];
        }
        $mform->addElement('advcheckbox', 'importprogramdue', get_string('importprogramdue', 'enrol_programs', $duedate));

        $end = (object)json_decode($fromprogram->enddatejson);
        $types = program::get_program_enddate_types();

        if ($end->type === 'date') {
            $enddate = userdate($end->date);
        } else if ($end->type === 'delay') {
            $enddate = $types[$end->type] . ' - ' . util::format_delay($end->delay);
        } else {
            $enddate = $types[$end->type];
        }
        $mform->addElement('advcheckbox', 'importprogramend', get_string('importprogramend', 'enrol_programs', $enddate));

        $mform->addElement('header', 'sourcesheading', get_string('allocationsources', 'enrol_programs'));
        $mform->setExpanded('sourcesheading', true, true);

        /** @var \enrol_programs\local\source\base[] $sourceclasses */
        $sourceclasses = \enrol_programs\local\allocation::get_source_classes();
        foreach ($sourceclasses as $sourcetype => $sourceclass) {
            if (!$sourceclass::is_import_allowed($fromprogram, $targetprogram)) {
                continue;
            }

            $source = $DB->get_record('enrol_programs_sources', ['type' => $sourcetype, 'programid' => $fromprogram->id]);
            if (!$source) {
                $source = null;
            }

            $status = $sourceclass::render_status_details($fromprogram, $source);
            $mform->addElement('advcheckbox', 'importsource' . $sourcetype, $sourceclass::get_name() . ' (' . $status . ')');
        }

        $mform->addElement('hidden', 'fromprogram');
        $mform->setType('fromprogram', PARAM_INT);
        $mform->setDefault('fromprogram', $fromprogram->id);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $targetprogram->id);

        $this->add_action_buttons(true, get_string('importprogramallocation', 'enrol_programs'));
    }

    public function validation($data, $files) {
        global $DB;
        $errors = parent::validation($data, $files);

        $targetprogram = $DB->get_record('enrol_programs_programs', ['id' => $this->_customdata['id']], '*', MUST_EXIST);
        $fromprogram = $DB->get_record('enrol_programs_programs', ['id' => $this->_customdata['fromprogram']], '*', MUST_EXIST);

        // Check if the user has capability to copy the selected program.
        $context = \context::instance_by_id($fromprogram->contextid);
        if (!has_capability('enrol/programs:clone', $context )) {
            $errors['fromprogram'] = get_string('error');
        }

        // Make sure the new start and end dates are valid.
        if ($data['importallocationstart']) {
            $targetprogram->timeallocationstart = $fromprogram->timeallocationstart;
        }
        if ($data['importallocationend']) {
            $targetprogram->timeallocationend = $fromprogram->timeallocationend;
        }
        if ($targetprogram->timeallocationstart && $targetprogram->timeallocationend
            && $targetprogram->timeallocationstart >= $targetprogram->timeallocationend
        ) {
            if ($data['importallocationstart']) {
                $errors['timeallocationstart'] = get_string('error');
            }
            if ($data['importallocationend']) {
                $errors['timeallocationend'] = get_string('error');
            }
        }

        return $errors;
    }
}
