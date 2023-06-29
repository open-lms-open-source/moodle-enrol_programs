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
 * Migrate program notifications to local_openlms.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
function enrol_programs_migrate_notifications() {
    global $DB;
    $dbman = $DB->get_manager();

    $mappings = [
        'allocation' => ['notifyallocation', 'timenotifiedallocation'],
        'start' => ['notifystart', 'timenotifiedstart'],
        'completion' => ['notifycompleted', 'timenotifiedcompleted'],
        'duesoon' => ['notifyduesoon', 'timenotifiedduesoon'],
        'due' => ['notifydue', 'timenotifieddue'],
        'endsoon' => ['notifyendsoon', 'timenotifiedendsoon'],
        'endcompleted' => ['notifyendcompleted', 'timenotifiedendcompleted'],
        'endfailed' => ['notifyendfailed', 'timenotifiedendfailed'],
        'deallocation' => ['notifydeallocation', 'timenotifieddeallocation'],
    ];

    $programs = $DB->get_recordset('enrol_programs_programs', [], 'id ASC');
    foreach ($programs as $program) {
        foreach ($mappings as $notificationtype => $info) {
            list($programfield, $allocationfield) = $info;
            if ($notificationtype === 'allocation') {
                if (!$DB->record_exists('enrol_programs_sources', ['programid' => $program->id, 'notifyallocation' => 1])) {
                    continue;
                }
            } else {
                if (empty($program->$programfield)) {
                    continue;
                }
            }
            $data = [
                'component' => 'enrol_programs',
                'notificationtype' => $notificationtype,
                'instanceid' => $program->id,
            ];
            if ($DB->record_exists('local_openlms_notifications', $data)) {
                continue;
            }
            $data['enabled'] = '1';
            \local_openlms\notification\util::notification_create($data);
        }
    }
    $programs->close();

    $sql = "SELECT pa.*
              FROM {enrol_programs_allocations} pa
              JOIN {enrol_programs_programs} p ON p.id = pa.programid
             WHERE EXISTS (SELECT n.id
                             FROM {local_openlms_notifications} n
                            WHERE n.component = 'enrol_programs' AND n.instanceid = p.id)
         ORDER BY pa.id";
    $allocations = $DB->get_recordset_sql($sql);
    foreach ($allocations as $allocation) {
        $records = $DB->get_records('local_openlms_notifications', [
            'component' => 'enrol_programs',
            'instanceid' => $allocation->programid,
        ], '', '*');
        $notifications = [];
        foreach($records as $record) {
            $notifications[$record->notificationtype] = $record;
        }
        foreach ($mappings as $notificationtype => $info) {
            if (!isset($notifications[$notificationtype])) {
                continue;
            }
            list($programfield, $allocationfield) = $info;
            if (!empty($allocation->$allocationfield)) {
                $notification = $notifications[$notificationtype];
                $data = [
                    'notificationid' => $notification->id,
                    'userid' => $allocation->userid,
                    'otherid1' => $allocation->id,
                ] ;
                if ($DB->record_exists('local_openlms_user_notified', $data)) {
                    continue;
                }
                $data['timenotified'] = $allocation->$allocationfield;
                $DB->insert_record('local_openlms_user_notified', $data);
            }
        }
    }
    $allocations->close();

    foreach ($mappings as $notificationtype => $info) {
        list($programfield, $allocationfield) = $info;
        $table = new xmldb_table('enrol_programs_allocations');
        if ($dbman->field_exists($table, $allocationfield)) {
            $dbman->drop_field($table, new xmldb_field($allocationfield));
        }
        if ($notificationtype === 'allocation') {
            $table = new xmldb_table('enrol_programs_sources');
            if ($dbman->field_exists($table, 'notifyallocation')) {
                $dbman->drop_field($table, new xmldb_field('notifyallocation'));
            }
        } else {
            $table = new xmldb_table('enrol_programs_programs');
            if ($dbman->field_exists($table, $programfield)) {
                $dbman->drop_field($table, new xmldb_field($programfield));
            }
        }
    }
}