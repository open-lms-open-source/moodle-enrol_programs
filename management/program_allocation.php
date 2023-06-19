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

/**
 * Program management interface.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/** @var moodle_database $DB */
/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */
/** @var stdClass $CFG */
/** @var stdClass $COURSE */

use enrol_programs\local\management;
use enrol_programs\local\program;
use enrol_programs\local\util;

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$id = required_param('id', PARAM_INT);

require_login();

$program = $DB->get_record('enrol_programs_programs', ['id' => $id], '*', MUST_EXIST);
$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:view', $context);

$currenturl = new moodle_url('/enrol/programs/management/program_allocation.php', ['id' => $id]);

management::setup_program_page($currenturl, $context, $program);
$PAGE->set_docs_path("$CFG->wwwroot/enrol/programs/documentation.php/program_allocation.md");

/** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
$dialogformoutput = $PAGE->get_renderer('local_openlms', 'dialog_form');
/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'allocation');

if (has_capability('enrol/programs:edit', $context)) {
    $editurl = new moodle_url('/enrol/programs/management/program_allocations_edit.php', ['id' => $program->id]);
    $editbutton = new local_openlms\output\dialog_form\icon($editurl, 'i/settings', get_string('updateallocations', 'enrol_programs'));
    $editbutton->set_dialog_name(get_string('allocations', 'enrol_programs'));
    $editbutton = ' ' . $dialogformoutput->render($editbutton);
} else {
    $editbutton = '';
}
echo $OUTPUT->heading(get_string('allocations', 'enrol_programs') . $editbutton, 3);
echo $managementoutput->render_program_allocation($program);

if (has_capability('enrol/programs:edit', $context)) {
    $editurl = new moodle_url('/enrol/programs/management/program_scheduling_edit.php', ['id' => $program->id]);
    $editbutton = new local_openlms\output\dialog_form\icon($editurl, 'i/settings', get_string('updatescheduling', 'enrol_programs'));
    $editbutton->set_dialog_name(get_string('scheduling', 'enrol_programs'));
    $editbutton = ' ' . $dialogformoutput->render($editbutton);
} else {
    $editbutton = '';
}
echo $OUTPUT->heading(get_string('scheduling', 'enrol_programs') . $editbutton, 3);
echo $managementoutput->render_program_scheduling($program);

echo $OUTPUT->heading(get_string('allocationsources', 'enrol_programs'), 3);
echo $managementoutput->render_program_sources($program);

echo $OUTPUT->footer();
