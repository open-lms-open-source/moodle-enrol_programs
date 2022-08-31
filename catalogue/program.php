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
 * Program browsing for learners.
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

require('../../../config.php');

$id = required_param('id', PARAM_INT);

$syscontext = context_system::instance();

$PAGE->set_url(new moodle_url('/enrol/programs/catalogue/program.php', ['id' => $id]));
$PAGE->set_context(context_system::instance());

require_login();
require_capability('enrol/programs:viewcatalogue', context_system::instance());

if (!enrol_is_enabled('programs')) {
    redirect(new moodle_url('/'));
}

$program = $DB->get_record('enrol_programs_programs', ['id' => $id]);
if (!$program || $program->archived) {
    if ($program) {
        $context = context::instance_by_id($program->contextid);
    } else {
        $context = context_system::instance();
    }
    if (has_capability('enrol/programs:view', $context)) {
        if ($program) {
            redirect(new moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]));
        } else {
            redirect(new moodle_url('/enrol/programs/management/index.php'));
        }
    } else {
        redirect(new moodle_url('/enrol/programs/catalogue/index.php'));
    }
}
$programcontext = context::instance_by_id($program->contextid);

$allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $USER->id]);
if ($allocation && !$allocation->archived) {
    redirect(new moodle_url('/enrol/programs/my/program.php', ['id' => $id]));
}

if (!\enrol_programs\local\catalogue::is_program_visible($program)) {
    if (has_capability('enrol/programs:view', $programcontext)) {
        redirect(new moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]));
    } else {
        redirect(new moodle_url('/enrol/programs/catalogue/index.php'));
    }
}

if (has_capability('enrol/programs:view', $programcontext)) {
    $manageurl = new moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);
    $button = html_writer::link($manageurl, get_string('management', 'enrol_programs'), ['class' => 'btn btn-secondary']);
    $PAGE->set_button($button . $PAGE->button);
}

/** @var \enrol_programs\output\catalogue\renderer $catalogueoutput */
$catalogueoutput = $PAGE->get_renderer('enrol_programs', 'catalogue');

$PAGE->set_heading(get_string('catalogue', 'enrol_programs'));
$PAGE->navigation->override_active_url(new moodle_url('/enrol/programs/catalogue/index.php'));
$PAGE->set_title(get_string('catalogue', 'enrol_programs'));
$PAGE->navbar->add(format_string($program->fullname));

echo $OUTPUT->header();

$event = \enrol_programs\event\catalogue_program_viewed::create_from_program($program);
$event->trigger();

echo $catalogueoutput->render_program($program);

echo $OUTPUT->footer();
