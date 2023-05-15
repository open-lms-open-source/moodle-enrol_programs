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
     * Allocation related buttons for program management page.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @return array
     */
    public static function get_management_program_users_buttons(\stdClass $program, \stdClass $source): array {
        global $PAGE;

        /** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
        $dialogformoutput = $PAGE->get_renderer('local_openlms', 'dialog_form');

        if ($source->type !== static::get_type()) {
            throw new \coding_exception('invalid instance');
        }
        $enabled = self::is_allocation_possible($program, $source);
        $context = \context::instance_by_id($program->contextid);
        $buttons = [];
        if ($enabled && has_capability('enrol/programs:allocate', $context)) {
            $url = new \moodle_url('/enrol/programs/management/source_manual_allocate.php', ['sourceid' => $source->id]);
            $button = new \local_openlms\output\dialog_form\button($url, get_string('source_manual_allocateusers', 'enrol_programs'));
            $buttons[] = $dialogformoutput->render($button);

            $url = new \moodle_url('/enrol/programs/management/source_manual_upload.php', ['sourceid' => $source->id]);
            $button = new \local_openlms\output\dialog_form\button($url, get_string('source_manual_uploadusers', 'enrol_programs'));
            $buttons[] = $dialogformoutput->render($button);
        }
        return $buttons;
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
     * Stores csv file contents as normalised JSON file.
     *
     * NOTE: uploaded file is deleted and instead a new data.json file is stored.
     *
     * @param int $draftid
     * @param array $filedata
     * @return void
     */
    public static function store_uploaded_data(int $draftid, array $filedata): void {
        global $USER;

        $fs = get_file_storage();
        $context = \context_user::instance($USER->id);

        $fs->delete_area_files($context->id, 'enrol_programs', 'upload', $draftid);

        $content = json_encode($filedata, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $record = [
            'contextid' => $context->id,
            'component' => 'enrol_programs',
            'filearea' => 'upload',
            'itemid' => $draftid,
            'filepath' => '/',
            'filename' => 'data.json',
        ];

        $fs->create_file_from_string($record, $content);
    }

    /**
     * Returns preprocessed data.json user allocation file contents.
     *
     * @param int $draftid
     * @return array|null
     */
    public static function get_uploaded_data(int $draftid): ?array {
        global $USER;

        if (!$draftid) {
            return null;
        }

        $fs = get_file_storage();
        $context = \context_user::instance($USER->id);

        $file = $fs->get_file($context->id, 'enrol_programs', 'upload', $draftid, '/', 'data.json');
        if (!$file) {
            return null;
        }
        $data = json_decode($file->get_content(), true);
        if (!is_array($data)) {
            return null;
        }
        $data = fix_utf8($data);
        return $data;
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
     * Deletes old orphaned upload related data.
     *
     * @return void
     */
    public static function cleanup_uploaded_data(): void {
        global $DB;

        $fs = get_file_storage();
        $sql = "SELECT contextid, itemid
                  FROM {files}
                 WHERE component = 'enrol_programs' AND filearea = 'upload' AND filepath = '/' AND filename = '.'
                       AND timecreated < :old";
        $rs = $DB->get_recordset_sql($sql, ['old' => time() - 60*60*24*2]);
        foreach ($rs as $dir) {
            $fs->delete_area_files($dir->contextid, 'enrol_programs', 'upload', $dir->itemid);
        }
        $rs->close();
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

