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

namespace enrol_programs\local;

use enrol_programs\local\source\approval;
use enrol_programs\local\source\base;
use enrol_programs\local\source\cohort;
use enrol_programs\local\source\manual;
use enrol_programs\local\source\selfallocation;
use enrol_programs\local\content\course;
use enrol_programs\local\content\top;
use enrol_programs\local\content\set;
use stdClass;

/**
 * Program allocation abstraction.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class allocation {
    /**
     * Returns list of all source classes present.
     *
     * @return string[] type => classname
     */
    public static function get_source_classes(): array {
        // Note: in theory this could be extended to load arbitrary classes.
        return [
            manual::get_type() => manual::class,
            selfallocation::get_type() => selfallocation::class,
            approval::get_type() => approval::class,
            cohort::get_type() => cohort::class,
        ];
    }

    /**
     * Returns list of all source names.
     *
     * @return string[] type => source name
     */
    public static function get_source_names(): array {
        /** @var base[] $classes */ // Type hack.
        $classes = self::get_source_classes();

        $result = [];
        foreach ($classes as $class) {
            $result[$class::get_type()] = $class::get_name();
        }

        return $result;
    }

    /**
     * Add and delete course enrolment instances for programs.
     *
     * @param int|null $programid
     * @return void
     */
    public static function fix_enrol_instances(?int $programid): void {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/group/lib.php');

        if (!PHPUNIT_TEST && $DB->is_transaction_started()) {
            debugging('allocation::fix_enrol_instances() is not supposed to be used in transactions', DEBUG_DEVELOPER);
        }

        $plugin = enrol_get_plugin('programs');

        // Add new instances.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $sql = "SELECT c.*, pi.programid, p.archived AS programarchived
                  FROM {course} c
                  JOIN {enrol_programs_items} pi ON pi.courseid = c.id
                  JOIN {enrol_programs_programs} p ON p.id = pi.programid
             LEFT JOIN {enrol} e ON e.courseid = c.id AND e.enrol = 'programs' AND e.customint1 = pi.programid
                 WHERE e.id IS NULL $programselect
              ORDER BY pi.programid ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $course) {
            $pid = $course->programid;
            unset($course->programid);
            $archived = $course->programarchived;
            unset($course->programarchived);
            $fields = ['customint1' => $pid];
            if ($archived) {
                $fields['status'] = ENROL_INSTANCE_DISABLED;
            } else {
                $fields['status'] = ENROL_INSTANCE_ENABLED;
            }
            $plugin->add_instance($course, $fields);
        }
        $rs->close();

        // Delete left-over instances.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND e.customint1 = :programid";
            $params['programid'] = $programid;
        }
        $sql = "SELECT e.*
                  FROM {enrol} e
             LEFT JOIN {enrol_programs_items} pi ON pi.courseid = e.courseid AND pi.programid = e.customint1
                 WHERE e.enrol = 'programs' AND pi.id IS NULL $programselect
              ORDER BY e.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $enrol) {
            $plugin->delete_instance($enrol);
        }
        $rs->close();

        // Disable instances in archived courses.
        $params = ['enabled' => ENROL_INSTANCE_ENABLED];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $sql = "SELECT e.*
                  FROM {enrol} e
                  JOIN {enrol_programs_items} pi ON pi.courseid = e.courseid AND pi.programid = e.customint1
                  JOIN {enrol_programs_programs} p ON p.id = pi.programid
                 WHERE e.enrol = 'programs' AND p.archived = 1 AND e.status = :enabled $programselect
              ORDER BY e.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $enrol) {
            $plugin->update_status($enrol, ENROL_INSTANCE_DISABLED);
            $context = \context_course::instance($enrol->courseid);
            role_unassign_all([
                'contextid' => $context->id,
                'component' => 'enrol_programs',
                'itemid' => $enrol->id,
            ]);
        }
        $rs->close();

        // Enable instances in non-archived courses.
        $params = ['disabled' => ENROL_INSTANCE_DISABLED];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $sql = "SELECT e.*
                  FROM {enrol} e
                  JOIN {enrol_programs_items} pi ON pi.courseid = e.courseid AND pi.programid = e.customint1
                  JOIN {enrol_programs_programs} p ON p.id = pi.programid
                 WHERE e.enrol = 'programs' AND p.archived = 0 AND e.status = :disabled $programselect
              ORDER BY e.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $enrol) {
            $plugin->update_status($enrol, ENROL_INSTANCE_ENABLED);
            // NOTE: roles will be re-added in user enrolment sync later.
        }
        $rs->close();

        // Create missing groups.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $sql = "SELECT pi.courseid, pi.programid, p.fullname, pg.id
                  FROM {enrol_programs_items} pi
                  JOIN {enrol_programs_programs} p ON p.id = pi.programid
             LEFT JOIN {enrol_programs_groups} pg ON pg.programid = p.id AND pg.courseid = pi.courseid
             LEFT JOIN {groups} g ON g.id = pg.groupid
                 WHERE p.archived = 0 AND p.creategroups = 1 AND pi.courseid IS NOT NULL
                       AND (pg.id IS NULL OR g.id IS NULL)
                       $programselect
              ORDER BY pi.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $pg) {
            $trans = $DB->start_delegated_transaction();
            // NOTE: We should probably add some description pointing back to program.
            $data = (object)[
                'courseid' => $pg->courseid,
                'name' => $pg->fullname,
            ];
            $gid = groups_create_group($data);
            if ($pg->id) {
                $DB->set_field('enrol_programs_groups', 'groupid', $gid, ['id' => $pg->id]);
            } else {
                $data = (object)[
                    'programid' => $pg->programid,
                    'courseid' => $pg->courseid,
                    'groupid' => $gid,
                ];
                $DB->insert_record('enrol_programs_groups', $data);
            }
            $trans->allow_commit();
        }
        $rs->close();

        // Delete obsolete groups.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $sql = "SELECT pg.id, pg.groupid
                  FROM {enrol_programs_groups} pg
             LEFT JOIN {enrol_programs_programs} p ON p.id = pg.programid
             LEFT JOIN {enrol_programs_items} pi ON pi.programid = pg.programid AND pi.courseid = pg.courseid
                 WHERE (p.id IS NULL OR pi.id IS NULL OR p.creategroups = 0)
                       $programselect
              ORDER BY pg.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $pg) {
            $trans = $DB->start_delegated_transaction();
            groups_delete_group($pg->groupid);
            $DB->delete_records('enrol_programs_groups', ['id' => $pg->id]);
            $trans->allow_commit();
        }
        $rs->close();
    }

    /**
     * Check and fix all user enrolments, this expects the course enrol
     * instances were already fixed.
     *
     * NOTE: this can be used as a quick way to make sure all users enrolments are up-to-date.
     *
     * @param int|null $programid
     * @param int|null $userid
     * @return void
     */
    public static function fix_user_enrolments(?int $programid, ?int $userid): void {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/group/lib.php');

        if (!PHPUNIT_TEST && !$userid && $DB->is_transaction_started()) {
            debugging('allocation::fix_user_enrolments() is not supposed to be used in transactions without userid', DEBUG_DEVELOPER);
        }

        $plugin = enrol_get_plugin('programs');
        $roleid = get_config('enrol_programs', 'roleid');

        // Delete enrolments if user is not allocated.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND ue.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT e.*, ue.userid, gm.groupid
                  FROM {user_enrolments} ue
                  JOIN {enrol} e ON e.id = ue.enrolid AND e.enrol = 'programs'
                  JOIN {enrol_programs_items} pi ON pi.courseid = e.courseid AND pi.programid = e.customint1
             LEFT JOIN {enrol_programs_allocations} pa ON pa.programid = pi.programid AND pa.userid = ue.userid
             LEFT JOIN {enrol_programs_groups} pg ON pg.programid = pi.programid AND pg.courseid = pi.courseid
             LEFT JOIN {groups_members} gm ON gm.groupid = pg.groupid AND gm.userid = ue.userid
                 WHERE pa.id IS NULL
                       $programselect $userselect
              ORDER BY e.id ASC, ue.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $enrol) {
            $puserid = $enrol->userid;
            unset($enrol->userid);
            $groupid = $enrol->groupid;
            unset($enrol->groupid);
            if ($groupid) {
                groups_remove_member($groupid, $puserid);
            }
            $plugin->unenrol_user($enrol, $puserid);
            $context = \context_course::instance($enrol->courseid);
            role_unassign_all([
                'contextid' => $context->id,
                'component' => 'enrol_programs',
                'itemid' => $enrol->id,
            ]);
        }
        $rs->close();

        // Add enrolments for all users as soon as they are allocated,
        // we want teachers to see all future course users (ignore archived programs and allocations).
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND p.id = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT e.*, pa.userid
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {enrol_programs_items} pi ON pi.programid = pa.programid
                  JOIN {enrol} e ON e.enrol = 'programs' AND e.customint1 = pi.programid AND e.courseid = pi.courseid
             LEFT JOIN {user_enrolments} ue ON ue.userid = pa.userid AND ue.enrolid = e.id
                 WHERE ue.id IS NULL
                       AND p.archived = 0 AND pa.archived = 0
                       $programselect $userselect
              ORDER BY e.id ASC, pa.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $enrol) {
            $puserid = $enrol->userid;
            unset($enrol->userid);
            // Do NOT restore grades, that would be a wrong thing to do here for programs
            // and especially certifications later.
            $plugin->enrol_user($enrol, $puserid, null, 0, 0, ENROL_USER_SUSPENDED, false);
        }
        $rs->close();

        // Disable all enrolments (and remove roles) for archived, future and past allocations that are active.
        $params = ['active' => ENROL_USER_ACTIVE];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND ue.userid = :userid";
            $params['userid'] = $userid;
        }
        $now = time();
        $params['now1'] = $now;
        $params['now2'] = $now;
        $sql = "SELECT e.*, ue.userid
                  FROM {user_enrolments} ue
                  JOIN {enrol} e ON e.id = ue.enrolid AND e.enrol = 'programs'
                  JOIN {enrol_programs_items} pi ON pi.courseid = e.courseid AND pi.programid = e.customint1
                  JOIN {enrol_programs_allocations} pa ON pa.programid = pi.programid AND pa.userid = ue.userid
                 WHERE ue.status = :active
                       AND (pa.archived = 1 OR pa.timestart > :now1 OR (pa.timeend IS NOT NULL AND pa.timeend < :now2))
                       $programselect $userselect
              ORDER BY e.id ASC, ue.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $enrol) {
            $puserid = $enrol->userid;
            unset($enrol->userid);
            $plugin->update_user_enrol($enrol, $puserid, ENROL_USER_SUSPENDED);
            $context = \context_course::instance($enrol->courseid);
            role_unassign_all([
                'contextid' => $context->id,
                'component' => 'enrol_programs',
                'itemid' => $enrol->id,
            ]);
        }
        $rs->close();

        // Copy completion date from other evidences if item not completed yet.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        }
        $now = time();
        $params['now1'] = $now;
        $params['now2'] = $now;
        $params['now3'] = $now;
        $sql = "INSERT INTO {enrol_programs_completions} (itemid, allocationid, timecompleted)

                SELECT pi.id, pa.id, :now3
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {enrol_programs_items} pi ON pi.programid = pa.programid
                  JOIN {enrol_programs_evidences} pe ON pe.userid = pa.userid AND pe.itemid = pi.id
             LEFT JOIN {enrol_programs_completions} pc ON pc.allocationid = pa.id AND pc.itemid = pi.id
                 WHERE pc.id IS NULL
                       AND p.archived = 0 AND pa.archived = 0
                       AND (pa.timestart IS NULL OR pa.timestart <= :now1)
                       AND (pa.timeend IS NULL OR pa.timeend > :now2)
                       $programselect $userselect";
        $DB->execute($sql, $params);

        // Copy completion info from course completion to program item completion,
        // do not remove program item completion if completion gets reset in course later.
        $params = [];
        $programselect = '';
        $userselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        }
        $now = time();
        $params['now1'] = $now;
        $params['now2'] = $now;
        $params['now3'] = $now;
        $sql = "INSERT INTO {enrol_programs_completions} (itemid, allocationid, timecompleted)

                SELECT pi.id, pa.id, :now3
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {enrol_programs_items} pi ON pi.programid = pa.programid
                  JOIN {course_completions} cc ON cc.userid = pa.userid AND cc.course = pi.courseid
             LEFT JOIN {enrol_programs_completions} pc ON pc.allocationid = pa.id AND pc.itemid = pi.id
                 WHERE pc.id IS NULL AND cc.reaggregate = 0 AND cc.timecompleted > 0
                       AND p.archived = 0 AND pa.archived = 0
                       AND (pa.timestart IS NULL OR pa.timestart <= :now1)
                       AND (pa.timeend IS NULL OR pa.timeend > :now2)
                       $programselect $userselect";
        $DB->execute($sql, $params);

        // Calculate set completions ignoring course items,
        // do max 100 dependencies to prevent infinite loop.
        for ($i = 0; $i < 100; $i++) {
            $params = [];
            $programselect = '';
            if ($programid) {
                $programselect = "AND p.id = :programid";
                $params['programid'] = $programid;
            }
            $userselect = '';
            if ($userid) {
                $userselect = "AND pa.userid = :userid";
                $params['userid'] = $userid;
            }
            $now = time();
            $params['now1'] = $now;
            $params['now2'] = $now;
            $sql = "SELECT psi.id AS itemid, pa.id AS allocationid, psi.minprerequisites, COUNT(pric.id) AS precount
                      FROM {enrol_programs_items} psi
                      JOIN {enrol_programs_programs} p ON p.id = psi.programid
                      JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
                 LEFT JOIN {enrol_programs_completions} psic ON psic.itemid = psi.id AND psic.allocationid = pa.id
                      JOIN {enrol_programs_prerequisites} pr ON pr.itemid = psi.id
                      JOIN {enrol_programs_completions} pric ON pric.itemid = pr.prerequisiteitemid AND pric.allocationid = pa.id
                     WHERE psic.id IS NULL AND psi.courseid IS NULL
                           AND p.archived = 0 AND pa.archived = 0
                           AND (pa.timestart IS NULL OR pa.timestart <= :now1)
                           AND (pa.timeend IS NULL OR pa.timeend > :now2)
                           $programselect $userselect
                  GROUP BY psi.id, pa.id, psi.minprerequisites
                    HAVING psi.minprerequisites <= COUNT(pric.id)
                  ORDER BY psi.id ASC, pa.id ASC";
            $rs = $DB->get_recordset_sql($sql, $params);
            $count = 0;
            foreach ($rs as $completion) {
                // NOTE: this should not return many records because this
                // should be called with userid parameter from event observers.
                $record = new stdClass();
                $record->itemid = $completion->itemid;
                $record->allocationid = $completion->allocationid;
                $record->timecompleted = time(); // Use real time, we are not in a transaction here.
                $DB->insert_record('enrol_programs_completions', $record);
                $count++;
            }
            $rs->close();

            if (!$count) {
                // Stop when nothing found.
                break;
            }
        }

        // Unsuspend enrolments where previous item was completed or there is no previous item specified.
        $params = ['suspended' => ENROL_USER_SUSPENDED];
        $programselect = '';
        if ($programid) {
            $programselect = "AND p.id = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND ue.userid = :userid";
            $params['userid'] = $userid;
        }
        $now = time();
        $params['now1'] = $now;
        $params['now2'] = $now;
        $sql = "SELECT e.*, pa.userid
                  FROM {user_enrolments} ue
                  JOIN {enrol} e ON e.enrol = 'programs' AND e.id = ue.enrolid
                  JOIN {enrol_programs_items} pi ON pi.programid = e.customint1 AND pi.courseid = e.courseid
                  JOIN {enrol_programs_allocations} pa ON pa.userid = ue.userid AND pa.programid = pi.programid
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
             LEFT JOIN {enrol_programs_items} previ ON previ.programid = p.id AND previ.id = pi.previtemid
             LEFT JOIN {enrol_programs_completions} previc ON previc.itemid = previ.id AND previc.allocationid = pa.id
                 WHERE ue.status = :suspended
                       AND (pi.previtemid IS NULL OR previc.timecompleted IS NOT NULL)
                       AND p.archived = 0 AND pa.archived = 0
                       AND (pa.timestart IS NULL OR pa.timestart <= :now1)
                       AND (pa.timeend IS NULL OR pa.timeend > :now2)
                       $programselect $userselect
              ORDER BY e.id ASC, pa.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $enrol) {
            $puserid = $enrol->userid;
            unset($enrol->userid);
            $plugin->update_user_enrol($enrol, $puserid, ENROL_USER_ACTIVE);
        }
        $rs->close();

        // Remove role for all non-active enrolments.
        $params = ['suspended' => ENROL_USER_SUSPENDED, 'disabled' => ENROL_INSTANCE_DISABLED, 'roleid' => $roleid];
        $programselect = '';
        if ($programid) {
            $programselect = "AND p.id = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND ue.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT ra.*
                  FROM {user_enrolments} ue
                  JOIN {enrol} e ON e.enrol = 'programs' AND e.id = ue.enrolid
                  JOIN {enrol_programs_items} pi ON pi.programid = e.customint1 AND pi.courseid = e.courseid
                  JOIN {enrol_programs_allocations} pa ON pa.userid = ue.userid AND pa.programid = pi.programid
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {context} c ON c.instanceid = e.courseid AND c.contextlevel = 50
                  JOIN {role_assignments} ra ON ra.contextid = c.id AND ra.component = 'enrol_programs' AND ra.userid = ue.userid AND ra.itemid = e.id
                 WHERE (ue.status = :suspended OR e.status = :disabled OR p.archived = 1 OR pa.archived = 1
                        OR ra.roleid <> :roleid)
                       $programselect $userselect
              ORDER BY ra.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $ra) {
            role_unassign($ra->roleid, $ra->userid, $ra->contextid, $ra->component, $ra->itemid);
        }
        $rs->close();

        // Add all wanted roles.
        $params = ['active' => ENROL_USER_ACTIVE, 'enabled' => ENROL_INSTANCE_ENABLED];
        $programselect = '';
        if ($programid) {
            $programselect = "AND p.id = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND ue.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT ue.userid, c.id AS contextid, e.id AS itemid
                  FROM {user_enrolments} ue
                  JOIN {enrol} e ON e.enrol = 'programs' AND e.id = ue.enrolid
                  JOIN {enrol_programs_items} pi ON pi.programid = e.customint1 AND pi.courseid = e.courseid
                  JOIN {enrol_programs_allocations} pa ON pa.userid = ue.userid AND pa.programid = pi.programid
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {context} c ON c.instanceid = e.courseid AND c.contextlevel = 50
             LEFT JOIN {role_assignments} ra ON ra.contextid = c.id AND ra.component = 'enrol_programs' AND ra.userid = ue.userid AND ra.itemid = e.id
                 WHERE ra.id IS NULL
                       AND ue.status = :active AND e.status = :enabled
                       AND p.archived = 0 AND pa.archived = 0
                       $programselect $userselect
              ORDER BY e.id ASC, pa.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $ra) {
            role_assign($roleid, $ra->userid, $ra->contextid, 'enrol_programs', $ra->itemid);
        }
        $rs->close();

        // Finally, if top program item is completed, copy the completion time to program allocation,
        // we do this in a loop one by one in order to trigger the program_completed event.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND pi.programid = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT p.*, pc.timecompleted, pa.id AS allocationid
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {enrol_programs_items} pi ON pi.programid = pa.programid AND pi.topitem = 1
                  JOIN {enrol_programs_completions} pc ON pc.allocationid = pa.id AND pc.itemid = pi.id
                 WHERE pa.timecompleted IS NULL
                       AND p.archived = 0 AND pa.archived = 0
                       $programselect $userselect
              ORDER BY pa.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $program) {
            $ptimecompleted = $program->timecompleted;
            unset($program->timecompleted);
            $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $program->allocationid]);
            unset($program->allocationid);
            $allocation->timecompleted = (string)$ptimecompleted;
            $DB->set_field('enrol_programs_allocations', 'timecompleted', $ptimecompleted, ['id' => $allocation->id]);
            $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid]);
            $user = $DB->get_record('user', ['id' => $allocation->userid]);

            self::make_snapshot($allocation->id, 'completion');
            $event = \enrol_programs\event\program_completed::create_from_allocation($allocation, $program);
            $event->trigger();
            notification::notify_completed($program, $source, $allocation, $user);
        }
        $rs->close();

        // Add program group members,
        // the membership is then kept until unenrolment or group disposal.
        $params = [];
        $programselect = '';
        if ($programid) {
            $programselect = "AND p.id = :programid";
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = "AND ue.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT ue.userid, pg.groupid, p.id AS programid
                  FROM {user_enrolments} ue
                  JOIN {enrol} e ON e.enrol = 'programs' AND e.id = ue.enrolid
                  JOIN {enrol_programs_items} pi ON pi.programid = e.customint1 AND pi.courseid = e.courseid
                  JOIN {enrol_programs_programs} p ON p.id = pi.programid
                  JOIN {enrol_programs_allocations} pa ON pa.userid = ue.userid AND pa.programid = pi.programid
                  JOIN {enrol_programs_groups} pg ON pg.programid = pi.programid AND pg.courseid = pi.courseid
             LEFT JOIN {groups_members} gm ON gm.groupid = pg.groupid AND gm.userid = ue.userid
                 WHERE gm.id IS NULL AND p.archived = 0 AND pa.archived = 0
                       $programselect $userselect
              ORDER BY ue.userid ASC, pg.groupid ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $cm) {
            groups_add_member($cm->groupid, $cm->userid, 'enrol_programs', $cm->programid);
        }
        $rs->close();
    }

    /**
     * Ask sources to fix their allocations.
     *
     * This is expected to be called from cron and when
     * program allocation settings are updated.
     *
     * @param int|null $programid
     * @param int|null $userid
     * @return void
     */
    public static function fix_allocation_sources(?int $programid, ?int $userid): void {
        $sources = self::get_source_classes();
        foreach ($sources as $source) {
            /** @var source\base $source */
            $source::fix_allocations($programid, $userid);
        }
    }

    /**
     * Manually update user allocation data including program completion.
     *
     * @param stdClass $allocatioon
     * @return stdClass
     */
    public static function update_user(stdClass $allocatioon): stdClass {
        global $DB;

        $record = $DB->get_record('enrol_programs_allocations', ['id' => $allocatioon->id], '*', MUST_EXIST);

        $trans = $DB->start_delegated_transaction();

        self::make_snapshot($record->id, 'allocation_edit_before');

        $record->archived = (int)(bool)$allocatioon->archived;
        $record->timeallocated = $allocatioon->timeallocated;
        $record->timestart = $allocatioon->timestart;
        $record->timedue = $allocatioon->timedue;
        if (!$record->timedue) {
            $record->timedue = null;
        } else if ($record->timedue <= $record->timestart) {
            throw new \coding_exception('invalid due date');
        }
        $record->timeend = $allocatioon->timeend;
        if (!$record->timeend) {
            $record->timeend = null;
        } else if ($record->timeend <= $record->timestart) {
            throw new \coding_exception('invalid end date');
        }
        if ($record->timedue && $record->timeend && $record->timedue > $record->timeend) {
            throw new \coding_exception('invalid due date');
        }
        $record->timecompleted = $allocatioon->timecompleted;
        if (!$record->timecompleted) {
            $record->timecompleted = null;
        }

        $DB->update_record('enrol_programs_allocations', $record);

        self::make_snapshot($record->id, 'allocation_edit');

        $trans->allow_commit();

        self::fix_allocation_sources($record->programid, $record->userid);
        self::fix_user_enrolments($record->programid, $record->userid);

        notification::trigger_notifications($record->programid, $record->userid);

        return $DB->get_record('enrol_programs_allocations', ['id' => $record->id], '*', MUST_EXIST);
    }

    /**
     * Manually update item completion data.
     *
     * @param stdClass $data
     * @return void
     */
    public static function update_item_completion(stdClass $data): void {
        global $DB, $USER;

        $trans = $DB->start_delegated_transaction();

        $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $data->allocationid], '*', MUST_EXIST);
        $item = $DB->get_record('enrol_programs_items', ['id' => $data->itemid, 'programid' => $allocation->programid], '*', MUST_EXIST);
        $completion = $DB->get_record('enrol_programs_completions', ['allocationid' => $allocation->id, 'itemid' => $item->id]);
        $evidence = $DB->get_record('enrol_programs_evidences', ['userid' => $allocation->userid, 'itemid' => $item->id]);

        self::make_snapshot($allocation->id, 'completion_edit_before');

        if ($data->timecompleted) {
            if ($completion) {
                $DB->set_field('enrol_programs_completions', 'timecompleted', $data->timecompleted, ['id' => $completion->id]);
            } else {
                $record = new stdClass();
                $record->allocationid = $allocation->id;
                $record->itemid = $item->id;
                $record->timecompleted = $data->timecompleted;
                $DB->insert_record('enrol_programs_completions', $record);
            }
        } else {
            if ($completion) {
                $DB->delete_records('enrol_programs_completions', ['id' => $completion->id]);
            }
        }

        if ($data->evidencetimecompleted) {
            $evidencejson = util::json_encode(['details' => $data->evidencedetails]);
            if ($evidence) {
                $evidence->timecompleted = $data->evidencetimecompleted;
                $evidence->evidencejson = $evidencejson;
                $DB->update_record('enrol_programs_evidences', $evidence);
            } else {
                $record = new stdClass();
                $record->userid = $allocation->userid;
                $record->itemid = $item->id;
                $record->timecompleted = $data->evidencetimecompleted;
                $record->evidencejson = $evidencejson;
                $record->timecreated = time();
                $record->createdby = $USER->id;
                $DB->insert_record('enrol_programs_evidences', $record);
            }
        } else {
            if ($evidence) {
                $DB->delete_records('enrol_programs_evidences', ['id' => $evidence->id]);
            }
        }

        self::make_snapshot($allocation->id, 'completion_edit');

        $trans->allow_commit();

        self::fix_user_enrolments($allocation->programid, $allocation->userid);
    }

    /**
     * Returns completion status as plain text.
     *
     * @param stdClass $program
     * @param stdClass $allocation
     * @return string
     */
    public static function get_completion_status_plain(stdClass $program, stdClass $allocation): string {
        $now = time();

        if ($program->archived || $allocation->archived) {
            if ($allocation->timecompleted) {
                return get_string('programstatus_archivedcompleted', 'enrol_programs');
            } else {
                return get_string('programstatus_archived', 'enrol_programs');
            }
        }

        if ($allocation->timecompleted) {
            return get_string('programstatus_completed', 'enrol_programs');
        } else if ($allocation->timestart > $now) {
            return get_string('programstatus_future', 'enrol_programs');
        } else if ($allocation->timeend && $allocation->timeend < $now) {
            return get_string('programstatus_failed', 'enrol_programs');
        } else if ($allocation->timedue && $allocation->timedue < $now) {
            return get_string('programstatus_overdue', 'enrol_programs');
        } else {
            // We need something different from tags that use 'badge-info'.
            return get_string('programstatus_open', 'enrol_programs');
        }
    }

    /**
     * Returns completion status as fancy HTML.
     *
     * @param stdClass $program
     * @param stdClass $allocation
     * @return string
     */
    public static function get_completion_status_html(stdClass $program, stdClass $allocation): string {
        $result = [];

        $now = time();

        if ($program->archived || $allocation->archived) {
            if ($allocation->timecompleted) {
                $result[] = '<span class="badge badge-success">' . get_string('programstatus_archivedcompleted', 'enrol_programs') . '</span>';
            } else {
                $result[] = '<span class="badge badge-dark">' . get_string('programstatus_archived', 'enrol_programs') . '</span>';
            }
        } else if ($allocation->timecompleted) {
            $result[] = '<div class="badge badge-success">' . get_string('programstatus_completed', 'enrol_programs') . '</div>';
        } else if ($allocation->timestart > $now) {
            $result[] = '<div class="badge badge-light">' . get_string('programstatus_future', 'enrol_programs') . '</div>';
        } else if ($allocation->timeend && $allocation->timeend < $now) {
            $result[] = '<div class="badge badge-danger">' . get_string('programstatus_failed', 'enrol_programs') . '</div>';
        } else if ($allocation->timedue && $allocation->timedue < $now) {
            $result[] = '<div class="badge badge-warning">' . get_string('programstatus_overdue', 'enrol_programs') . '</div>';
        } else {
            // We need something different from tags that use 'badge-info'.
            $result[] = '<div class="badge badge-primary">' . get_string('programstatus_open', 'enrol_programs') . '</div>';
        }

        return implode(' ', $result);
    }

    /**
     * To be called after user deletion to make sure there are no user data leftovers.
     *
     * @param int $userid
     * @return void
     */
    public static function deleted_user_cleanup(int $userid): void {
        global $DB;

        $user = $DB->get_record('user', ['id' => $userid]);
        if ($user && !$user->deleted) {
            debugging('Invalid deleted user cleanup request!', DEBUG_DEVELOPER);
            return;
        }

        $allocations = $DB->get_records('enrol_programs_allocations', ['userid' => $userid]);
        foreach ($allocations as $allocation) {
            self::make_snapshot($allocation->id, 'user_deleted');
            $DB->delete_records('enrol_programs_completions', ['allocationid' => $allocation->id]);
        }
        $DB->delete_records('enrol_programs_evidences', ['userid' => $userid]);
        $DB->delete_records('enrol_programs_allocations', ['userid' => $userid]);
        $DB->delete_records('enrol_programs_requests', ['userid' => $userid]);
    }

    /**
     * Make a full user allocation snapshot.
     *
     * @param int $allocationid
     * @param string $reaons snapshot reason type
     * @param string|null $explanation
     * @return \stdClass|null allocation record or null if not exists any more
     */
    public static function make_snapshot(int $allocationid, string $reason, ?string $explanation = null): ?\stdClass {
        global $DB, $USER;

        $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $allocationid]);
        if (!$allocation) {
            // Must have been just deleted.
            return null;
        }

        $data = new \stdClass();
        $data->allocationid = $allocationid;
        $data->reason = $reason;
        $data->timesnapshot = time();
        if ($USER->id > 0) {
            $data->snapshotby = $USER->id;
        }
        $data->explanation = $explanation;

        foreach ((array)$allocation as $k => $v) {
            if ($k === 'id' || $k === 'timecreated') {
                continue;
            }
            if (strpos($k, 'timenotified') === 0) {
                continue;
            }
            $data->{$k} = $v;
        }

        $data->completionsjson = util::json_encode($DB->get_records('enrol_programs_completions', ['allocationid' => $allocation->id], 'id ASC'));
        $sql = "SELECT e.*
                  FROM {enrol_programs_evidences} e
                  JOIN {enrol_programs_items} i ON i.id = e.itemid
                 WHERE e.userid = :userid AND i.programid = :programid
              ORDER BY e.id ASC";
        $data->evidencesjson = util::json_encode($DB->get_records_sql($sql, ['userid' => $allocation->userid, 'programid' => $allocation->programid]));

        $DB->insert_record('enrol_programs_usr_snapshots', $data);

        return $allocation;
    }
}
