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

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$id = required_param('id', PARAM_INT);

require_login();

$allocation = $DB->get_record('enrol_programs_allocations', ['id' => $id], '*', MUST_EXIST);
$program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid], '*', MUST_EXIST);
$source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid], '*', MUST_EXIST);

$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:view', $context);

$user = $DB->get_record('user', ['id' => $allocation->userid], '*', MUST_EXIST);

$currenturl = new moodle_url('/enrol/programs/management/user_allocation.php', ['id' => $allocation->id]);

management::setup_program_page($currenturl, $context, $program);
$PAGE->set_docs_path("$CFG->wwwroot/enrol/programs/documentation.php/program_allocation.md");

/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'users');

// Refresh allocation data just in case.
allocation::fix_user_enrolments($program->id, $allocation->userid);
$allocation = $DB->get_record('enrol_programs_allocations', ['id' => $allocation->id], '*', MUST_EXIST);

echo $OUTPUT->heading($OUTPUT->user_picture($user) . fullname($user), 3);

echo $managementoutput->render_user_allocation($program, $allocation);
echo $managementoutput->render_user_progress($program, $allocation);
echo $managementoutput->render_user_notifications($program, $allocation);

echo $OUTPUT->footer();
