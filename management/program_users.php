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
use enrol_programs\local\util;

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$id = required_param('id', PARAM_INT);
$page = optional_param('page', 0, PARAM_INT);
$searchquery = optional_param('search', '', PARAM_RAW);
$sort = optional_param('sort', 'name', PARAM_ALPHANUMEXT);
$dir = optional_param('dir', 'ASC', PARAM_ALPHA);
$status = optional_param('status', 0, PARAM_INT);
$perpage = 25;

require_login();

$program = $DB->get_record('enrol_programs_programs', ['id' => $id], '*', MUST_EXIST);
$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:view', $context);

$pageparams = ['id' => $program->id];
if (trim($searchquery) !== '') {
    $pageparams['search'] = $searchquery;
}
if ($page) {
    $pageparams['page'] = $page;
}
if ($sort !== 'name') {
    $pageparams['sort'] = $sort;
}
if ($dir !== 'ASC') {
    $pageparams['dir'] = $dir;
}
if ($status) {
    $pageparams['status'] = $status;
}
$currenturl = new moodle_url('/enrol/programs/management/program_users.php', $pageparams);

management::setup_program_page($currenturl, $context, $program);
$PAGE->set_docs_path("$CFG->wwwroot/enrol/programs/documentation.php/program_allocation.md");

/** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
$dialogformoutput = $PAGE->get_renderer('local_openlms', 'dialog_form');
/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');
/** @var \enrol_programs\output\catalogue\renderer $catalogueoutput */
$catalogueoutput = $PAGE->get_renderer('enrol_programs', 'catalogue');

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'users');

echo '<div class="allocation-filtering">';
// Add search form.
$data = [
    'action' => new moodle_url('/enrol/programs/management/program_users.php'),
    'inputname' => 'search',
    'searchstring' => get_string('search', 'search'),
    'query' => $searchquery,
    'hiddenfields' => [
        (object)['name' => 'id', 'value' => $program->id],
        (object)['name' => 'sort', 'value' => $sort],
        (object)['name' => 'dir', 'value' => $dir],
        (object)['name' => 'status', 'value' => $status],
    ],
    'extraclasses' => 'mb-3'
];
echo $OUTPUT->render_from_template('core/search_input', $data);
$changestatus = new moodle_url($currenturl);
$statusoptions = [
    0 => get_string('programstatus_any', 'enrol_programs'),
    1 => get_string('programstatus_completed', 'enrol_programs'),
    2 => get_string('programstatus_future', 'enrol_programs'),
    3 => get_string('programstatus_failed', 'enrol_programs'),
    4 => get_string('programstatus_overdue', 'enrol_programs'),
    5 => get_string('programstatus_open', 'enrol_programs'),
];
if (!isset($statusoptions[$status])) {
    $status = 0;
}
echo $OUTPUT->single_select($currenturl, 'status', $statusoptions, $status, []);
echo '</div>';
echo '<div class="clearfix"></div>';

$allusernamefields = \core_user\fields::get_name_fields(true);
$userfieldsapi = \core_user\fields::for_identity(\context_system::instance(), false)->with_userpic();
$userfieldssql = $userfieldsapi->get_sql('u', false, 'user', 'userid2', false);
$userfields = $userfieldssql->selects;
$params = $userfieldssql->params;

$orderby = '';
if ($dir === 'ASC') {
    $orderby = ' ASC';
} else {
    $orderby = ' DESC';
}
if ($sort === 'start') {
    $orderby = 'timestart' . $orderby;
} else if ($sort === 'end') {
    $orderby = 'timeend' . $orderby;
} else if ($sort === 'due') {
    $orderby = 'timedue' . $orderby;
} else if ($sort === 'firstname') {
    $orderby = 'firstname' . $orderby . ',  lastname' . $orderby;
} else if ($sort === 'lastname') {
    $orderby = 'lastname' . $orderby . ',  firstname' . $orderby;
} else {
    // Use first name, last name for now.
    $orderby = $allusernamefields[0] . $orderby . ', ' . $allusernamefields[0] . $orderby;
}

$usersearch = '';
if (trim($searchquery) !== '') {
    $searchparam = '%' . $DB->sql_like_escape($searchquery) . '%';
    $conditions = [];
    $fields = ['email', 'idnumber'] + $allusernamefields;
    $cnt = 0;
    foreach ($fields as $field) {
        $conditions[] = $DB->sql_like('u.' . $field, ':usersearch' . $cnt, false);
        $params['usersearch' . $cnt] = $searchparam;
        $cnt++;
    }
    // Let them search for full name too.
    $conditions[] = $DB->sql_like($DB->sql_concat_join("' '", ['u.firstname', 'u.lastname']), ':usersearch' . $cnt, false);
    $params['usersearch' . $cnt] = $searchparam;
    $cnt++;
    $conditions[] = $DB->sql_like($DB->sql_concat_join("' '", ['u.lastname', 'u.firstname']), ':usersearch' . $cnt, false);
    $params['usersearch' . $cnt] = $searchparam;
    $cnt++;
    $usersearch = 'AND (' . implode(' OR ', $conditions) . ')';
}

switch ($status) {
    case 1: // Completed.
        $statusselect = 'AND a.timecompleted IS NOT NULL';
        break;
    case 2: // Future.
        $params['now'] = time();
        $statusselect = 'AND a.timecompleted IS NULL AND a.timestart > :now';
        break;
    case 3: // Failed.
        $params['now'] = time();
        $statusselect = 'AND a.timecompleted IS NULL AND a.timeend < :now';
        break;
    case 4: // Overddue.
        $params['now1'] = time();
        $params['now2'] = time();
        $statusselect = 'AND a.timecompleted IS NULL AND (a.timeend > :now1 OR a.timeend IS NULL) AND a.timedue < :now2';
        break;
    case 5: // Open.
        $params['now1'] = time();
        $params['now2'] = time();
        $params['now3'] = time();
        $statusselect = 'AND a.timecompleted IS NULL AND a.timestart < :now1 AND (a.timeend > :now2 OR a.timeend IS NULL) AND (a.timedue > :now3 OR a.timedue IS NULL)';
        break;
    default:
        $statusselect = '';
}

$sql = "SELECT a.*, s.type AS sourcetype, $userfields
          FROM {enrol_programs_allocations} a
     LEFT JOIN {enrol_programs_sources} s ON s.id = a.sourceid
          JOIN {user} u ON u.id = a.userid
         WHERE a.programid = :programid $usersearch $statusselect
      ORDER BY $orderby";
$params['programid'] = $program->id;
$allocations = $DB->get_records_sql($sql, $params, $page * $perpage, $perpage);

$sql = "SELECT COUNT(a.id)
          FROM {enrol_programs_allocations} a
     LEFT JOIN {enrol_programs_sources} s ON s.id = a.sourceid
          JOIN {user} u ON u.id = a.userid
         WHERE a.programid = :programid $usersearch";
$totalcount = $DB->count_records_sql($sql, $params);

echo $OUTPUT->paging_bar($totalcount, $page, $perpage, $currenturl);

$sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id]);
$sourcenames = \enrol_programs\local\allocation::get_source_names();
/** @var \enrol_programs\local\source\base[] $sourceclasses */ // Type hack.
$sourceclasses = \enrol_programs\local\allocation::get_source_classes();
$dateformat = get_string('strftimedatetimeshort');

$data = [];
foreach ($allocations as $allocation) {
    $row = [];
    $source = $sources[$allocation->sourceid];
    $sourceclass = $sourceclasses[$allocation->sourcetype];

    $user = (object)['id' => $allocation->userid];
    username_load_fields_from_object($user, $allocation, 'user', $userfieldsapi::for_userpic()->get_required_fields());
    $userurl = new moodle_url('/enrol/programs/management/user_allocation.php', ['id' => $allocation->id]);
    $fullnametext = fullname($user);
    $userpicture = $OUTPUT->user_picture($user, ['alttext' => $fullnametext]);
    $fullname = html_writer::link($userurl, $fullnametext);
    $row[] = $userpicture . $fullname;

    $row[] = userdate($allocation->timestart, $dateformat);
    if ($allocation->timedue) {
        $row[] = userdate($allocation->timedue, $dateformat);
    } else {
        $row[] = '';
    }
    if ($allocation->timeend) {
        $row[] = userdate($allocation->timeend, $dateformat);
    } else {
        $row[] = '';
    }

    $row[] = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

    $cell = $sourcenames[$allocation->sourcetype];
    $actions = [];
    if (has_capability('enrol/programs:admin', $context)) {
        if ($sourceclass::allocation_edit_supported($program, $source, $allocation)) {
            $editformurl = new moodle_url('/enrol/programs/management/user_allocation_edit.php', ['id' => $allocation->id]);
            $editaction = new \local_openlms\output\dialog_form\icon($editformurl, 'i/settings', get_string('updateallocation', 'enrol_programs'));
            $actions[] = $dialogformoutput->render($editaction);
        }
    }
    if (has_capability('enrol/programs:allocate', $context)) {
        if ($sourceclass::allocation_delete_supported($program, $source, $allocation)) {
            $deleteformurl = new moodle_url('/enrol/programs/management/user_allocation_delete.php', ['id' => $allocation->id]);
            $deleteaction = new \local_openlms\output\dialog_form\icon($deleteformurl, 'i/delete', get_string('deleteallocation', 'enrol_programs'));
            $actions[] = $dialogformoutput->render($deleteaction);
        }
    }
    if ($actions) {
        $cell .= ' ' . implode('', $actions);
    }
    $row[] = $cell;

    $data[] = $row;
}

if (!$totalcount) {
    echo get_string('errornoallocations', 'enrol_programs');

} else {
    $columns = [];

    $firstname = get_string('firstname');
    $columndir = ($dir === "ASC" ? "DESC" : "ASC");
    $columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
    $columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
        ['class' => 'iconsort']);
    $changeurl = new moodle_url($currenturl);
    $changeurl->param('sort', 'firstname');
    $changeurl->param('dir', $columndir);
    $firstname = html_writer::link($changeurl, $firstname);
    $lastname = get_string('lastname');
    $changeurl = new moodle_url($currenturl);
    $changeurl->param('sort', 'lastname');
    $changeurl->param('dir', $columndir);
    $lastname = html_writer::link($changeurl, $lastname);
    if ($sort === 'firstname') {
        $firstname .= $columnicon;
    } else if ($sort === 'lastname') {
        $lastname .= $columnicon;
    }
    $columns[] = $firstname . ' / ' . $lastname;

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
    $columns[] = get_string('source', 'enrol_programs');

    $table = new html_table();
    $table->head = $columns;
    $table->id = 'program_allocations';
    $table->attributes['class'] = 'admintable generaltable';
    $table->data = $data;
    echo html_writer::table($table);
}

echo $OUTPUT->paging_bar($totalcount, $page, $perpage, $currenturl);

$buttons = [];

foreach ($sourceclasses as $sourceclass) {
    $sourcetype = $sourceclass::get_type();
    $sourcerecord = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => $sourcetype]);
    if (!$sourcerecord) {
        continue;
    }
    $buttons = array_merge_recursive($buttons,  $sourceclass::get_management_program_users_buttons($program, $sourcerecord));
}

if ($buttons) {
    $buttons = implode(' ', $buttons);
    echo $OUTPUT->box($buttons, 'buttons');
}

echo $OUTPUT->footer();
