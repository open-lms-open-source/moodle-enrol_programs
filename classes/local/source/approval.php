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

use enrol_programs\local\util;
use stdClass;

/**
 * Program allocation with approval source.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class approval extends base {
    /**
     * Return short type name of source, it is used in database to identify this source.
     *
     * NOTE: this must be unique and ite cannot be changed later
     *
     * @return string
     */
    public static function get_type(): string {
        return 'approval';
    }

    /**
     * Is it possible to manually edit user allocation?
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_edit_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        return true;
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
        return true;
    }

    /**
     * Can the user request new allocation?
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param int $userid
     * @param string|null $failurereason optional failure reason
     * @return bool
     */
    public static function can_user_request(\stdClass $program, \stdClass $source, int $userid, ?string &$failurereason = null): bool {
        global $DB;

        if ($source->type !== 'approval') {
            throw new \coding_exception('invalid source parameter');
        }

        if ($program->archived) {
            return false;
        }

        if ($userid <= 0 || isguestuser($userid)) {
            return false;
        }

        if ($program->timeallocationstart && $program->timeallocationstart > time()) {
            return false;
        }

        if ($program->timeallocationend && $program->timeallocationend < time()) {
            return false;
        }

        if (!\enrol_programs\local\catalogue::is_program_visible($program, $userid)) {
            return false;
        }

        if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $userid])) {
            return false;
        }

        $request = $DB->get_record('enrol_programs_requests', ['sourceid' => $source->id, 'userid' => $userid]);
        if ($request) {
            if ($request->timerejected) {
                $info = get_string('source_approval_requestrejected', 'enrol_programs');
            } else {
                $info = get_string('source_approval_requestpending', 'enrol_programs');
            }
            $failurereason = '<em><strong>' . $info . '</strong></em>';
            return false;
        }

        $data = (object)json_decode($source->datajson);
        if (isset($data->allowrequest) && !$data->allowrequest) {
            return false;
        }

        return true;
    }

    /**
     * Returns list of actions available in Program catalogue.
     *
     * NOTE: This is intended mainly for students.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @return string[]
     */
    public static function get_catalogue_actions(\stdClass $program, \stdClass $source): array {
        global $USER, $DB, $PAGE;

        $failurereason = null;
        if (!self::can_user_request($program, $source, (int)$USER->id, $failurereason)) {
            if ($failurereason !== null) {
                return [$failurereason];
            } else {
                return [];
            }
        }

        $url = new \moodle_url('/enrol/programs/catalogue/source_approval_request.php', ['sourceid' => $source->id]);
        $button = new \local_openlms\output\dialog_form\button($url, get_string('source_approval_makerequest', 'enrol_programs'));

        /** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
        $dialogformoutput = $PAGE->get_renderer('local_openlms', 'dialog_form');
        $button = $dialogformoutput->render($button);

        return [$button];
    }

    /**
     * Return request approval tab link.
     *
     * @param stdClass $program
     * @return array
     */
    public static function get_extra_management_tabs(stdClass $program): array {
        global $DB;

        $tabs = [];

        if ($DB->record_exists('enrol_programs_sources', ['programid' => $program->id, 'type' => 'approval'])) {
            $url = new \moodle_url('/enrol/programs/management/source_approval_requests.php', ['id' => $program->id]);
            $tabs[] = new \tabobject('requests', $url, get_string('source_approval_requests', 'enrol_programs'));
        }

        return $tabs;
    }

    /**
     * Decode extra source settings.
     *
     * @param stdClass $source
     * @return stdClass
     */
    public static function decode_datajson(stdClass $source): stdClass {
        $source->approval_allowrequest = 1;

        if (isset($source->datajson)) {
            $data = (object)json_decode($source->datajson);
            if (isset($data->allowrequest)) {
                $source->approval_allowrequest = (int)(bool)$data->allowrequest;
            }
        }

        return $source;
    }

    /**
     * Encode extra source settings.
     *
     * @param stdClass $formdata
     * @return string
     */
    public static function encode_datajson(stdClass $formdata): string {
        $data = ['allowrequest' => 1];
        if (isset($formdata->approval_allowrequest)) {
            $data['allowrequest'] = (int)(bool)$formdata->approval_allowrequest;
        }
        return \enrol_programs\local\util::json_encode($data);
    }

    /**
     * Process user request for allocation to program.
     *
     * @param int $programid
     * @param int $sourceid
     * @return ?stdClass
     */
    public static function request(int $programid, int $sourceid): ?stdClass {
        global $DB, $USER;

        if (!isloggedin() || isguestuser()) {
            return null;
        }

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
        $source = $DB->get_record('enrol_programs_sources',
            ['id' => $sourceid, 'type' => static::get_type(), 'programid' => $program->id], '*', MUST_EXIST);

        $user = $DB->get_record('user', ['id' => $USER->id, 'deleted' => 0], '*', MUST_EXIST);
        if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id])) {
            // One allocation per program only.
            return null;
        }

        if ($DB->record_exists('enrol_programs_requests', ['sourceid' => $source->id, 'userid' => $user->id])) {
            // Cannot request repeatedly.
            return null;
        }

        $record = new stdClass();
        $record->sourceid = $source->id;
        $record->userid = $user->id;
        $record->timerequested = time();
        $record->datajson = util::json_encode([]);
        $record->id = $DB->insert_record('enrol_programs_requests', $record);

        // Send notification.
        $context = \context::instance_by_id($program->contextid);
        $targets = get_users_by_capability($context, 'enrol/programs:allocate');
        foreach ($targets as $target) {
            $oldforcelang = force_current_language($target->lang);

            $a = new stdClass();
            $a->user_fullname = s(fullname($user));
            $a->user_firstname = s($user->firstname);
            $a->user_lastname = s($user->lastname);
            $a->program_fullname = format_string($program->fullname);
            $a->program_idnumber = s($program->idnumber);
            $a->program_url = (new \moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]))->out(false);
            $a->requests_url = (new \moodle_url('/enrol/programs/management/source_approval_requests.php', ['id' => $program->id]))->out(false);

            $subject = get_string('source_approval_notification_approval_request_subject', 'enrol_programs', $a);
            $body = get_string('source_approval_notification_approval_request_body', 'enrol_programs', $a);

            $message = new \core\message\message();
            $message->notification = 1;
            $message->component = 'enrol_programs';
            $message->name = 'approval_request_notification';
            $message->userfrom = $user;
            $message->userto = $target;
            $message->subject = $subject;
            $message->fullmessage = $body;
            $message->fullmessageformat = FORMAT_MARKDOWN;
            $message->fullmessagehtml = markdown_to_html($body);
            $message->smallmessage = $subject;
            $message->contexturlname = $a->program_fullname;
            $message->contexturl = $a->requests_url;
            message_send($message);

            force_current_language($oldforcelang);
        }

        return $DB->get_record('enrol_programs_requests', ['id' => $record->id], '*', MUST_EXIST);
    }

    /**
     * Approve student allocation request.
     *
     * @param int $requestid
     * @return ?stdClass user allocation record
     */
    public static function approve_request(int $requestid): ?stdClass {
        global $DB;

        $request = $DB->get_record('enrol_programs_requests', ['id' => $requestid], '*', MUST_EXIST);
        $user = $DB->get_record('user', ['id' => $request->userid], '*', MUST_EXIST);
        $source = $DB->get_record('enrol_programs_sources', ['id' => $request->sourceid], '*', MUST_EXIST);
        $program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid], '*', MUST_EXIST);

        if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id])) {
            return null;
        }

        $trans = $DB->start_delegated_transaction();
        $allocation = self::allocate_user($program, $source, $user->id, []);
        $DB->delete_records('enrol_programs_requests', ['id' => $request->id]);
        $trans->allow_commit();

        \enrol_programs\local\allocation::fix_user_enrolments($program->id, $user->id);
        \enrol_programs\local\notification_manager::trigger_notifications($program->id, $user->id);

        return $allocation;
    }

    /**
     * Returns the user who is responsible for allocation.
     *
     * Override if plugin knows anybody better than admin.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return stdClass user record
     */
    public static function get_allocator(stdClass $program, stdClass $source, stdClass $allocation): stdClass {
        global $USER;

        if (!isloggedin()) {
            // This should not happen, probably some customisation doing manual allocations.
            return parent::get_allocator($program, $source, $allocation);
        }

        return $USER;
    }

    /**
     * Reject student allocation request.
     *
     * @param int $requestid
     * @param string $reason
     * @return void
     */
    public static function reject_request(int $requestid, string $reason): void {
        global $DB, $USER;

        $request = $DB->get_record('enrol_programs_requests', ['id' => $requestid], '*', MUST_EXIST);
        if ($request->timerejected) {
            return;
        }
        $request->timerejected = time();
        $request->rejectedby = $USER->id;
        $DB->update_record('enrol_programs_requests', $request);

        $source = $DB->get_record('enrol_programs_sources', ['id' => $request->sourceid], '*', MUST_EXIST);
        $program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid], '*', MUST_EXIST);
        $user = $DB->get_record('user', ['id' => $request->userid], '*', MUST_EXIST);

        $oldforcelang = force_current_language($user->lang);

        $a = new stdClass();
        $a->user_fullname = s(fullname($user));
        $a->user_firstname = s($user->firstname);
        $a->user_lastname = s($user->lastname);
        $a->program_fullname = format_string($program->fullname);
        $a->program_idnumber = s($program->idnumber);
        $a->program_url = (new \moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]))->out(false);
        $a->reason = $reason;

        $subject = get_string('source_approval_notification_approval_reject_subject', 'enrol_programs', $a);
        $body = get_string('source_approval_notification_approval_reject_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'approval_reject_notification';
        $message->userfrom = $USER;
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;
        message_send($message);

        force_current_language($oldforcelang);
    }

    /**
     * Delete student allocation request.
     *
     * @param int $requestid
     * @return void
     */
    public static function delete_request(int $requestid): void {
        global $DB;

        $request = $DB->get_record('enrol_programs_requests', ['id' => $requestid]);
        if (!$request) {
            return;
        }

        $DB->delete_records('enrol_programs_requests', ['id' => $request->id]);
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
            $data = (object)json_decode($source->datajson);
            if (!isset($data->allowrequest) || $data->allowrequest) {
                $result .= '; ' . get_string('source_approval_requestallowed', 'enrol_programs');
            } else {
                $result .= '; ' . get_string('source_approval_requestnotallowed', 'enrol_programs');
            }
        }

        return $result;
    }
}

