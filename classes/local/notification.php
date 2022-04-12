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

use moodle_url, stdClass;

/**
 * Program notification helper.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class notification {
    /** @var int "soon" means in 3 days from now */
    public const TIME_SOON = (60 * 60 * 24 * 3);

    /** @var int any due notification that was missed by more than 2 days is ignored */
    public const TIME_CUTOFF = (60 * 60 * 24 * 2);

    public static function get_standard_placeholders(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): stdClass {
        /** @var source\base[] $sourceclasses */
        $sourceclasses = allocation::get_source_classes();
        if (isset($sourceclasses[$source->type])) {
            $classname = $sourceclasses[$source->type];
            $sourcename = $classname::get_name();
        } else {
            $sourcename = get_string('error');
        }

        if ($program->id != $source->programid || $source->id != $allocation->sourceid || $user->id != $allocation->userid) {
            throw new \coding_exception('invalid parameter mix');
        }

        $strnotset = get_string('notset', 'enrol_programs');

        $a = new stdClass();
        $a->user_fullname = s(fullname($user));
        $a->user_firstname = s($user->firstname);
        $a->user_lastname = s($user->lastname);
        $a->program_fullname = format_string($program->fullname);
        $a->program_idnumber = s($program->idnumber);
        $a->program_url = (new moodle_url('/enrol/programs/my/program.php', ['id' => $program->id]))->out(false);
        $a->program_sourcename = $sourcename;
        $a->program_status = allocation::get_completion_status_plain($program, $allocation);
        $a->program_allocationdate = userdate($allocation->timeallocated);
        $a->program_startdate = userdate($allocation->timestart);
        $a->program_duedate = (isset($allocation->timedue) ? userdate($allocation->timedue) : $strnotset);
        $a->program_enddate = (isset($allocation->timeend) ? userdate($allocation->timeend) : $strnotset);
        $a->program_completeddate = (isset($allocation->timecompleted) ? userdate($allocation->timecompleted) : $strnotset);

        // NOTE: it would be good to come up with some course list visualisation.

        return $a;
    }

    public static function get_notifier(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): stdClass {
        // NOTE: pick somebody from tenant if necessary, we could also add program contact.
        return get_admin();
    }

    public static function notify_start(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifystart) {
            return;
        }

        if ($user->deleted) {
            return;
        }

        $oldforcelang = force_current_language($user->lang);

        $a = self::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string('notification_start_subject', 'enrol_programs', $a);
        $body = get_string('notification_start_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'start_notification';
        $message->userfrom = self::get_notifier($program, $source, $allocation, $user);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $allocation->timenotifiedstart = (string)time();
            $DB->set_field('enrol_programs_allocations', 'timenotifiedstart', $allocation->timenotifiedstart, ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    public static function notify_completed(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifycompleted) {
            return;
        }

        if ($user->deleted) {
            return;
        }

        $oldforcelang = force_current_language($user->lang);

        $a = self::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string('notification_completion_subject', 'enrol_programs', $a);
        $body = get_string('notification_completion_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'completion_notification';
        $message->userfrom = self::get_notifier($program, $source, $allocation, $user);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $allocation->timenotifiedcompleted = (string)time();
            $DB->set_field('enrol_programs_allocations', 'timenotifiedcompleted', $allocation->timenotifiedcompleted, ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    public static function notify_duesoon(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifyduesoon) {
            return;
        }

        if ($user->deleted) {
            return;
        }

        $oldforcelang = force_current_language($user->lang);

        $a = self::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string('notification_duesoon_subject', 'enrol_programs', $a);
        $body = get_string('notification_duesoon_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'duesoon_notification';
        $message->userfrom = self::get_notifier($program, $source, $allocation, $user);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $allocation->timenotifiedduesoon = (string)time();
            $DB->set_field('enrol_programs_allocations', 'timenotifiedduesoon', $allocation->timenotifiedduesoon, ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    public static function notify_due(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifydue) {
            return;
        }

        if ($user->deleted) {
            return;
        }

        $oldforcelang = force_current_language($user->lang);

        $a = self::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string('notification_due_subject', 'enrol_programs', $a);
        $body = get_string('notification_due_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'due_notification';
        $message->userfrom = self::get_notifier($program, $source, $allocation, $user);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $allocation->timenotifieddue = (string)time();
            $DB->set_field('enrol_programs_allocations', 'timenotifieddue', $allocation->timenotifieddue, ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    public static function notify_endsoon(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifyendsoon) {
            return;
        }

        if ($user->deleted) {
            return;
        }

        $oldforcelang = force_current_language($user->lang);

        $a = self::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string('notification_endsoon_subject', 'enrol_programs', $a);
        $body = get_string('notification_endsoon_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'endsoon_notification';
        $message->userfrom = self::get_notifier($program, $source, $allocation, $user);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $allocation->timenotifiedendsoon = (string)time();
            $DB->set_field('enrol_programs_allocations', 'timenotifiedendsoon', $allocation->timenotifiedendsoon, ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    public static function notify_endcompleted(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifyendcompleted) {
            return;
        }

        if ($user->deleted) {
            return;
        }

        $oldforcelang = force_current_language($user->lang);

        $a = self::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string('notification_endcompleted_subject', 'enrol_programs', $a);
        $body = get_string('notification_endcompleted_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'endcompleted_notification';
        $message->userfrom = self::get_notifier($program, $source, $allocation, $user);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $allocation->timenotifiedendcompleted = (string)time();
            $DB->set_field('enrol_programs_allocations', 'timenotifiedendcompleted', $allocation->timenotifiedendcompleted, ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    public static function notify_endfailed(stdClass $program, stdClass $source, stdClass $allocation, stdClass $user): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifyendfailed) {
            return;
        }

        if ($user->deleted) {
            return;
        }

        $oldforcelang = force_current_language($user->lang);

        $a = self::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string('notification_endfailed_subject', 'enrol_programs', $a);
        $body = get_string('notification_endfailed_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'endfailed_notification';
        $message->userfrom = self::get_notifier($program, $source, $allocation, $user);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $allocation->timenotifiedendfailed = (string)time();
            $DB->set_field('enrol_programs_allocations', 'timenotifiedendfailed', $allocation->timenotifiedendfailed, ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    /**
     * Send out all missed notifications since "now minus cut-off".
     *
     * NOTE: if cron is not running then some notifications might not be sent at all.
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

        if ($programid) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
            if ($program->archived) {
                return;
            }
        } else {
            $program = null;
        }
        $source = null;
        $user = null;

        $loadfunction = function(stdClass $allocation) use (&$program, &$source, &$user): void {
            global $DB;
            if (!$source || $source->id != $allocation->sourceid) {
                $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid], '*', MUST_EXIST);
            }
            if (!$user || $user->id != $allocation->userid) {
                $user = $DB->get_record('user', ['id' => $allocation->userid], '*', MUST_EXIST);
            }
            if (!$program || $program->id != $source->programid) {
                $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid], '*', MUST_EXIST);
            }
        };

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
        $params['now'] = time();
        $params['cutoff'] = $params['now'] - self::TIME_CUTOFF;
        $params['soon'] = $params['now'] + self::TIME_SOON;

        if (!$programid || $program->id != $programid || $program->notifystart) {
            $sql = "SELECT pa.*
                      FROM {enrol_programs_allocations} pa
                      JOIN {enrol_programs_sources} s ON s.id = pa.sourceid
                      JOIN {enrol_programs_programs} p ON p.id = pa.programid
                     WHERE p.archived = 0 AND pa.archived = 0 AND p.notifystart = 1
                           $programselect $userselect
                           AND pa.timenotifiedstart IS NULL AND pa.timestart <= :now AND pa.timestart > :cutoff
                  ORDER BY p.id, s.id, pa.userid";
            $rs = $DB->get_recordset_sql($sql, $params);
            foreach ($rs as $allocation) {
                $loadfunction($allocation);
                self::notify_start($program, $source, $allocation, $user);
            }
            $rs->close();
        }

        if (!$programid || $program->id != $programid || $program->notifycompleted) {
            $sql = "SELECT pa.*
                      FROM {enrol_programs_allocations} pa
                      JOIN {enrol_programs_sources} s ON s.id = pa.sourceid
                      JOIN {enrol_programs_programs} p ON p.id = pa.programid
                     WHERE p.archived = 0 AND pa.archived = 0 AND p.notifycompleted = 1 AND pa.timecompleted IS NOT NULL
                           $programselect $userselect
                           AND pa.timenotifiedcompleted IS NULL AND pa.timecompleted <= :now AND pa.timecompleted > :cutoff
                  ORDER BY p.id, s.id, pa.userid";
            $rs = $DB->get_recordset_sql($sql, $params);
            foreach ($rs as $allocation) {
                $loadfunction($allocation);
                self::notify_completed($program, $source, $allocation, $user);
            }
            $rs->close();
        }

        if (!$programid || $program->id != $programid || $program->notifyduesoon) {
            $sql = "SELECT pa.*
                      FROM {enrol_programs_allocations} pa
                      JOIN {enrol_programs_sources} s ON s.id = pa.sourceid
                      JOIN {enrol_programs_programs} p ON p.id = pa.programid
                     WHERE p.archived = 0 AND pa.archived = 0 AND p.notifyduesoon = 1 AND pa.timecompleted IS NULL
                           $programselect $userselect
                           AND pa.timenotifiedduesoon IS NULL AND pa.timedue > :now AND pa.timedue < :soon
                  ORDER BY p.id, s.id, pa.userid";
            $rs = $DB->get_recordset_sql($sql, $params);
            foreach ($rs as $allocation) {
                $loadfunction($allocation);
                self::notify_duesoon($program, $source, $allocation, $user);
            }
            $rs->close();
        }

        if (!$programid || $program->id != $programid || $program->notifydue) {
            $sql = "SELECT pa.*
                      FROM {enrol_programs_allocations} pa
                      JOIN {enrol_programs_sources} s ON s.id = pa.sourceid
                      JOIN {enrol_programs_programs} p ON p.id = pa.programid
                     WHERE p.archived = 0 AND pa.archived = 0 AND p.notifydue = 1 AND pa.timecompleted IS NULL
                           $programselect $userselect
                           AND pa.timenotifieddue IS NULL AND pa.timedue <= :now AND pa.timedue > :cutoff
                  ORDER BY p.id, s.id, pa.userid";
            $rs = $DB->get_recordset_sql($sql, $params);
            foreach ($rs as $allocation) {
                $loadfunction($allocation);
                self::notify_due($program, $source, $allocation, $user);
            }
            $rs->close();
        }

        if (!$programid || $program->id != $programid || $program->notifyendsoon) {
            $sql = "SELECT pa.*
                      FROM {enrol_programs_allocations} pa
                      JOIN {enrol_programs_sources} s ON s.id = pa.sourceid
                      JOIN {enrol_programs_programs} p ON p.id = pa.programid
                     WHERE p.archived = 0 AND pa.archived = 0 AND p.notifyendsoon = 1 AND pa.timecompleted IS NULL
                           $programselect $userselect
                           AND pa.timenotifiedendsoon IS NULL AND pa.timeend > :now AND pa.timeend < :soon
                  ORDER BY p.id, s.id, pa.userid";
            $rs = $DB->get_recordset_sql($sql, $params);
            foreach ($rs as $allocation) {
                $loadfunction($allocation);
                self::notify_endsoon($program, $source, $allocation, $user);
            }
            $rs->close();
        }

        if (!$programid || $program->id != $programid || $program->notifyendcompleted) {
            $sql = "SELECT pa.*
                      FROM {enrol_programs_allocations} pa
                      JOIN {enrol_programs_sources} s ON s.id = pa.sourceid
                      JOIN {enrol_programs_programs} p ON p.id = pa.programid
                     WHERE p.archived = 0 AND pa.archived = 0 AND p.notifyendcompleted = 1 AND pa.timecompleted IS NOT NULL
                           $programselect $userselect
                           AND pa.timenotifiedendcompleted IS NULL AND pa.timeend <= :now AND pa.timeend > :cutoff
                  ORDER BY p.id, s.id, pa.userid";
            $rs = $DB->get_recordset_sql($sql, $params);
            foreach ($rs as $allocation) {
                $loadfunction($allocation);
                self::notify_endcompleted($program, $source, $allocation, $user);
            }
            $rs->close();
        }

        if (!$programid || $program->id != $programid || $program->notifyendfailed) {
            $sql = "SELECT pa.*
                      FROM {enrol_programs_allocations} pa
                      JOIN {enrol_programs_sources} s ON s.id = pa.sourceid
                      JOIN {enrol_programs_programs} p ON p.id = pa.programid
                     WHERE p.archived = 0 AND pa.archived = 0 AND p.notifyendfailed = 1 AND pa.timecompleted IS NULL
                           $programselect $userselect
                           AND pa.timenotifiedendfailed IS NULL AND pa.timeend <= :now AND pa.timeend > :cutoff
                  ORDER BY p.id, s.id, pa.userid";
            $rs = $DB->get_recordset_sql($sql, $params);
            foreach ($rs as $allocation) {
                $loadfunction($allocation);
                self::notify_endfailed($program, $source, $allocation, $user);
            }
            $rs->close();
        }
    }
}
