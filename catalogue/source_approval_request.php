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
 * Request allocation to program.
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
/** @var stdClass $USER */

if (!empty($_SERVER['HTTP_X_LEGACY_DIALOG_FORM_REQUEST'])) {
    define('AJAX_SCRIPT', true);
}

require('../../../config.php');

$sourceid = required_param('sourceid', PARAM_INT);

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/enrol/programs/catalogue/source_approval_requests.php', ['sourceid' => $sourceid]));

require_login();
require_capability('enrol/programs:viewcatalogue', context_system::instance());

if (!enrol_is_enabled('programs')) {
    redirect(new moodle_url('/'));
}

$source = $DB->get_record('enrol_programs_sources', ['id' => $sourceid, 'type' => 'approval'], '*', MUST_EXIST);
$program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid], '*', MUST_EXIST);
$programcontext = context::instance_by_id($program->contextid);

$PAGE->set_heading(get_string('catalogue', 'enrol_programs'));
$PAGE->navigation->override_active_url(new moodle_url('/enrol/programs/catalogue/index.php'));
$PAGE->set_title(get_string('catalogue', 'enrol_programs'));
$PAGE->navbar->add(format_string($program->fullname));

if (!\enrol_programs\local\source\approval::can_user_request($program, $source, $USER->id)) {
    redirect(new moodle_url('/enrol/programs/catalogue/index.php'));
}

$returnurl = new moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);

$form = new enrol_programs\local\form\source_approval_request(null, ['source' => $source, 'program' => $program]);

if ($form->is_cancelled()) {
    redirect($returnurl);
}

if ($data = $form->get_data()) {
    enrol_programs\local\source\approval::request($program->id, $source->id);
    $form->redirect_submitted($returnurl);
}

/** @var \enrol_programs\output\catalogue\renderer $catalogueoutput */
$catalogueoutput = $PAGE->get_renderer('enrol_programs', 'catalogue');

echo $OUTPUT->header();

echo $catalogueoutput->render_program($program);

echo $form->render();

echo $OUTPUT->footer();
