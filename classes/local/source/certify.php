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

use tool_certify\local\certification;
use stdClass;

/**
 * Program allocation for certifications from tool_certify.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class certify extends base {
    /**
     * Returns short type name of source.
     *
     * @return string
     */
    public static function get_type(): string {
        return 'certify';
    }

    /**
     * Certification allocation is possible only if tool_certify is present and active.
     *
     * @param stdClass $program
     * @return bool
     */
    public static function is_new_allowed(\stdClass $program): bool {
        return true;
    }

    /**
     * Allocation is controlled by tool_certify.
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
            // Allow manual deallocation after certification window closes.
            return true;
        }
        return false;
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
            $sql = "SELECT c.*
                      FROM {tool_certify_certifications} c
                      JOIN {enrol_programs_sources} s ON s.id = :sourceid AND (c.programid1 = s.programid OR c.programid2 = s.programid)
                  ORDER BY c.fullname ASC";
            $certifications = $DB->get_records_sql($sql, $params);
            if ($certifications) {
                foreach ($certifications as $k => $certification) {
                    $name = format_string($certification->fullname);
                    $certcontext = \context::instance_by_id($certification->contextid, IGNORE_MISSING);
                    if ($certcontext && has_capability('tool/certify:view', $certcontext)) {
                        $viewurl = new \moodle_url('/admin/tool/certify/management/certification.php', ['id' => $certification->id]);
                        $name = \html_writer::link($viewurl, $name);
                    }
                    $certifications[$k] = $name;
                }
                $result .= ' - ' . implode(', ', $certifications);
            }
        }

        return $result;
    }

    /**
     * Purge course data using privacy API.
     *
     * @param int[] $courseids
     * @param int $userid
     * @return void
     */
    public static function purge_courses(array $courseids, int $userid): void {
        global $DB;

        $user = $DB->get_record('user', ['id' => $userid], '*', MUST_EXIST);

        $modcontextids = [];
        $cmids = [];
        foreach ($courseids as $courseid) {
            $mods = get_course_mods($courseid);
            if (!$mods) {
                continue;
            }
            foreach ($mods as $cm) {
                $modcontext = \context_module::instance($cm->id, IGNORE_MISSING);
                if (!$modcontext) {
                    continue;
                }
                $cmids[$courseid][] = $cm->id;
                $modcontextids[$cm->modname][] = $modcontext->id;
            }
        }

        // Use all activity privacy providers.
        foreach (array_keys(\core_component::get_plugin_list('mod')) as $name) {
            if (!isset($modcontextids[$name])) {
                continue;
            }
            $list = new \core_privacy\local\request\approved_contextlist($user, 'tool_certify', $modcontextids[$name]);
            $privacyclass = 'mod_' . $name . '\\privacy\provider';
            if (!class_exists($privacyclass)) {
                continue;
            }
            // Why is there no interface with this method in privacy API?
            if (!method_exists($privacyclass, 'delete_data_for_user')) {
                continue;
            }
            try {
                $privacyclass::delete_data_for_user($list);
            } catch (\Throwable $ex) {
                debugging("Exception detected in $privacyclass::delete_data_for_user(): " . $ex->getMessage(),
                    DEBUG_DEVELOPER, $ex->getTrace());
            }
        }

        // Finally delete all types of completions.
        foreach ($courseids as $courseid) {
            if (isset($cmids[$courseid])) {
                foreach ($cmids[$courseid] as $cmid) {
                    \core_completion\privacy\provider::delete_completion($user, null, $cmid);
                }
            }
            \core_completion\privacy\provider::delete_completion($user, $courseid, null);
        }
    }

    /**
     * Sync certification periods with program allocations.
     *
     * @param int|null $certificationid
     * @param int|null $userid
     * @return void
     */
    public static function sync_certifications(?int $certificationid, ?int $userid): void {
        global $DB;

        if (!PHPUNIT_TEST && !$userid && $DB->is_transaction_started()) {
            debugging('assignment::fix_program_allocations() is not supposed to be used in transactions without userid', DEBUG_DEVELOPER);
        }

        $coursceclasses = \enrol_programs\local\allocation::get_source_classes();

        // Archive allocations for historic, deleted, revoked and archived periods.
        $params = [];
        $params['now2'] = $params['now1'] = time();
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        } else {
            $userselect = '';
        }
        if ($certificationid) {
            $certificationselect = "AND pa.sourceinstanceid = :certificationid";
            $params['certificationid'] = $certificationid;
        } else {
            $certificationselect = '';
        }
        $sql = "SELECT pa.*
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
             LEFT JOIN {tool_certify_periods} cp ON cp.allocationid = pa.id
             LEFT JOIN {tool_certify_assignments} ca ON ca.certificationid = cp.certificationid AND ca.userid = cp.userid
             LEFT JOIN {tool_certify_certifications} c ON c.id = cp.certificationid
                  JOIN {enrol_programs_sources} ps ON ps.programid = p.id AND ps.type = 'certify'
                 WHERE pa.archived = 0
                       AND (
                            cp.id IS NULL
                            OR cp.timerevoked IS NOT NULL
                            OR ca.id IS NULL
                            OR ca.archived = 1
                            OR c.archived = 1
                            OR (cp.timewindowend < :now1)
                            OR (cp.timeuntil < :now2)
                       )
                       $userselect $certificationselect
              ORDER BY pa.id ASC";
        $allocations = $DB->get_records_sql($sql, $params);
        foreach ($allocations as $allocation) {
            $DB->set_field('enrol_programs_allocations', 'archived', 1, ['id' => $allocation->id]);
            \enrol_programs\local\allocation::make_snapshot($allocation->id, 'allocation_sync');
            \enrol_programs\local\allocation::fix_user_enrolments($allocation->programid, $allocation->userid);
        }
        unset($allocations);

        // Restore incorrectly archived users.
        $params = [];
        $params['now2'] = $params['now1'] = time();
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        } else {
            $userselect = '';
        }
        if ($certificationid) {
            $certificationselect = "AND pa.sourceinstanceid = :certificationid";
            $params['certificationid'] = $certificationid;
        } else {
            $certificationselect = '';
        }
        $sql = "SELECT pa.*
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {tool_certify_periods} cp ON cp.allocationid = pa.id
                  JOIN {tool_certify_assignments} ca ON ca.certificationid = cp.certificationid AND ca.userid = cp.userid
                  JOIN {tool_certify_certifications} c ON c.id = cp.certificationid
                  JOIN {enrol_programs_sources} ps ON ps.programid = p.id AND ps.type = 'certify'
                 WHERE pa.archived = 1
                       AND cp.timerevoked IS NULL AND ca.archived = 0 AND c.archived = 0 AND p.archived = 0
                       AND (cp.timewindowend IS NULL OR cp.timewindowend > :now1)
                       AND (cp.timeuntil IS NULL OR cp.timeuntil > :now2)
                       $userselect $certificationselect
              ORDER BY pa.id ASC";
        $allocations = $DB->get_records_sql($sql, $params);
        foreach ($allocations as $allocation) {
            $period = $DB->get_record('tool_certify_periods', ['allocationid' => $allocation->id]);
            if (!$period) {
                continue;
            }
            $record = new stdClass();
            $record->id = $allocation->id;
            $record->archived = 0;
            $record->timestart = $period->timewindowstart;
            $record->timedue = $period->timewindowdue;
            $record->timeend = $period->timewindowend;
            $DB->update_record('enrol_programs_allocations', $record);
            \enrol_programs\local\allocation::make_snapshot($allocation->id, 'allocation_sync');
            \enrol_programs\local\allocation::fix_user_enrolments($allocation->programid, $allocation->userid);
        }
        unset($allocations);

        // Sync program dates.
        $params = [];
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        } else {
            $userselect = '';
        }
        if ($certificationid) {
            $certificationselect = "AND pa.sourceinstanceid = :certificationid";
            $params['certificationid'] = $certificationid;
        } else {
            $certificationselect = '';
        }
        $sql = "SELECT pa.*
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {tool_certify_periods} cp ON cp.allocationid = pa.id
                  JOIN {tool_certify_assignments} ca ON ca.certificationid = cp.certificationid AND ca.userid = cp.userid
                  JOIN {tool_certify_certifications} c ON c.id = cp.certificationid
                  JOIN {enrol_programs_sources} ps ON ps.programid = p.id AND ps.type = 'certify'
                 WHERE pa.archived = 0 AND p.archived = 0
                       AND (
                           (pa.timestart <> cp.timewindowstart)
                           OR (pa.timedue IS NULL AND cp.timewindowdue IS NOT NULL)
                           OR (pa.timedue IS NOT NULL AND cp.timewindowdue IS NULL)
                           OR (pa.timedue <> cp.timewindowdue)
                           OR (pa.timeend IS NULL AND cp.timewindowend IS NOT NULL)
                           OR (pa.timeend IS NOT NULL AND cp.timewindowend IS NULL)
                           OR (pa.timeend <> cp.timewindowend)
                       )
                       $userselect $certificationselect
              ORDER BY pa.id ASC";
        $allocations = $DB->get_records_sql($sql, $params);
        foreach ($allocations as $allocation) {
            $period = $DB->get_record('tool_certify_periods', ['allocationid' => $allocation->id]);
            if (!$period) {
                continue;
            }
            $record = new stdClass();
            $record->id = $allocation->id;
            $record->timestart = $period->timewindowstart;
            $record->timedue = $period->timewindowdue;
            $record->timeend = $period->timewindowend;
            $DB->update_record('enrol_programs_allocations', $record);
            \enrol_programs\local\allocation::make_snapshot($allocation->id, 'allocation_sync');
            \enrol_programs\local\allocation::fix_user_enrolments($allocation->programid, $allocation->userid);
        }
        unset($allocations);

        // Allocate users to programs in active windows.
        $params = [];
        $params['now2'] = $params['now1'] = time();
        $params['soon'] = $params['now1'] + (HOURSECS * 2); // This should be twice the recommended cron period.
        if ($userid) {
            $userselect = "AND u.id = :userid";
            $params['userid'] = $userid;
        } else {
            $userselect = '';
        }
        if ($certificationid) {
            $certificationselect = "AND c.id = :certificationid";
            $params['certificationid'] = $certificationid;
        } else {
            $certificationselect = '';
        }
        $sql = "SELECT cp.id
                  FROM {tool_certify_periods} cp
                  JOIN {user} u ON u.id = cp.userid AND u.deleted = 0 AND u.confirmed = 1
                  JOIN {tool_certify_certifications} c ON c.id = cp.certificationid
                  JOIN {tool_certify_assignments} ca ON ca.userid = u.id AND ca.certificationid = c.id
                  JOIN {enrol_programs_programs} p ON p.id = cp.programid
                  JOIN {enrol_programs_sources} ps ON ps.programid = p.id AND ps.type = 'certify'
                 WHERE c.archived = 0 AND ca.archived = 0 AND p.archived = 0
                       AND cp.allocationid IS NULL AND cp.timecertified IS NULL AND cp.timerevoked IS NULL
                       AND cp.timewindowstart < :soon
                       AND (cp.timewindowend IS NULL OR cp.timewindowend > :now1)
                       AND (cp.timeuntil IS NULL OR cp.timeuntil > :now2)
                       $userselect $certificationselect
              ORDER BY cp.id ASC";
        $periods = $DB->get_records_sql($sql, $params);
        foreach ($periods as $period) {
            // Always load current data, this loop may take a long time, this could run in parallel.
            $period = $DB->get_record('tool_certify_periods', ['id' => $period->id]);
            if (!$period || isset($period->allocationid)) {
                continue;
            }
            $certification = $DB->get_record('tool_certify_certifications', ['id' => $period->certificationid], '*', MUST_EXIST);
            $settings = \tool_certify\local\certification::get_periods_settings($certification);

            $program = $DB->get_record('enrol_programs_programs', ['id' => $period->programid], '*', MUST_EXIST);
            $allocation = $DB->get_record('enrol_programs_allocations', ['userid' => $period->userid, 'programid' => $period->programid]);

            if ($period->first) {
                $resettype = $settings->resettype1;
            } else {
                $resettype = $settings->resettype2;
            }

            if ($resettype == certification::RESETTYPE_NONE && $allocation) {
                // Do not retry allocation.
                $DB->set_field('tool_certify_periods', 'allocationid', 0, ['id' => $period->id]);
                continue;
            }

            if ($resettype >= certification::RESETTYPE_DEALLOCATE && $allocation) {
                $delsource = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid], '*', MUST_EXIST);
                /** @var \enrol_programs\local\source\base $coursceclass */
                $coursceclass = $coursceclasses[$delsource->type];
                $coursceclass::deallocate_user($program, $delsource, $allocation, true);
            }

            if ($resettype >= certification::RESETTYPE_UNENROL) {
                // Force deleting of course enrolments - even if protected by enrol plugins!
                $sql = "SELECT DISTINCT ue.*
                          FROM {enrol_programs_items} i
                          JOIN {course} c ON c.id = i.courseid
                          JOIN {enrol} e ON e.courseid = c.id   
                          JOIN {user_enrolments} ue ON ue.enrolid = e.id
                         WHERE i.programid = :programid AND ue.userid = :userid
                      ORDER BY ue.id ASC";
                $ues = $DB->get_records_sql($sql, ['programid' => $program->id, 'userid' => $period->userid]);
                foreach ($ues as $ue) {
                    $instance = $DB->get_record('enrol', ['id' => $ue->enrolid], '*', MUST_EXIST);
                    $enrolplugin = enrol_get_plugin($instance->enrol);
                    if (!$enrolplugin) {
                        $instance->enrol = 'manual'; // Hack to work around missing enrol plugins.
                        $enrolplugin = enrol_get_plugin('manual');
                    }
                    $enrolplugin->unenrol_user($instance, $ue->userid);
                }
            }

            if ($resettype >= certification::RESETTYPE_PURGE) {
                $sql = "SELECT DISTINCT c.id
                          FROM {enrol_programs_items} i
                          JOIN {course} c ON c.id = i.courseid
                         WHERE i.programid = :programid
                      ORDER BY c.id ASC";
                $courseids = $DB->get_fieldset_sql($sql, ['programid' => $program->id]);
                if ($courseids) {
                    self::purge_courses($courseids, $userid);
                }
            }

            $allocation = $DB->get_record('enrol_programs_allocations', ['userid' => $period->userid, 'programid' => $period->programid]);
            if ($allocation) {
                // Something is wrong, probably some automatic allocation source messing this up, oh well.
                debugging("Failed resetting allocation for certification period $period->id", DEBUG_DEVELOPER);
                $DB->set_field('tool_certify_periods', 'allocationid', 0, ['id' => $period->id]);
                continue;
            }

            // Finally allocate user to program.
            $source = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => 'certify'], '*', MUST_EXIST);
            $dateoverrides = [
                'timestart' => $period->timewindowstart,
                'timedue' => $period->timewindowdue,
                'timeend' => $period->timewindowend,
            ];
            $allocation = self::allocate_user($program, $source, $period->userid, [], $dateoverrides, $certification->id);
            $DB->set_field('tool_certify_periods', 'allocationid', $allocation->id, ['id' => $period->id]);
            \enrol_programs\local\allocation::fix_user_enrolments($program->id, $period->userid);
        }
        unset($periods);

        // Sync skipped program completions if necessary.
        $params = [];
        $params['now3'] = $params['now2'] = $params['now1'] = time();
        if ($userid) {
            $userselect = "AND pa.userid = :userid";
            $params['userid'] = $userid;
        } else {
            $userselect = '';
        }
        if ($certificationid) {
            $certificationselect = "AND pa.sourceinstanceid = :certificationid";
            $params['certificationid'] = $certificationid;
        } else {
            $certificationselect = '';
        }
        $sql = "SELECT pa.id
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {tool_certify_periods} cp ON cp.allocationid = pa.id
                  JOIN {tool_certify_assignments} ca ON ca.certificationid = cp.certificationid AND ca.userid = cp.userid
                  JOIN {tool_certify_certifications} c ON c.id = cp.certificationid
                  JOIN {enrol_programs_sources} ps ON ps.programid = p.id AND ps.type = 'certify'
                 WHERE pa.archived = 0 AND ca.archived = 0 AND c.archived = 0 AND p.archived = 0
                       AND pa.timecompleted IS NOT NULL
                       AND cp.timecertified IS NULL AND cp.timerevoked IS NULL
                       AND (cp.timewindowend IS NULL OR cp.timewindowend > :now1)
                       AND (cp.timeuntil IS NULL OR cp.timeuntil > :now2)
                       AND cp.timewindowstart < :now3
                       $userselect $certificationselect
              ORDER BY pa.id ASC";
        $allocations = $DB->get_records_sql($sql, $params);
        foreach ($allocations as $allocation) {
            $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $allocation->id]);
            if (!$allocation || !isset($allocation->timecompleted) || $allocation->archived) {
                continue;
            }
            $period = $DB->get_record('tool_certify_periods', ['allocationid' => $allocation->id]);
            if (!$period || isset($period->timecertified)) {
                continue;
            }
            $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
            if (!$program) {
                continue;
            }
            \tool_certify\local\period::program_completed($program, $allocation);
        }
        unset($allocations);
    }

    /**
     * Internal - to be called only from \tool_certify\local\source\base::unassign_user() method.
     * @param stdClass $allocation
     * @return void
     */
    public static function user_unassigned(stdClass $allocation): void {
        global $DB;

        $DB->set_field('enrol_prgrams_allocations', 'archived', '1', ['id' => $allocation->id]);
        \enrol_programs\local\allocation::fix_user_enrolments($allocation->programid, $allocation->userid);
    }

    /**
     * Render allocation source information.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return string HTML fragment
     */
    public static function render_allocation_source(stdClass $program, stdClass $source, stdClass $allocation): string {
        global $DB, $USER;

        $type = static::get_type();

        if ($source && $source->type !== $type) {
            throw new \coding_exception('Invalid source type');
        }

        $period = $DB->get_record('tool_certify_periods', ['allocationid' => $allocation->id]);
        if ($period) {
            $certification = $DB->get_record('tool_certify_certifications', ['id' => $period->certificationid]);
            $cname = format_string($certification->fullname);
            if ($period->userid == $USER->id) {
                $curl = new \moodle_url('/admin/tool/certify/my/certification.php', ['id' => $certification->id]);
                return \html_writer::link($curl, $cname);
            }
            $context = \context::instance_by_id($certification->contextid, IGNORE_MISSING);
            if ($context && has_capability('tool/certify:view' , $context)) {
                $curl = new \moodle_url('/admin/tool/certify/management/certification.php', ['id' => $certification->id]);
                return \html_writer::link($curl, $cname);
            }
        }

        return static::get_name();
    }
}
