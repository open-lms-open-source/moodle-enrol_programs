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

if (!empty($_SERVER['HTTP_X_LEGACY_DIALOG_FORM_REQUEST'])) {
    define('AJAX_SCRIPT', true);
}

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$id = required_param('id', PARAM_INT);

require_login();

$program = $DB->get_record('enrol_programs_programs', ['id' => $id], '*', MUST_EXIST);
$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:edit', $context);

$currenturl = new moodle_url('/enrol/programs/management/program_update.php', ['id' => $program->id]);
management::setup_program_page($currenturl, $context, $program);

$editoroptions = program::get_description_editor_options($context->id);
$program = file_prepare_standard_editor($program, 'description', $editoroptions,
    $context, 'enrol_programs', 'description', $program->id);
$program->tags = core_tag_tag::get_item_tags_array('enrol_programs', 'program', $program->id);

$program->image = file_get_submitted_draft_itemid('image');
file_prepare_draft_area($program->image, $context->id, 'enrol_programs', 'image', $program->id, ['subdirs' => 0]);

$form = new \enrol_programs\local\form\program_update(null, ['data' => $program, 'editoroptions' => $editoroptions]);

$returnurl = new moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);

if ($form->is_cancelled()) {
    redirect($returnurl);
}

if ($data = $form->get_data()) {
    $program = program::update_program_general($data);
    $form->redirect_submitted($returnurl);
}

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('updateprogram', 'enrol_programs'));

echo $managementoutput->render_management_program_tabs($program, 'general');

echo $form->render();

echo $OUTPUT->footer();
