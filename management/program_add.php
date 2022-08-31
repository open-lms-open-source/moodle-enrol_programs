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

use enrol_programs\local\program;
use enrol_programs\local\management;

if (!empty($_SERVER['HTTP_X_LEGACY_DIALOG_FORM_REQUEST'])) {
    define('AJAX_SCRIPT', true);
}

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$contextid = required_param('contextid', PARAM_INT);
$context = context::instance_by_id($contextid);

require_login();
require_capability('enrol/programs:edit', $context);

if ($context->contextlevel != CONTEXT_SYSTEM && $context->contextlevel != CONTEXT_COURSECAT) {
    throw new moodle_exception('invalidcontext');
}

$currenturl = new moodle_url('/enrol/programs/management/program_add.php', ['contextid' => $context->id]);
management::setup_index_page($currenturl, $context, $context->id);

$program = new stdClass();
$program->contextid = $context->id;
$program->fullname = '';
$program->idnumber = '';
$program->creategroups = 0;
$program->description = '';
$program->descriptionformat = FORMAT_HTML;

$editoroptions = program::get_description_editor_options($context->id);

$form = new \enrol_programs\local\form\program_add(null, ['data' => $program, 'editoroptions' => $editoroptions]);

if ($form->is_cancelled()) {
    redirect(new moodle_url('/enrol/programs/management/index.php', ['contextid' => $context->id]));
}

if ($data = $form->get_data()) {
    $program = program::add_program($data);
    $returlurl = new moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);
    $form->redirect_submitted($returlurl);
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('addprogram', 'enrol_programs'));

echo $form->render();

echo $OUTPUT->footer();
