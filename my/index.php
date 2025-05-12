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
 * My programs.
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
/** @var stdClass $USER */

require('../../../config.php');

$sort = optional_param('sort', 'fullname', PARAM_ALPHANUMEXT);
$dir = optional_param('dir', 'ASC', PARAM_ALPHA);

require_login();

$usercontext = context_user::instance($USER->id);
$PAGE->set_context($usercontext);

if (!enrol_is_enabled('programs')) {
    redirect(new moodle_url('/'));
}
if (isguestuser()) {
    redirect(new moodle_url('/enrol/programs/catalogue/index.php'));
}

$pageparams = [];
if ($sort !== 'fullname') {
    $pageparams['sort'] = $sort;
}
if ($dir !== 'ASC') {
    $pageparams['dir'] = $dir;
}

$currenturl = new moodle_url('/enrol/programs/my/index.php', $pageparams);

$title = get_string('myprograms', 'enrol_programs');
$PAGE->navigation->extend_for_user($USER);
$PAGE->set_title($title);
$PAGE->set_url($currenturl);
$PAGE->set_pagelayout('report');
$PAGE->navbar->add(get_string('profile'), new moodle_url('/user/profile.php', ['id' => $USER->id]));
$PAGE->navbar->add($title);

$buttons = [];
$manageurl = \enrol_programs\local\management::get_management_url();
if ($manageurl) {
    $buttons[] = html_writer::link($manageurl, get_string('management', 'enrol_programs'), ['class' => 'btn btn-secondary']);
}
$catalogueurl = \enrol_programs\local\catalogue::get_catalogue_url();
if ($catalogueurl) {
    $buttons[] = html_writer::link($catalogueurl, get_string('catalogue', 'enrol_programs'), ['class' => 'btn btn-secondary']);
}
$buttons = implode('&nbsp;', $buttons);
$PAGE->set_button($buttons . $PAGE->button);

echo $OUTPUT->header();

/** @var \enrol_programs\output\my\renderer $myoutput */
$myoutput = $PAGE->get_renderer('enrol_programs', 'my');

echo $myoutput->render_my_programs_filters($sort, $dir);

$layoutconfig = get_config('enrol_programs', 'programslayout');
if ($layoutconfig == 'table') {
    echo $myoutput->render_my_programs_table_layout($sort, $dir);
} else {
    echo $myoutput->render_my_programs_grid_layout($sort, $dir);
}

echo $OUTPUT->footer();
