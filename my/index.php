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
$syscontext = context_system::instance();

$sort = optional_param('sort', 'fullname', PARAM_ALPHANUMEXT);
$dir = optional_param('dir', 'ASC', PARAM_ALPHA);

$PAGE->set_context($syscontext);

require_login();

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

$PAGE->set_url($currenturl);
$PAGE->set_heading(get_string('myprograms', 'enrol_programs'));
$PAGE->set_title(get_string('myprograms', 'enrol_programs'));
$PAGE->navigation->override_active_url(new moodle_url('/enrol/programs/my/index.php'));
$PAGE->set_pagelayout('report');

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

if ($sort === 'idnumber') {
    $orderby = 'idnumber';
} else {
    $orderby = 'fullname';
}
if ($dir === 'ASC') {
    $orderby .= ' ASC';
} else {
    $orderby .= ' DESC';
}

$sql = "SELECT p.*
          FROM {enrol_programs_programs} p
          JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
         WHERE p.archived = 0 AND pa.archived = 0
               AND pa.userid = :userid
      ORDER BY $orderby";
$params = ['userid' => $USER->id];
$programs = $DB->get_records_sql($sql, $params);

if (!$programs) {
    echo get_string('errornomyprograms', 'enrol_programs');
    echo $OUTPUT->footer();
    die;
}

$data = [];

$programicon = $OUTPUT->pix_icon('program', '', 'enrol_programs');
$dateformat = get_string('strftimedatetimeshort');
$strnotset = get_string('notset', 'enrol_programs');

foreach ($programs as $program) {
    $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $USER->id]);
    $pcontext = context::instance_by_id($program->contextid);
    $row = [];
    $fullname = $programicon . format_string($program->fullname);
    $detailurl = new moodle_url('/enrol/programs/my/program.php', ['id' => $program->id]);
    $fullname = html_writer::link($detailurl, $fullname);
    if ($CFG->usetags) {
        $tags = core_tag_tag::get_item_tags('enrol_programs', 'program', $program->id);
        if ($tags) {
            $fullname .= '<br />' . $OUTPUT->tag_list($tags, '', 'program-tags');
        }
    }

    $row[] = $fullname;
    $row[] = s($program->idnumber);
    $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $pcontext->id, 'enrol_programs', 'description', $program->id);
    $row[] = format_text($description, $program->descriptionformat, ['context' => $pcontext]);

    $row[] = userdate($allocation->timestart, $dateformat);
    if ($allocation->timedue) {
        $row[] = userdate($allocation->timedue, $dateformat);
    } else {
        $row[] = $strnotset;
    }
    if ($allocation->timeend) {
        $row[] = userdate($allocation->timeend, $dateformat);
    } else {
        $row[] = $strnotset;
    }

    $row[] = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

    $data[] = $row;
}

$columns = [];

$column = get_string('programname', 'enrol_programs');
$columndir = ($dir === "ASC" ? "DESC" : "ASC");
$columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
$columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
    ['class' => 'iconsort']);
$changeurl = new moodle_url($currenturl);
$changeurl->param('sort', 'fullname');
$changeurl->param('dir', $columndir);
$column = html_writer::link($changeurl, $column);
if ($sort === 'fullname') {
    $column .= $columnicon;
}
$columns[] = $column;

$column = get_string('idnumber');
$columndir = ($dir === "ASC" ? "DESC" : "ASC");
$columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
$columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
    ['class' => 'iconsort']);
$changeurl = new moodle_url($currenturl);
$changeurl->param('sort', 'idnumber');
$changeurl->param('dir', $columndir);
$column = html_writer::link($changeurl, $column);
if ($sort === 'idnumber') {
    $column .= $columnicon;
}
$columns[] = $column;

$columns[] = get_string('description');

$column = get_string('programstart', 'enrol_programs');
$columndir = ($dir === "ASC" ? "DESC" : "ASC");
$columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
$columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
    ['class' => 'iconsort']);
$changeurl = new moodle_url($currenturl);
$changeurl->param('sort', 'start');
$changeurl->param('dir', $columndir);
$column = html_writer::link($changeurl, $column);
if ($sort === 'start') {
    $column .= $columnicon;
}
$columns[] = $column;

$column = get_string('duedate', 'enrol_programs');
$columndir = ($dir === "ASC" ? "DESC" : "ASC");
$columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
$columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
    ['class' => 'iconsort']);
$changeurl = new moodle_url($currenturl);
$changeurl->param('sort', 'due');
$changeurl->param('dir', $columndir);
$column = html_writer::link($changeurl, $column);
if ($sort === 'due') {
    $column .= $columnicon;
}
$columns[] = $column;

$column = get_string('programend', 'enrol_programs');
$columndir = ($dir === "ASC" ? "DESC" : "ASC");
$columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
$columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
    ['class' => 'iconsort']);
$changeurl = new moodle_url($currenturl);
$changeurl->param('sort', 'end');
$changeurl->param('dir', $columndir);
$column = html_writer::link($changeurl, $column);
if ($sort === 'end') {
    $column .= $columnicon;
}
$columns[] = $column;

$columns[] = get_string('programstatus', 'enrol_programs');

$table = new html_table();
$table->head = $columns;
$table->id = 'my_programs';
$table->attributes['class'] = 'generaltable';
$table->data = $data;
echo html_writer::table($table);

echo $OUTPUT->footer();
