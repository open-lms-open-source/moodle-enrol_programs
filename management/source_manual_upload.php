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
 * Uploads user allocations to program.
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
use enrol_programs\local\source\manual;

if (!empty($_SERVER['HTTP_X_LEGACY_DIALOG_FORM_REQUEST'])) {
    define('AJAX_SCRIPT', true);
}

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$sourceid = required_param('sourceid', PARAM_INT);
$draftitemid = optional_param('csvfile', null, PARAM_INT);

require_login();

$source = $DB->get_record('enrol_programs_sources', ['id' => $sourceid, 'type' => 'manual'], '*', MUST_EXIST);
$program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid], '*', MUST_EXIST);
$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:allocate', $context);

$currenturl = new moodle_url('/enrol/programs/management/source_manual_upload.php', ['sourceid' => $source->id]);
$returnurl = new moodle_url('/enrol/programs/management/program_users.php', ['id' => $program->id]);

if (!manual::is_allocation_possible($program, $source)) {
    redirect($returnurl);
}

management::setup_program_page($currenturl, $context, $program);

$filedata = null;
if ($draftitemid && confirm_sesskey()) {
    $filedata = manual::get_uploaded_data($draftitemid);
}

if (!$filedata) {
    $form = new \enrol_programs\local\form\source_manual_upload_file(null, ['program' => $program, 'source' => $source, 'context' => $context]);
} else {
    $form = new \enrol_programs\local\form\source_manual_upload_options(null, ['program' => $program,
        'source' => $source, 'context' => $context, 'csvfile' => $draftitemid, 'filedata' => $filedata]);
}

if ($form->is_cancelled()) {
    redirect($returnurl);
}

if ($data = $form->get_data()) {
    if ($filedata && $form instanceof \enrol_programs\local\form\source_manual_upload_options) {
        $result = manual::process_uploaded_data($data, $filedata);
        $string['source_manual_result_assigned'] = '{$a} users were assigned to program';
        $string['source_manual_result_errors'] = '{$a} errors detected when assigning program';
        $string['source_manual_result_skipped'] = '{$a} users were already assigned to program';

        if ($result['assigned']) {
            $message = get_string('source_manual_result_assigned', 'enrol_programs', $result['assigned']);
            \core\notification::add($message, \core\output\notification::NOTIFY_SUCCESS);
        }
        if ($result['skipped']) {
            $message = get_string('source_manual_result_skipped', 'enrol_programs', $result['skipped']);
            \core\notification::add($message, \core\output\notification::NOTIFY_INFO);
        }
        if ($result['errors']) {
            $message = get_string('source_manual_result_errors', 'enrol_programs', $result['errors']);
            \core\notification::add($message, \core\output\notification::NOTIFY_WARNING);
        }

        $form->redirect_submitted($returnurl);
    }
    if (!$filedata && $form instanceof \enrol_programs\local\form\source_manual_upload_file) {
        $filedata = manual::get_uploaded_data($draftitemid);
        if ($filedata) {
            $form = new \enrol_programs\local\form\source_manual_upload_options(null, ['program' => $program,
                'source' => $source, 'context' => $context, 'csvfile' => $draftitemid, 'filedata' => $filedata]);
        }
    }
}

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'users');

echo $OUTPUT->heading(get_string('source_manual_uploadusers', 'enrol_programs'), 3);

echo $form->render();

echo $OUTPUT->footer();
