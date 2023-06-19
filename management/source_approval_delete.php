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

if (!empty($_SERVER['HTTP_X_LEGACY_DIALOG_FORM_REQUEST'])) {
    define('AJAX_SCRIPT', true);
}

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$id = required_param('id', PARAM_INT);

require_login();

$request = $DB->get_record('enrol_programs_requests', ['id' => $id], '*', MUST_EXIST);
$user = $DB->get_record('user', ['id' => $request->userid], '*', MUST_EXIST);
$source = $DB->get_record('enrol_programs_sources', ['id' => $request->sourceid], '*', MUST_EXIST);
$program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid], '*', MUST_EXIST);
$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:allocate', $context);

$currenturl = new moodle_url('/enrol/programs/management/source_approval_delete.php', ['id' => $id]);

management::setup_program_page($currenturl, $context, $program);

$returnurl = new moodle_url('/enrol/programs/management/source_approval_requests.php', ['id' => $program->id]);

$form = new \enrol_programs\local\form\source_approval_delete(null, ['request' => $request, 'user' => $user, 'program' => $program, 'context' => $context]);

if ($form->is_cancelled()) {
    redirect($returnurl);
}

if ($data = $form->get_data()) {
    enrol_programs\local\source\approval::delete_request($request->id);
    $form->redirect_submitted($returnurl);
}

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'requests');

echo $form->render();

echo $OUTPUT->footer();
