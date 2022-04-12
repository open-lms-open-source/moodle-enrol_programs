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
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
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
                    'timeallocated' => 'privacy:metadata:field:timeallocated',
                    'timestarted' => 'privacy:metadata:field:timestarted',
                    'timecompleted' => 'privacy:metadata:field:timecompleted',
                ],
                'privacy:metadata:table:enrol_programs_allocations'
        );

        // NOTE: we should add more details here...

        $collection->add_database_table(
            'enrol_programs_requests',
            [
                'userid' => 'privacy:metadata:field:userid',
                'timerequested' => 'privacy:metadata:field:timerequested',
                'timerejected' => 'privacy:metadata:field:timerejected',
            ],
            'privacy:metadata:table:enrol_programs_requests'
        );

        $collection->add_database_table(
            'enrol_programs_evidences',
            [
                'userid' => 'privacy:metadata:field:userid',
                'timecreated' => 'privacy:metadata:field:timecreated',
            ],
            'privacy:metadata:table:enrol_programs_evidences'
        );

        $collection->add_database_table(
            'enrol_programs_usr_snapshots',
            [
                'userid' => 'privacy:metadata:field:userid',
                'timesnapshot' => 'privacy:metadata:field:timesnapshot',
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

        $sql = "SELECT pa.programid, pa.userid, pa.timeallocated, pa.timestarted, pa.timecompleted, p.contextid
                  FROM {enrol_programs_programs} p
                  JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                  JOIN {context} ctx ON p.contextid = ctx.id
                  JOIN {user} u ON u.id = pa.userid AND u.deleted = 0
                 WHERE ctx.id {$contextsql} AND u.id = :userid
              ORDER BY pa.id ASC";
        $params = ['userid' => $user->id];
        $params += $contextparams;

        $strallocation = get_string('allocation', 'enrol_programs');
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $allocation) {
            $allocation->timeallocated = \core_privacy\local\request\transform::datetime($allocation->timeallocated);
            $allocation->timestarted = \core_privacy\local\request\transform::datetime($allocation->timestarted);
            $allocation->timecompleted = \core_privacy\local\request\transform::datetime($allocation->timecompleted);
            $programcontext = \context::instance_by_id($allocation->contextid);
            unset($allocation->contextid);
            writer::with_context($programcontext)->export_data(
                [$strallocation],
                (object) ['allocation' => $allocation]
            );
        }
        $rs->close();
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
        }
        $rs->close();
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
        }
        $rs->close();
    }
}
