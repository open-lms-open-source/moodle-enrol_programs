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
 * Program management interface - certificate awarding.
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

require('../../../config.php');
require_once($CFG->dirroot . '/lib/formslib.php');

$id = required_param('id', PARAM_INT);

require_login();

$program = $DB->get_record('enrol_programs_programs', ['id' => $id], '*', MUST_EXIST);
$context = context::instance_by_id($program->contextid);
require_capability('enrol/programs:view', $context);

if (!\enrol_programs\local\certificate::is_available()) {
    redirect(new moodle_url('/enrol/programs/program.php', ['id' => $program->id]));
}

$currenturl = new moodle_url('/enrol/programs/management/program_certificate.php', ['id' => $id]);

management::setup_program_page($currenturl, $context, $program);

/** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
$dialogformoutput = $PAGE->get_renderer('local_openlms', 'dialog_form');
/** @var \enrol_programs\output\management\renderer $managementoutput */
$managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

$cert = $DB->get_record('enrol_programs_certs', ['programid' => $program->id]);

echo $OUTPUT->header();

echo $managementoutput->render_management_program_tabs($program, 'certificate');

$buttons = [];
if (has_capability('enrol/programs:edit', $context)) {
    $editurl = new moodle_url('/enrol/programs/management/program_certificate_edit.php', ['id' => $program->id]);
    $editbutton = new local_openlms\output\dialog_form\button($editurl, get_string('edit'));
    $editbutton->set_dialog_name(get_string('certificate', 'tool_certificate'));
    $buttons[] = $dialogformoutput->render($editbutton);

    if ($cert) {
        $deleteurl = new moodle_url('/enrol/programs/management/program_certificate_delete.php', ['id' => $program->id]);
        $deletebutton = new local_openlms\output\dialog_form\button($deleteurl, get_string('delete'));
        $deletebutton->set_dialog_name(get_string('certificate', 'tool_certificate'));
        $buttons[] = $dialogformoutput->render($deletebutton);
    }
}

$cert = $DB->get_record('enrol_programs_certs', ['programid' => $program->id]);

if ($cert) {
    echo '<dl class="row">';
    echo '<dt class="col-3">' . get_string('certificatetemplate', 'tool_certificate') . ':</dt><dd class="col-9">';
    $template = $DB->get_record('tool_certificate_templates', ['id' => $cert->templateid]);
    if (!$template) {
        echo get_string('error');
        echo '</dd>';
        echo '</dl>';
    } else {
        echo format_string($template->name);
        echo '</dd>';

        echo '<dt class="col-3">' . get_string('expirydate', 'tool_certificate') . ':</dt><dd class="col-9">';
        if ($cert->expirydatetype == 1) {
            echo userdate($cert->expirydateoffset);
        } else if ($cert->expirydatetype == 2) {
            echo format_time($cert->expirydateoffset);
        } else {
            echo get_string('never', 'tool_certificate');
        }
        echo '</dd>';

        echo '</dl>';
    }
} else {
    echo '<dl class="row">';
    echo '<dt class="col-3">' . get_string('certificatetemplate', 'tool_certificate') . ':</dt><dd class="col-9">';
    echo get_string('notset', 'enrol_programs');
    echo '</dd>';
    echo '</dl>';
}

if ($buttons) {
    $buttons = implode(' ', $buttons);
    echo $OUTPUT->box($buttons, 'buttons');
}

echo $OUTPUT->footer();
