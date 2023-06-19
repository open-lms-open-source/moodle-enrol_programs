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
use enrol_programs\local\allocation;

if (!empty($_SERVER['HTTP_X_LEGACY_DIALOG_FORM_REQUEST'])) {
    define('AJAX_SCRIPT', true);
}

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$allocationid = required_param('allocationid', PARAM_INT);
$itemid = required_param('itemid', PARAM_INT);

require_login();

$allocation = $DB->get_record('enrol_programs_allocations', ['id' => $allocationid], '*', MUST_EXIST);
$item = $DB->get_record('enrol_programs_items', ['id' => $itemid, 'programid' => $allocation->programid], '*', MUST_EXIST);
$completion = $DB->get_record('enrol_programs_completions', ['allocationid' => $allocation->id, 'itemid' => $item->id]);
$evidence = $DB->get_record('enrol_programs_evidences', ['userid' => $allocation->userid, 'itemid' => $item->id]);

$user = $DB->get_record('user', ['id' => $allocation->userid, 'deleted' => 0], '*', MUST_EXIST);
$program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid], '*', MUST_EXIST);

$context = context::instance_by_id($program->contextid);
if (!has_capability('enrol/programs:admin', $context)) {
    require_capability('enrol/programs:manageevidence', $context);
}

$returnurl = new moodle_url('/enrol/programs/management/user_allocation.php', ['id' => $allocation->id]);

$currenturl = new moodle_url('/enrol/programs/management/user_completion_edit.php', ['allocationid' => $allocation->id, 'itemid' => $item->id]);

management::setup_program_page($currenturl, $context, $program);

$form = new \enrol_programs\local\form\user_completion_edit(null, [
    'allocation' => $allocation, 'item' => $item, 'user' => $user,
    'completion' => $completion, 'evidence' => $evidence, 'context' => $context,
]);

if ($form->is_cancelled()) {
    redirect($returnurl);
}

if ($data = $form->get_data()) {
    allocation::update_item_completion($data);
    $form->redirect_submitted($returnurl);
}

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'users');

echo $OUTPUT->heading(fullname($user), 3);
echo $OUTPUT->heading(get_string('itemcompletion', 'enrol_programs'), 4);

echo $form->render();

echo $OUTPUT->footer();
