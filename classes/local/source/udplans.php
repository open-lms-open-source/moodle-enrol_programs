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

namespace enrol_programs\local\source;

use stdClass;

/**
 * Program allocation for all udplans.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class udplans extends base {
    /**
     * Returns short type name of source.
     *
     * @return string
     */
    public static function get_type(): string {
        return 'udplans';
    }

    /**
     * UDP allocation is possible only if tool_udplans is present and active.
     *
     * @param stdClass $program
     * @return bool
     */
    public static function is_new_allowed(\stdClass $program): bool {
        if (!\tool_udplans\local\util::udplans_active()) {
            return false;
        }

        $context = \context::instance_by_id($program->contextid);
        return has_capability('enrol/programs:configframeworks', $context);
    }

    /**
     * Can existing source of this type be updated or deleted from program?
     *
     * @param stdClass $program
     * @return bool
     */
    public static function is_update_allowed(stdClass $program): bool {
        $context = \context::instance_by_id($program->contextid);
        return has_capability('enrol/programs:configframeworks', $context);
    }

    /**
     * Allocation is controlled by tool_udplans.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_edit_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        return false;
    }

    /**
     * Is it possible to manually delete user allocation?
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_delete_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        if ($allocation->archived) {
            return true;
        }
        if ($allocation->timeend && $allocation->timeend < time()) {
            // Allow deleting of historic plan allocations,
            // they will not be re-added automatically.
            return true;
        }
        return false;
    }

    /**
     * Callback method for source updates.
     *
     * @param stdClass|null $oldsource
     * @param stdClass $data
     * @param stdClass|null $source
     * @return void
     */
    public static function after_update(?stdClass $oldsource, stdClass $data, ?stdClass $source): void {
        global $DB;

        if (!$source) {
            if ($oldsource) {
                $DB->delete_records('enrol_programs_frameworks', ['sourceid' => $oldsource->id]);
            }
            return;
        }

        $current = $DB->get_records('enrol_programs_frameworks', ['sourceid' => $source->id], 'id ASC', 'frameworkid, id, sourceid, requirecap');
        $candidates = self::get_relevant_frameworks($source->programid, $source->id);

        foreach ($candidates as $framework) {
            if (!isset($data->framework[$framework->id])) {
                // This should not happen.
                continue;
            }
            $value = $data->framework[$framework->id];
            if ($value == -1) {
                continue;
            }
            $value = (int)(bool)$value;
            if (isset($current[$framework->id])) {
                $record = $current[$framework->id];
                unset($current[$framework->id]);
                if ($record->requirecap != $value) {
                    $DB->set_field('enrol_programs_frameworks', 'requirecap', $value, ['id' => $record->id]);
                }
            } else {
                $record = new stdClass();
                $record->sourceid = $source->id;
                $record->frameworkid = $framework->id;
                $record->requirecap = $value;
                $DB->insert_record('enrol_programs_frameworks', $record);
            }
        }

        foreach ($current as $record) {
            $DB->delete_records('enrol_programs_frameworks', ['id' => $record->id]);
        }
    }

    /**
     * Relevant frameworks for source.
     *
     * @param int $programid
     * @param int|null $sourceid
     * @return array list of framework records with extra requirecap property
     */
    public static function get_relevant_frameworks(int $programid, ?int $sourceid): array {
        global $DB;

        if ($sourceid) {
            $source = $DB->get_record('enrol_programs_sources', ['id' => $sourceid, 'programid' => $programid], '*', MUST_EXIST);
            $program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid]);
        } else {
            $source = null;
            $program = $DB->get_record('enrol_programs_programs', ['id' => $programid]);
        }

        $params = [];
        $tenantjoin = "";
        if (\enrol_programs\local\tenant::is_active()) {
            $programcontext = \context::instance_by_id($program->contextid);
            $programtenantid = \tool_olms_tenant\tenants::get_context_tenant_id($programcontext);
            if ($programtenantid) {
                $tenantjoin = "JOIN {context} c ON c.id = f.contextid AND (c.tenantid = :tenantid OR c.tenantid IS NULL)";
                $params['tenantid'] = $programtenantid;
            }
        }

        if ($source) {
            $params['sourceid'] = $source->id;
            $sql = "SELECT f.*, COALESCE(pf.requirecap, -1) AS requirecap
                      FROM {tool_udplans_frameworks} f
                      $tenantjoin
                 LEFT JOIN {enrol_programs_frameworks} pf ON pf.frameworkid = f.id AND pf.sourceid = :sourceid
                     WHERE f.archived = 0 OR pf.id IS NOT NULL
                  ORDER BY f.name ASC";
        } else {
            $sql = "SELECT f.*, -1 AS requirecap
                      FROM {tool_udplans_frameworks} f
                      $tenantjoin
                     WHERE f.archived = 0
                  ORDER BY f.name ASC";
        }

        return $DB->get_records_sql($sql, $params);
    }

    /**
     * Render details about this enabled source in a program management ui.
     *
     * @param stdClass $program
     * @param stdClass|null $source
     * @return string
     */
    public static function render_status_details(stdClass $program, ?stdClass $source): string {
        global $DB;

        $result = parent::render_status_details($program, $source);

        if ($source) {
            $params = [];
            $params['sourceid'] = $source->id;
            $sql = "SELECT f.*, pf.requirecap
                      FROM {tool_udplans_frameworks} f
                      JOIN {enrol_programs_frameworks} pf ON pf.frameworkid = f.id AND pf.sourceid = :sourceid
                  ORDER BY f.name ASC";
            $frameworks = $DB->get_records_sql($sql, $params);
            if ($frameworks) {
                foreach ($frameworks as $k => $framework) {
                    $name = format_string($framework->name);
                    if ($framework->requirecap) {
                        $name .= ' (' . get_string('source_udplans_requirecap', 'enrol_programs') . ')';
                    }
                    $frameworks[$k] = $name;
                }
                $result .= ' - ' . implode('; ', $frameworks);
            } else {
                $result .= ' - ' . get_string('source_udplans_noframeworks', 'enrol_programs');
            }
        }

        return $result;
    }

    /**
     * Update program allocations.
     *
     * @param int|null $userid
     * @return void
     */
    public static function sync_plans(?int $userid): void {
        global $DB;

        // Add new allocations - one program allocation per user only,
        // to allow retake allocation must be deleted manually first.
        $now = time();
        $params = [
            'now1' => $now,
            'now2' => $now,
        ];
        $userselect = "";
        if ($userid) {
            $userselect = "AND pl.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT pl.*, ps.id AS sourceid, i.timedue AS itemtimedue
                  FROM {tool_udplans_plans} pl
                  JOIN {user} u ON u.id = pl.userid AND u.deleted = 0 AND u.confirmed = 1
                  JOIN {tool_udplans_frameworks} f ON f.id = pl.frameworkid
                  JOIN {tool_udplans_items} i ON i.planid = pl.id AND i.itemtype = 'program'
                  JOIN {enrol_programs_programs} p ON p.id = i.instanceid
                  JOIN {enrol_programs_sources} ps ON ps.type = 'udplans' AND ps.programid = p.id
                  JOIN {enrol_programs_frameworks} pf ON pf.frameworkid = f.id AND pf.sourceid = ps.id
             LEFT JOIN {enrol_programs_allocations} pa ON pa.programid = p.id AND pa.userid = pl.userid
                 WHERE pa.id IS NULL
                       AND p.archived = 0 AND f.archived = 0 AND pl.draft = 0 AND pl.archived = 0
                       AND pl.timestart < :now1 AND (pl.timeend IS NULL OR pl.timeend > :now2)
                       $userselect
              ORDER BY pl.timestart ASC, pl.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $plan) {
            $timedue = $plan->itemtimedue ?? $plan->timedue;
            unset($plan->itemtimedue);
            $source = $DB->get_record('enrol_programs_sources', ['id' => $plan->sourceid]);
            unset($plan->sourceid);
            $program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid]);
            if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $plan->userid])) {
                // User must have multiple plans, this is not the first one.
                continue;
            }
            $dateoverrides = [
                'timestart' => $plan->timestart,
                'timedue' => $timedue,
                'timeend' => $plan->timeend,
            ];
            self::allocate_user($program, $source, $plan->userid, [], $dateoverrides, $plan->id);
            \enrol_programs\local\allocation::fix_user_enrolments($program->id, $plan->userid);
            \enrol_programs\local\notification_manager::trigger_notifications($program->id, $plan->userid);
        }
        $rs->close();

        // Archive allocations that are not supposed to be active or are orphaned.
        $params = [];
        $userselect = "";
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT pa.*
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_sources} ps ON ps.id = pa.sourceid AND ps.type = 'udplans'
             LEFT JOIN {tool_udplans_plans} pl ON pl.id = pa.sourceinstanceid AND pl.userid = pa.userid
             LEFT JOIN {tool_udplans_items} pi ON pi.planid = pl.id AND pi.itemtype = 'program' AND pi.instanceid = pa.programid
             LEFT JOIN {tool_udplans_frameworks} f ON f.id = pl.frameworkid
                 WHERE pa.archived = 0
                       AND (f.id IS NULL OR pl.id IS NULL OR pi.id IS NULL OR pl.archived = 1 OR f.archived = 1)
                       $userselect
              ORDER BY pa.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $pa) {
            $pa->archived = 1;
            \enrol_programs\local\allocation::update_user($pa);
        }
        $rs->close();

        // Update dates and restore if necessary.
        $params = [];
        $userselect = "";
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        }
        $sql = "SELECT pa.*, pl.timestart, COALESCE(pi.timedue, pl.timedue) AS timedue, pl.timeend
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_sources} ps ON ps.id = pa.sourceid AND ps.type = 'udplans'
                  JOIN {tool_udplans_plans} pl ON pl.id = pa.sourceinstanceid AND pl.userid = pa.userid AND pl.archived = 0
                  JOIN {tool_udplans_frameworks} f ON f.id = pl.frameworkid AND f.archived = 0
                  JOIN {tool_udplans_items} pi ON pi.planid = pl.id AND pi.itemtype = 'program' AND pi.instanceid = pa.programid
                 WHERE (
                            (pa.archived = 1)
                            OR (pl.timestart <> pa.timestart)
                            OR (COALESCE(pi.timedue, pl.timedue) IS NULL AND pa.timedue IS NOT NULL)
                            OR (COALESCE(pi.timedue, pl.timedue) IS NOT NULL AND pa.timedue IS NULL)
                            OR (COALESCE(pi.timedue, pl.timedue) <> pa.timedue) 
                            OR (pl.timeend IS NULL AND pa.timeend IS NOT NULL)
                            OR (pl.timeend IS NOT NULL AND pa.timeend IS NULL)
                            OR (pl.timeend <> pa.timeend) 
                       ) $userselect
              ORDER BY pa.id ASC";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $pa) {
            $pa->archived = 0;
            \enrol_programs\local\allocation::update_user($pa);
        }
        $rs->close();
    }
}
