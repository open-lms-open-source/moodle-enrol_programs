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

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$catalogue = new \enrol_programs\local\catalogue($_REQUEST);
$syscontext = context_system::instance();

$PAGE->set_url($catalogue->get_current_url());
$PAGE->set_context($syscontext);

require_login();
require_capability('enrol/programs:viewcatalogue', $syscontext);

if (!enrol_is_enabled('programs')) {
    redirect(new moodle_url('/'));
}

$buttons = [];
$manageurl = \enrol_programs\local\management::get_management_url();
if ($manageurl) {
    $buttons[] = html_writer::link($manageurl, get_string('management', 'enrol_programs'), ['class' => 'btn btn-secondary']);
}
if (!isguestuser()) {
    $myprogramsurl = new moodle_url('/enrol/programs/my/index.php');
    $buttons[] = html_writer::link($myprogramsurl, get_string('myprograms', 'enrol_programs'), ['class' => 'btn btn-secondary']);
}
$buttons = implode('&nbsp;', $buttons);
$PAGE->set_button($buttons . $PAGE->button);

$PAGE->set_heading(get_string('catalogue', 'enrol_programs'));
$PAGE->set_title(get_string('catalogue', 'enrol_programs'));
$PAGE->set_pagelayout('report');

echo $OUTPUT->header();

echo $catalogue->render_programs();

echo $OUTPUT->footer();
