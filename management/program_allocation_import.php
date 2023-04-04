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
 * Program import interface.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
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
$fromprogram = optional_param('fromprogram', 0, PARAM_INT);

require_login();

$targetprogram = $DB->get_record('enrol_programs_programs', ['id' => $id], '*', MUST_EXIST);
$context = context::instance_by_id($targetprogram->contextid);
require_capability('enrol/programs:edit', $context);
require_capability('enrol/programs:clone', $context);

$currenturl = new moodle_url('/enrol/programs/management/program_allocation_import.php', ['targetprogramid' => $targetprogram->id]);
management::setup_program_page($currenturl, $context, $targetprogram);

$returnurl = new moodle_url('/enrol/programs/management/program_allocation.php', ['targetprogramid' => $targetprogram->id]);

if ($targetprogram->archived) {
    redirect($returnurl);
}

$form = null;
if (!$fromprogram) {
    $form = new \enrol_programs\local\form\program_allocation_import(null, ['id' => $targetprogram->id,
        'contextid' => $context->id]);
    if ($form->is_cancelled()) {
        redirect($returnurl);
    } else if ($data = $form->get_data()) {
        $fromprogram = $data->fromprogram;
        unset($data);
        $form = null;
    }
}

if (!$form) {
    $form = new \enrol_programs\local\form\program_allocation_import_confirmation(null, ['context' => $context, 'fromprogram' => $fromprogram]);
    if ($form->is_cancelled()) {
        redirect($returnurl);
    } else if ($data = $form->get_data()) {
        program::import_program_dates($fromprogram, $id, $data);

        $sourceclasses = \enrol_programs\local\allocation::get_source_classes();
        foreach ($data as $key => $value) {
            if (strpos($key, 'importsource') === 0) {
                $sourcename = substr($key, strlen('importsource'));
                $source = $sourceclasses[$sourcename];
                $source::import_source_data($fromprogram, $id, $sourcename);
            }
        }
        $form->redirect_submitted($returnurl);
    }
}


/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($targetprogram->fullname));

echo $managementoutput->render_management_program_tabs($targetprogram, 'content');

echo $OUTPUT->heading(get_string('importprogramallocation', 'enrol_programs'), 3);

echo $form->render();

echo $OUTPUT->footer();
