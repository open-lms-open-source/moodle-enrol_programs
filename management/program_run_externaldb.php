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
 * Manual trigger for external database allocation synchronisation.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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

$returnurl = new moodle_url('/enrol/programs/management/program_allocation.php', ['id' => $program->id]);
if ($program->archived) {
    redirect($returnurl);
}

$sourcerecord = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => 'externaldb']);
if (!$sourcerecord) {
    redirect($returnurl);
}

$sourceclasses = enrol_programs\local\allocation::get_source_classes();
/** @var enrol_programs\local\source\externaldb $sourceclass */
$sourceclass = $sourceclasses['externaldb'];

if (!$sourceclass::is_configured()) {
    redirect($returnurl, get_string('source_externaldb_confignotset', 'enrol_programs'), 5, \core\output\notification::NOTIFY_ERROR);
}

enrol_programs\local\management::setup_program_page(
    new moodle_url('/enrol/programs/management/program_run_externaldb.php', ['id' => $program->id]),
    $context,
    $program
);

$form = new enrol_programs\local\form\externaldb_run(null, ['program' => $program]);

if ($form->is_cancelled()) {
    $form->redirect_submitted($returnurl);
}

if ($data = $form->get_data()) {
    $updated = $sourceclass::fix_allocations($program->id, null);
    if ($updated) {
        enrol_programs\local\allocation::fix_user_enrolments($program->id, null);
    }
    $form->redirect_submitted($returnurl, get_string('source_externaldb_runcomplete', 'enrol_programs'));
}

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'allocation');

echo $form->render();

echo $OUTPUT->footer();
