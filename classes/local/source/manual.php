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
 * Manual program allocation.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class manual extends base {
    /**
     * Return short type name of source, it is used in database to identify this source.
     *
     * NOTE: this must be unique and ite cannot be changed later
     *
     * @return string
     */
    public static function get_type(): string {
        return 'manual';
    }

    /**
     * Manual allocation source cannot be completely prevented.
     *
     * @param stdClass $program
     * @return bool
     */
    public static function is_new_allowed(\stdClass $program): bool {
        return true;
    }

    /**
     * Can settings of this source be imported to other program?
     *
    /**
     * Can settings of this source be imported to other program?
     *
     * @param stdClass $fromprogram
     * @param stdClass $targetprogram
     * @return bool
     */
    public static function is_import_allowed(stdClass $fromprogram, stdClass $targetprogram): bool {
        global $DB;

        if (!$DB->record_exists('enrol_programs_sources', ['type' => static::get_type(), 'programid' => $fromprogram->id])) {
            return false;
        }

        if (!$DB->record_exists('enrol_programs_sources', ['type' => static::get_type(), 'programid' => $targetprogram->id])) {
            if (!static::is_new_allowed($targetprogram)) {
                return false;
            }
        }

        return true;
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
     * Is it possible to manually archive and unarchive user allocation?
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_archiving_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
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
     * Is it possible to manually allocate users to this program?
     *
     * @param stdClass $program
     * @param stdClass $source
     * @return bool
     */
    public static function is_allocation_possible(\stdClass $program, \stdClass $source): bool {
        if ($program->archived) {
            return false;
        }
        if ($program->timeallocationstart && $program->timeallocationstart > time()) {
            return false;
        } else if ($program->timeallocationend && $program->timeallocationend < time()) {
            return false;
        }
        return true;
    }

    /**
     * Source related extra menu items for program allocation tab.
     *
     * @param \enrol_programs\hook\extra_menu\management_program_users $menu
     * @param stdClass $source
     */
    public static function add_management_program_users_extra_actions(
        \enrol_programs\hook\extra_menu\management_program_users $menu, stdClass $source): void {

        $program = $menu->get_program();
        if ($program->id != $source->programid || $source->type !== self::get_type()) {
            throw new \coding_exception('Parameter mismatch detected');
        }

        if (!self::is_allocation_possible($program, $source)) {
            return;
        }

        $context = \context::instance_by_id($program->contextid);
        if (has_capability('enrol/programs:allocate', $context)) {
            $url = new \moodle_url('/enrol/programs/management/source_manual_allocate.php', ['sourceid' => $source->id]);
            $link = new \local_openlms\output\dialog_form\link($url, get_string('source_manual_allocateusers', 'enrol_programs'));
            $menu->add_dialog_form($link);

            $url = new \moodle_url('/enrol/programs/management/source_manual_upload.php', ['sourceid' => $source->id]);
            $link = new \local_openlms\output\dialog_form\link($url, get_string('source_manual_uploadusers', 'enrol_programs'));
            $menu->add_dialog_form($link);
        }
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
     * Allocate users manually.
     *
     * @param int $programid
     * @param int $sourceid
     * @param array $userids
     * @param array $dateoverrides
     * @return void
     */
    public static function allocate_users(int $programid, int $sourceid, array $userids, array $dateoverrides = []): void {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
        $source = $DB->get_record('enrol_programs_sources',
            ['id' => $sourceid, 'type' => static::get_type(), 'programid' => $program->id], '*', MUST_EXIST);

        if (count($userids) === 0) {
            return;
        }

        foreach ($userids as $userid) {
            $user = $DB->get_record('user', ['id' => $userid, 'deleted' => 0], '*', MUST_EXIST);
            if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id])) {
                // One allocation per program only.
                continue;
            }
            self::allocate_user($program, $source, $user->id, [], $dateoverrides);
        }

        if (count($userids) === 1) {
            $userid = reset($userids);
        } else {
            $userid = null;
        }
        \enrol_programs\local\allocation::fix_user_enrolments($programid, $userid);
        \enrol_programs\local\notification_manager::trigger_notifications($programid, $userid);
    }

    /**
     * Returns preprocessed user allocation upload file contents.
     *
     * NOTE: data.json file is deleted.
     *
     * @param stdClass $data form submission data
     * @param array $filedata decoded data.json file
     * @return array with keys 'assigned', 'skipped' and 'errors'
     */
    public static function process_uploaded_data(stdClass $data, array $filedata): array {
        global $DB, $USER;

        if ($data->usermapping !== 'username'
            && $data->usermapping !== 'email'
            && $data->usermapping !== 'idnumber'
        ) {
            // We need to prevent SQL injections in get_record later!
            throw new \coding_exception('Invalid usermapping value');
        }

        $result = [
            'assigned' => 0,
            'skipped' => 0,
            'errors' => 0,
        ];

        $source = $DB->get_record('enrol_programs_sources', ['id' => $data->sourceid, 'type' => 'manual'], '*', MUST_EXIST);
        $program = $DB->get_record('enrol_programs_programs', ['id' => $source->programid], '*', MUST_EXIST);

        if ($data->hasheaders) {
            unset($filedata[0]);
        }

        $datefields = ['timestartcolumn' => 'timestart', 'timeduecolumn' => 'timedue', 'timeendcolumn' => 'timeend'];
        $datecolumns = [];
        foreach ($datefields as $key => $value) {
            if (isset($data->{$key}) && $data->{$key} != -1) {
                $datecolumns[$value] = $data->{$key};
            }
        }

        $userids = [];
        foreach ($filedata as $i => $row) {
            $userident = $row[$data->usercolumn];
            if (!$userident) {
                $result['errors']++;
                continue;
            }
            $users = $DB->get_records('user', [$data->usermapping => $userident, 'deleted' => 0, 'confirmed' => 1]);
            if (count($users) !== 1) {
                $result['errors']++;
                continue;
            }
            $user = reset($users);
            if (isguestuser($user->id)) {
                $result['errors']++;
                continue;
            }
            if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id])) {
                $result['skipped']++;
                continue;
            }

            $dateoverrides = [];
            foreach ($datecolumns as $key => $value) {
                if (!empty($row[$value])) {
                    $dateoverrides[$key] = strtotime($row[$value]);
                    if ($dateoverrides[$key] === false) {
                        $result['errors']++;
                        continue 2;
                    }
                }
            }
            if (!base::is_valid_dateoverrides($program, $dateoverrides)) {
                $result['errors']++;
                continue;
            }
            self::allocate_user($program, $source, $user->id, [], $dateoverrides);
            \enrol_programs\local\allocation::fix_user_enrolments($program->id, $user->id);
            \enrol_programs\local\notification_manager::trigger_notifications($program->id, $user->id);
            $userids[] = $user->id;
        }

        $result['assigned'] = count($userids);

        if (!empty($data->csvfile)) {
            $fs = get_file_storage();
            $context = \context_user::instance($USER->id);
            $fs->delete_area_files($context->id, 'user', 'draft', $data->csvfile);
            $fs->delete_area_files($context->id, 'enrol_programs', 'upload', $data->csvfile);
        }

        return $result;
    }

    /**
     * Called from \tool_uploaduser\process::process_line()
     *
     * @param stdClass $user
     * @param string $column
     * @param \uu_progress_tracker $upt
     * @return void
     */
    public static function tool_uploaduser_process(stdClass $user, string $column, \uu_progress_tracker $upt): void {
        global $DB;

        if (!preg_match('/^program(?:id)?\d+$/', $column)) {
            return;
        }
        // Extract the program number from the column name.
        $number = strpos($column, 'id') !== false ? substr($column, 9) : substr($column, 7);
        if (empty($user->{$column})) {
            return;
        }
        $isidcolumn = strpos($column, 'id') !== false;
        if (empty($user->{$column})) {
            return;
        }

        $programid = $user->{$column};
        $program = null;
        if ($isidcolumn) {
            if (is_number($programid)) {
                $program = $DB->get_record('enrol_programs_programs', ['id' => $programid]);
            }
        } else {
            $program = $DB->get_record('enrol_programs_programs', ['idnumber' => $programid]);
        }
        if (!$program) {
            $programid = trim((string)$programid, " \t\n\r\0\x0B'\"");
            $upt->track('enrolments', get_string('source_manual_userupload_invalidprogram', 'enrol_programs', s($programid)), 'error');
            return;
        }
        $programname = format_string($program->fullname);

        $context = \context::instance_by_id($program->contextid, IGNORE_MISSING);
        if (!$context || !has_capability('enrol/programs:allocate', $context)) {
            $upt->track('enrolments', get_string('source_manual_userupload_invalidprogram', 'enrol_programs', $programname), 'error');
            return;
        }
        $source = $DB->get_record('enrol_programs_sources', ['type' => 'manual', 'programid' => $program->id]);
        if (!$source || !self::is_allocation_possible($program, $source)) {
            $upt->track('enrolments', get_string('source_manual_userupload_invalidprogram', 'enrol_programs', $programname), 'error');
            return;
        }

        if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id])) {
            $upt->track('enrolments', get_string('source_manual_userupload_alreadyallocated', 'enrol_programs', $programname), 'info');
            return;
        }

        // This only works if the user is not already allocated in the program.
        $dateoverrides = [];
        $datefields = ['timestart' => 'pstartdate'.$number, 'timedue' => 'pduedate'.$number, 'timeend' => 'penddate'.$number];

        foreach ($datefields as $key => $datefield) {
            if (!empty($user->{$datefield})) {
                $dateoverrides[$key] = strtotime($user->{$datefield});
                if ($dateoverrides[$key] === false) {
                    $upt->track('enrolments', get_string('invalidallocationdates', 'enrol_programs', $programname), 'error');
                    return;
                }
            }
        }

        if (!base::is_valid_dateoverrides($program, $dateoverrides)) {
            $upt->track('enrolments', get_string('invalidallocationdates', 'enrol_programs', $programname), 'error');
            return;
        }

        self::allocate_user($program, $source, $user->id, [], $dateoverrides);
        \enrol_programs\local\allocation::fix_user_enrolments($program->id, $user->id);
        \enrol_programs\local\notification_manager::trigger_notifications($program->id, $user->id);

        $upt->track('enrolments', get_string('source_manual_userupload_allocated', 'enrol_programs', $programname), 'info');
    }
}

