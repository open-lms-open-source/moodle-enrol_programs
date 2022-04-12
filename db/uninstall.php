<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Program enrolment uninstallation.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c] 2022 Open LMS (https://www.openlms.net/]
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_enrol_programs_uninstall() {
    global $CFG, $DB;

    $trans = $DB->start_delegated_transaction();

    $DB->delete_records('enrol_programs_usr_snapshots', []);
    $DB->delete_records('enrol_programs_prg_snapshots', []);
    $DB->delete_records('enrol_programs_evidences', []);
    $DB->delete_records('enrol_programs_completions', []);
    $DB->delete_records('enrol_programs_allocations', []);
    $DB->delete_records('enrol_programs_requests', []);
    $DB->delete_records('enrol_programs_sources', []);
    $DB->delete_records('enrol_programs_cohorts', []);
    $DB->delete_records('enrol_programs_prerequisites', []);
    $DB->delete_records('enrol_programs_items', []);

    $fs = get_file_storage();
    $contextids = $DB->get_fieldset_sql("SELECT DISTINCT contextid FROM {enrol_programs_programs}", []);
    foreach ($contextids as $contextid) {
        $context = context::instance_by_id($contextid, IGNORE_MISSING);
        if (!$context) {
            continue;
        }
        $fs->delete_area_files($context->id, 'enrol_programs');
    }

    core_tag_tag::delete_instances('enrol_programs');

    $DB->delete_records('enrol_programs_programs', []);

    $trans->allow_commit();

    $program = enrol_get_plugin('programs');
    $rs = $DB->get_recordset('enrol', ['enrol' => 'programs']);
    foreach ($rs as $instance) {
        $program->delete_instance($instance);
    }
    $rs->close();

    role_unassign_all(['component' => 'enrol_programs']);

    return true;
}
