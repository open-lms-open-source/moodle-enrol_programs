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

use stdClass;

/**
 * Programs notification manager.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class notification_manager extends \local_openlms\notification\manager {
    /**
     * Returns list of all notifications in plugin.
     *
     * @return array of PHP class names with notificationtype as keys
     */
    public static function get_all_types(): array {
        // Note: order here affects cron task execution.
        return [
            'allocation' => notification\allocation::class,
            'start' => notification\start::class,
            'completion' => notification\completion::class,
            'duesoon' => notification\duesoon::class,
            'due' => notification\due::class,
            'endsoon' => notification\endsoon::class,
            'endcompleted' => notification\endcompleted::class,
            'endfailed' => notification\endfailed::class,
            'deallocation' => notification\deallocation::class,
        ];
    }

    /**
     * Returns list of candidate types for adding of new notifications.
     *
     * @return array of type names with notificationtype as keys
     */
    public static function get_candidate_types(int $instanceid): array {
        global $DB;

        $types = self::get_all_types();

        $existing = $DB->get_records('local_openlms_notifications',
            ['component' => 'enrol_programs', 'instanceid' => $instanceid]);
        foreach ($existing as $notification) {
            unset($types[$notification->notificationtype]);
        }

        /** @var class-string<notification\base> $classname */
        foreach ($types as $type => $classname) {
            $types[$type] = $classname::get_name();
        }

        return $types;
    }

    /**
     * Returns context of instance for notifications.
     *
     * @param int $instanceid
     * @return null|\context
     */
    public static function get_instance_context(int $instanceid): ?\context {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $instanceid]);
        if (!$program) {
            return null;
        }

        return \context::instance_by_id($program->contextid);
    }

    /**
     * Can the current user view instance notifications?
     *
     * @param int $instanceid
     * @return bool
     */
    public static function can_view(int $instanceid): bool {
        global $DB;
        $program = $DB->get_record('enrol_programs_programs', ['id' => $instanceid]);
        if (!$program) {
            return false;
        }

        $context = \context::instance_by_id($program->contextid);
        return has_capability('enrol/programs:view', $context);
    }

    /**
     * Can the current user add/update/delete instance notifications?
     *
     * @param int $instanceid
     * @return bool
     */
    public static function can_manage(int $instanceid): bool {
        global $DB;
        $program = $DB->get_record('enrol_programs_programs', ['id' => $instanceid]);
        if (!$program) {
            return false;
        }

        $context = \context::instance_by_id($program->contextid);
        return has_capability('enrol/programs:edit', $context);
    }

    /**
     * Returns name of instance for notifications.
     *
     * @param int $instanceid
     * @return string|null
     */
    public static function get_instance_name(int $instanceid): ?string {
        global $DB;
        $program = $DB->get_record('enrol_programs_programs', ['id' => $instanceid]);
        if (!$program) {
            return null;
        }
        return format_string($program->fullname);
    }

    /**
     * Returns url of UI that shows all plugin notifications for given instance id.
     *
     * @param int $instanceid
     * @return \moodle_url|null
     */
    public static function get_instance_management_url(int $instanceid): ?\moodle_url {
        global $DB;
        $program = $DB->get_record('enrol_programs_programs', ['id' => $instanceid]);
        if (!$program) {
            return null;
        }

        $context = \context::instance_by_id($program->contextid);
        if (!has_capability('enrol/programs:view', $context)) {
            return null;
        }

        return new \moodle_url('/enrol/programs/management/program_notifications.php', ['id' => $program->id]);
    }

    /**
     * Set up notification/view.php page.
     *
     * @param \stdClass $notification
     * @return void
     */
    public static function setup_view_page(\stdClass $notification): void {
        global $PAGE, $DB, $OUTPUT;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $notification->instanceid]);
        if (!$program) {
            return;
        }

        $context = \context::instance_by_id($program->contextid);
        $manageurl = self::get_instance_management_url($notification->instanceid);

        management::setup_program_page($manageurl, $context, $program);
        $PAGE->set_url('/local/openlms/notification/view.php', ['id' => $notification->id]);

        echo $OUTPUT->header();
        echo $OUTPUT->heading(format_string($program->fullname));

        /** @var \enrol_programs\output\management\renderer $managementoutput */
        $managementoutput = $PAGE->get_renderer('enrol_programs', 'management');

        echo $managementoutput->render_management_program_tabs($program, 'notifications');
    }

    /**
     * Send notifications.
     *
     * @param int|null $programid
     * @param int|null $userid
     * @return void
     */
    public static function trigger_notifications(?int $programid, ?int $userid): void {
        global $DB;

        if (!enrol_is_enabled('programs')) {
            return;
        }

        $program = null;
        if ($programid) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
            if ($program->archived) {
                return;
            }
        }

        $user = null;
        if ($userid) {
            $user = $DB->get_record('user', ['id' => $userid], '*', MUST_EXIST);
            if ($user->deleted || $user->suspended) {
                return;
            }
        }

        $types = static::get_all_types();

        /** @var class-string<notification\base> $classname */
        foreach ($types as $classname) {
            $classname::notify_users($program, $user);
        }
    }

    /**
     * To be called when deleting program allocation.
     *
     * @param \stdClass $allocation
     * @return void
     */
    public static function delete_allocation_notifications(\stdClass $allocation) {
        global $DB;

        $notifications = $DB->get_records('local_openlms_notifications',
            ['component' => 'enrol_programs', 'instanceid' => $allocation->programid]);
        foreach ($notifications as $notification) {
            /** @var class-string<notification\base> $classname */
            $classname = static::get_classname($notification->notificationtype);
            if (!$classname) {
                continue;
            }
            $classname::delete_allocation_notifications($allocation);
        }
    }

    /**
     * To be called when deleting program.
     *
     * @param \stdClass $program
     * @return void
     */
    public static function delete_program_notifications(\stdClass $program) {
        global $DB;

        $notifications = $DB->get_records('local_openlms_notifications',
            ['component' => 'enrol_programs', 'instanceid' => $program->id]);
        foreach ($notifications as $notification) {
            \local_openlms\notification\util::notification_delete($notification->id);
        }
    }

    /**
     * Returns last notification time for given user in program.
     *
     * @param int $userid
     * @param int $programid
     * @param string $notificationtype
     * @return int|null
     */
    public static function get_timenotified(int $userid, int $programid, string $notificationtype): ?int {
        global $DB;

        $params = ['programid' => $programid, 'userid' => $userid, 'type' => $notificationtype];
        $sql = "SELECT MAX(un.timenotified)
                  FROM {enrol_programs_allocations} pa
                  JOIN {enrol_programs_programs} p ON p.id = pa.programid
                  JOIN {local_openlms_notifications} n
                       ON n.component = 'enrol_programs' AND n.notificationtype = :type AND n.instanceid = p.id
                  JOIN {local_openlms_user_notified} un
                       ON un.notificationid = n.id AND un.userid = pa.userid AND un.otherid1 = pa.id
                 WHERE p.id = :programid AND pa.userid = :userid";
        return $DB->get_field_sql($sql, $params);
    }
}
