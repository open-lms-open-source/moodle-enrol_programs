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

$programid = required_param('programid', PARAM_INT);
$type = required_param('type', PARAM_ALPHANUMEXT);

require_login();

$program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
$source = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => $type]);
$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:edit', $context);

$currenturl = new moodle_url('/enrol/programs/management/program_source_edit.php', ['id' => $program->id]);
$returnurl = new moodle_url('/enrol/programs/management/program_allocation.php', ['id' => $program->id]);

/** @var \enrol_programs\local\source\base[] $sourceclasses */
$sourceclasses = \enrol_programs\local\allocation::get_source_classes();
if (!isset($sourceclasses[$type])) {
    throw new coding_exception('Invalid source type');
}
$sourceclass = $sourceclasses[$type];

management::setup_program_page($currenturl, $context, $program);

if ($source) {
    if (!$sourceclass::is_update_allowed($program)) {
        redirect($returnurl);
    }
    $source->enable = 1;
    $source->hasallocations = $DB->record_exists('enrol_programs_allocations', ['sourceid' => $source->id]);
} else {
    if (!$sourceclass::is_new_allowed($program)) {
        redirect($returnurl);
    }
    $source = new stdClass();
    $source->id = null;
    $source->type = $type;
    $source->programid = $program->id;
    $source->enable = 0;
    $source->hasallocations = false;
}
$source = $sourceclass::decode_datajson($source);

$formclass = $sourceclass::get_edit_form_class();
$form = new $formclass(null, ['source' => $source, 'program' => $program, 'context' => $context]);

if ($form->is_cancelled()) {
    redirect($returnurl);
}

if ($data = $form->get_data()) {
    enrol_programs\local\source\base::update_source($data);
    $form->redirect_submitted($returnurl);
}

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'allocation');

echo $form->render();

echo $OUTPUT->footer();
