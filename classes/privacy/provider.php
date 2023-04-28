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

namespace enrol_programs\privacy;

use context_user;
use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\approved_userlist;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\userlist;
use core_privacy\local\request\writer;

/**
 * Programs privacy info.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
        // Transactions store user data.
        \core_privacy\local\metadata\provider,

        // The programs plugin has user allocations.
        \core_privacy\local\request\plugin\provider,

        // This plugin is capable of determining which users have data within it.
        \core_privacy\local\request\core_userlist_provider {

    /**
     * Returns meta data about this system.
     *
     * @param collection $collection The initialised collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection->add_database_table(
                'enrol_programs_allocations',
                [
                    'programid' => 'privacy:metadata:field:programid',
                    'userid' => 'privacy:metadata:field:userid',
                    'sourceid' => 'privacy:metadata:field:sourceid',
                    'archived' => 'privacy:metadata:field:archived',
                    'sourcedatajson' => 'privacy:metadata:field:sourcedatajson',
                    'timeallocated' => 'privacy:metadata:field:timeallocated',
                    'timestart' => 'privacy:metadata:field:timestart',
                    'timedue' => 'privacy:metadata:field:timedue',
                    'timeend' => 'privacy:metadata:field:timeend',
                    'timecompleted' => 'privacy:metadata:field:timecompleted',
                    'timecreated' => 'privacy:metadata:field:timecreated',
                ],
                'privacy:metadata:table:enrol_programs_allocations'
        );

        $collection->add_database_table(
            'enrol_programs_certs_issues',
            [
                'programid' => 'privacy:metadata:field:programid',
                'allocationid' => 'privacy:metadata:field:allocationid',
                'timecompleted' => 'privacy:metadata:field:timecompleted',
                'issueid' => 'privacy:metadata:field:issueid',
                'timecreated' => 'privacy:metadata:field:timecreated',
            ],
            'privacy:metadata:table:enrol_programs_certs_issues'
        );

        $collection->add_database_table(
            'enrol_programs_completions',
            [
                'itemid' => 'privacy:metadata:field:itemid',
                'allocationid' => 'privacy:metadata:field:allocationid',
                'timecompleted' => 'privacy:metadata:field:timecompleted',
            ],
            'privacy:metadata:table:enrol_programs_completions'
        );

        $collection->add_database_table(
            'enrol_programs_evidences',
            [
                'itemid' => 'privacy:metadata:field:itemid',
                'userid' => 'privacy:metadata:field:userid',
                'evidencejson' => 'privacy:metadata:field:evidencejson',
                'timecompleted' => 'privacy:metadata:field:timecompleted',
                'timecreated' => 'privacy:metadata:field:timecreated',
                'createdby' => 'privacy:metadata:field:createdby',
            ],
            'privacy:metadata:table:enrol_programs_evidences'
        );

        $collection->add_database_table(
            'enrol_programs_requests',
            [
                'sourceid' => 'privacy:metadata:field:sourceid',
                'userid' => 'privacy:metadata:field:userid',
                'datajson' => 'privacy:metadata:field:datajson',
                'timerequested' => 'privacy:metadata:field:timerequested',
                'timerejected' => 'privacy:metadata:field:timerejected',
                'rejectedby' => 'privacy:metadata:field:rejectedby',
            ],
            'privacy:metadata:table:enrol_programs_requests'
        );

        $collection->add_database_table(
            'enrol_programs_usr_snapshots',
            [
                'allocationid' => 'privacy:metadata:field:allocationid',
                'reason' => 'privacy:metadata:field:reason',
                'timesnapshot' => 'privacy:metadata:field:timesnapshot',
                'snapshotby' => 'privacy:metadata:field:snapshotby',
                'explanation' => 'privacy:metadata:field:explanation',
                'programid' => 'privacy:metadata:field:programid',
                'userid' => 'privacy:metadata:field:userid',
                'sourceid' => 'privacy:metadata:field:sourceid',
                'archived' => 'privacy:metadata:field:archived',
                'sourcedatajson' => 'privacy:metadata:field:sourcedatajson',
                'timeallocated' => 'privacy:metadata:field:timeallocated',
                'timestart' => 'privacy:metadata:field:timestart',
                'timedue' => 'privacy:metadata:field:timedue',
                'timeend' => 'privacy:metadata:field:timeend',
                'timecompleted' => 'privacy:metadata:field:timecompleted',
                'completionsjson' => 'privacy:metadata:field:completionsjson',
                'evidencesjson' => 'privacy:metadata:field:evidencesjson',
                            ],
            'privacy:metadata:table:enrol_programs_usr_snapshots'
        );

        return $collection;
    }

    /**
     * Get the list of contexts that contain user information for the specified user.
     *
     * @param int $userid The user to search.
     * @return contextlist The contextlist containing the list of contexts used in this plugin.
     */
    public static function get_contexts_for_userid(int $userid) : contextlist {
        $sql = "SELECT ctx.id
                  FROM {enrol_programs_programs} p
                  JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                  JOIN {context} ctx ON p.contextid = ctx.id
                  JOIN {user} u ON u.id = pa.userid AND u.deleted = 0
                 WHERE u.id = :userid";
        $params = ['userid' => $userid];

        $contextlist = new contextlist();
        $contextlist->add_from_sql($sql, $params);

        return $contextlist;
    }

    /**
     * Get the list of users who have data within a context.
     *
     * @param userlist $userlist The userlist containing the list of users who have data in this context/plugin combination.
     */
    public static function get_users_in_context(userlist $userlist) {
        $context = $userlist->get_context();

        $sql = "SELECT u.id
                  FROM {enrol_programs_programs} p
                  JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                  JOIN {context} ctx ON p.contextid = ctx.id
                  JOIN {user} u ON u.id = pa.userid AND u.deleted = 0
                 WHERE ctx.id = :contextid";
        $params = ['contextid' => $context->id];

        $userlist->add_from_sql('id', $sql, $params);
    }

    /**
     * Export all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist The approved contexts to export information for.
     */
    public static function export_user_data(approved_contextlist $contextlist) {
        global $DB;

        if (empty($contextlist->count())) {
            return;
        }

        $user = $contextlist->get_user();

        list($contextsql, $contextparams) = $DB->get_in_or_equal($contextlist->get_contextids(), SQL_PARAMS_NAMED);

        $sql = "SELECT p.contextid, p.fullname, pa.id, pa.programid, pa.userid,
                    pa.sourceid, pa.archived, pa.sourcedatajson, pa.timeallocated, pa.timestart, pa.timedue, pa.timeend,
                    pa.timecompleted, pa.timecreated,
                    pci.timecompleted AS certificateissuetimecompleted, pci.issueid AS certificateissueid, pci.timecreated AS certificateissuetimecreated
                  FROM {enrol_programs_programs} p
                  JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                  LEFT JOIN {enrol_programs_certs_issues} pci ON pa.id = pci.allocationid
                  JOIN {context} ctx ON p.contextid = ctx.id
                  JOIN {user} u ON u.id = pa.userid AND u.deleted = 0
                 WHERE ctx.id {$contextsql} AND u.id = :userid
              ORDER BY pa.id ASC";
        $params = ['userid' => $user->id];
        $params += $contextparams;

        $strallocation = get_string('programallocations', 'enrol_programs');
        $strprogramrequests = get_string('source_approval_requests', 'enrol_programs');

        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $allocation) {
            // Format dates.
            $allocation->timeallocated = \core_privacy\local\request\transform::datetime($allocation->timeallocated);
            $allocation->timestart = \core_privacy\local\request\transform::datetime($allocation->timestart);
            $allocation->timedue = \core_privacy\local\request\transform::datetime($allocation->timedue);
            $allocation->timeend = \core_privacy\local\request\transform::datetime($allocation->timeend);
            $allocation->timecompleted = \core_privacy\local\request\transform::datetime($allocation->timecompleted);
            $allocation->timecreated = \core_privacy\local\request\transform::datetime($allocation->timecreated);
            $allocation->certificateissuetimecompleted = \core_privacy\local\request\transform::datetime($allocation->certificateissuetimecompleted);
            $allocation->certificateissuetimecreated = \core_privacy\local\request\transform::datetime($allocation->certificateissuetimecreated);

            // Add user completion data.
            $sql = "SELECT itemid, timecompleted
                    FROM {enrol_programs_completions}
                    WHERE allocationid = :allocationid
                    ORDER BY timecompleted ASC";
            $params = ['allocationid' => $allocation->id];

            $completions = $DB->get_recordset_sql($sql, $params);
            foreach ($completions as $completion) {
                if (!property_exists($allocation, 'completions')) {
                    $allocation->completions = [];
                }
                $completion->timecompleted = \core_privacy\local\request\transform::datetime($completion->timecompleted);
                $allocation->completions[] = $completion;
            }
            $completions->close();

            // Add user evidence data.
            $sql = "SELECT pe.itemid, pe.evidencejson, pe.timecompleted, pe.timecreated, pe.createdby
                    FROM {enrol_programs_evidences} pe
                    JOIN {enrol_programs_items} pri ON pe.itemid = pri.id
                    JOIN {enrol_programs_allocations} pa ON pa.programid = pri.programid
                    WHERE pa.id = :allocationid
                    ORDER BY pe.timecreated ASC";
            $params = ['allocationid' => $allocation->id];

            $evidences = $DB->get_recordset_sql($sql, $params);
            foreach ($evidences as $evidence) {
                if (!property_exists($allocation, 'evidences')) {
                    $allocation->evidences = [];
                }
                $evidence->timecompleted = \core_privacy\local\request\transform::datetime($evidence->timecompleted);
                $evidence->timecreated = \core_privacy\local\request\transform::datetime($evidence->timecreated);
                $allocation->evidences[] = $evidence;
            }
            $evidences->close();

            // Set user snapshot data.
            $sql = "SELECT reason, timesnapshot, snapshotby, explanation, programid, userid, sourceid,
                        archived, sourcedatajson, timeallocated, timestart, timedue, timeend,
                        timecompleted, completionsjson, evidencesjson
                    FROM {enrol_programs_usr_snapshots}
                    WHERE allocationid = :allocationid
                    ORDER BY timesnapshot ASC";
            $params = ['allocationid' => $allocation->id];

            $snapshots = $DB->get_recordset_sql($sql, $params);
            foreach ($snapshots as $snapshot) {
                if (!property_exists($allocation, 'usersnapshots')) {
                    $allocation->usersnapshots = [];
                }
                $snapshot->timesnapshot = \core_privacy\local\request\transform::datetime($snapshot->timesnapshot);
                $snapshot->timeallocated = \core_privacy\local\request\transform::datetime($snapshot->timeallocated);
                $snapshot->timestart = \core_privacy\local\request\transform::datetime($snapshot->timestart);
                $snapshot->timedue = \core_privacy\local\request\transform::datetime($snapshot->timedue);
                $snapshot->timeend = \core_privacy\local\request\transform::datetime($snapshot->timeend);
                $snapshot->timecompleted = \core_privacy\local\request\transform::datetime($snapshot->timecompleted);
                $allocation->usersnapshots[] = $snapshot;
            }
            $snapshots->close();

            $programcontext = \context::instance_by_id($allocation->contextid);
            unset($allocation->id, $allocation->contextid);
            writer::with_context($programcontext)->export_data(
                [$strallocation, $allocation->fullname],
                (object) ['allocation' => $allocation]
            );
        }
        $rs->close();

        // Add user request data.
        $sql = "SELECT p.contextid, p.fullname, pr.sourceid, pr.datajson, pr.timerequested, pr.timerejected, pr.rejectedby
                FROM {enrol_programs_requests} pr
                JOIN {user} u ON u.id = pr.userid AND u.deleted = 0
                JOIN {enrol_programs_sources} ps ON pr.sourceid = ps.id
                JOIN {enrol_programs_programs} p ON ps.programid = p.id
                WHERE u.id = :userid
                ORDER BY pr.id ASC";
        $params = ['userid' => $user->id];

        $requests = $DB->get_recordset_sql($sql, $params);
        foreach ($requests as $request) {
            $request->timerequested = \core_privacy\local\request\transform::datetime($request->timerequested);
            $request->timerejected = \core_privacy\local\request\transform::datetime($request->timerejected);

            $programcontext = \context::instance_by_id($request->contextid);
            unset($request->contextid);
            writer::with_context($programcontext)->export_data(
                [$strallocation, $request->fullname, $strprogramrequests],
                (object) ['request' => $request]
            );
        }
        $requests->close();
    }

    /**
     * Delete all data for all users in the specified context.
     *
     * @param \context $context The specific context to delete data for.
     */
    public static function delete_data_for_all_users_in_context(\context $context) {
        global $DB;

        $sql = "SELECT pa.*
                  FROM {enrol_programs_programs} p
                  JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                  JOIN {enrol_programs_sources} s ON s.id = pa.sourceid AND s.programid = p.id
                  JOIN {context} ctx ON p.contextid = ctx.id
                  JOIN {user} u ON u.id = pa.userid AND u.deleted = 0
                 WHERE ctx.id = :contextid
              ORDER BY pa.id ASC, u.id ASC";
        $params = ['contextid' => $context->id];

        $allclasses = \enrol_programs\local\allocation::get_source_classes();
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $allocation) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
            $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid]);
            if (!isset($allclasses[$source->type])) {
                continue;
            }
            /** @var \enrol_programs\local\source\base $coursceclass */
            $coursceclass = $allclasses[$source->type];
            $coursceclass::deallocate_user($program, $source, $allocation);

            $params = ['allocationid' => $allocation->id];
            $DB->delete_records('enrol_programs_certs_issues', $params);
            $DB->delete_records('enrol_programs_usr_snapshots', $params);
        }
        $rs->close();
    }

    /**
     * Delete all user data for the specified user, in the specified contexts.
     *
     * @param approved_contextlist $contextlist The approved contexts and user information to delete information for.
     */
    public static function delete_data_for_user(approved_contextlist $contextlist) {
        global $DB;

        if (empty($contextlist->count())) {
            return;
        }

        $user = $contextlist->get_user();
        list($contextsql, $contextparams) = $DB->get_in_or_equal($contextlist->get_contextids(), SQL_PARAMS_NAMED);

        $sql = "SELECT pa.*
                  FROM {enrol_programs_programs} p
                  JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                  JOIN {enrol_programs_sources} s ON s.id = pa.sourceid AND s.programid = p.id
                  JOIN {context} ctx ON p.contextid = ctx.id
                  JOIN {user} u ON u.id = pa.userid AND u.deleted = 0
                 WHERE u.id = :userid AND ctx.id {$contextsql}
              ORDER BY pa.id ASC";
        $params = ['userid' => $user->id];
        $params += $contextparams;

        $allclasses = \enrol_programs\local\allocation::get_source_classes();
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $allocation) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
            $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid]);
            if (!isset($allclasses[$source->type])) {
                continue;
            }
            /** @var \enrol_programs\local\source\base $coursceclass */
            $coursceclass = $allclasses[$source->type];
            $coursceclass::deallocate_user($program, $source, $allocation);

            $params = ['allocationid' => $allocation->id];
            $DB->delete_records('enrol_programs_certs_issues', $params);
        }
        $rs->close();

        $params = ['userid' => $user->id];
        $DB->delete_records('enrol_programs_usr_snapshots', $params);
    }

    /**
     * Delete multiple users within a single context.
     *
     * @param   approved_userlist       $userlist The approved context and user information to delete information for.
     */
    public static function delete_data_for_users(approved_userlist $userlist) {
        global $DB;

        $context = $userlist->get_context();
        $userids = $userlist->get_userids();
        list($usersql, $userparams) = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED);

        $sql = "SELECT pa.*
                  FROM {enrol_programs_programs} p
                  JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                  JOIN {enrol_programs_sources} s ON s.id = pa.sourceid AND s.programid = p.id
                  JOIN {context} ctx ON p.contextid = ctx.id
                  JOIN {user} u ON u.id = pa.userid AND u.deleted = 0
                 WHERE ctx.id = :contextid AND u.id {$usersql}
              ORDER BY pa.id ASC, u.id ASC";
        $params = ['contextid' => $context->id];
        $params += $userparams;

        $allclasses = \enrol_programs\local\allocation::get_source_classes();
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $allocation) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
            $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid]);
            if (!isset($allclasses[$source->type])) {
                continue;
            }
            /** @var \enrol_programs\local\source\base $coursceclass */
            $coursceclass = $allclasses[$source->type];
            $coursceclass::deallocate_user($program, $source, $allocation);

            $params = ['allocationid' => $allocation->id];
            $DB->delete_records('enrol_programs_certs_issues', $params);
            $params = ['userid' => $allocation->userid];
            $DB->delete_records('enrol_programs_usr_snapshots', $params);
            $DB->delete_records('enrol_programs_requests', $params);
        }
        $rs->close();
    }
}
