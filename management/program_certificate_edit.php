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
 * Program management interface - certificate editing.
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

if (!\enrol_programs\local\certificate::is_available()) {
    redirect(new moodle_url('/enrol/programs/program.php', ['id' => $program->id]));
}

$currenturl = new moodle_url('/enrol/programs/management/program_certificate_edit.php', ['id' => $id]);

management::setup_program_page($currenturl, $context, $program);

$cert = $DB->get_record('enrol_programs_certs', ['programid' => $program->id]);

$current = new stdClass();
$current->id = $program->id;

if ($cert) {
    $current->templateid = $cert->templateid;
    $current->expirydatetype = $cert->expirydatetype;
    if ($cert->expirydatetype == 1) {
        $current->expirydateabsolute = $cert->expirydateoffset;
        $current->expirydaterelative = null;
    } else if ($cert->expirydatetype == 2) {
        $current->expirydateabsolute = null;
        $current->expirydaterelative = $cert->expirydateoffset;
    } else {
        $current->expirydatetype = 0;
        $current->expirydaterelative = null;
        $current->expirydateabsolute = null;
    }
    $current->existing = true;
} else {
    $current->templateid = null;
    $current->expirydatetype = 0;
    $current->expirydaterelative = null;
    $current->expirydateabsolute = null;
    $current->existing = false;
}

$form = new \enrol_programs\local\form\program_certificate_edit(null, ['data' => $current, 'context' => $context]);

$returnurl = new moodle_url('/enrol/programs/management/program_certificate.php', ['id' => $program->id]);

if ($form->is_cancelled()) {
    redirect($returnurl);
}

if ($data = $form->get_data()) {
    \enrol_programs\local\certificate::update_program_certificate((array)$data);
    $form->redirect_submitted($returnurl);
}

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($program->fullname));

echo $managementoutput->render_management_program_tabs($program, 'certificate');

echo $form->render();

echo $OUTPUT->footer();