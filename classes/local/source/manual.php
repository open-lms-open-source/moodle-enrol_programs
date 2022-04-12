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
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
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
     * @return bool
     */
    public static function is_new_allowed(): bool {
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
     * @return void
     */
    public static function allocate_users(int $programid, int $sourceid, array $userids): void {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
        $source = $DB->get_record('enrol_programs_sources',
            ['id' => $sourceid, 'type' => static::get_type(), 'programid' => $program->id], '*', MUST_EXIST);

        foreach ($userids as $userid) {
            $user = $DB->get_record('user', ['id' => $userid, 'deleted' => 0], '*', MUST_EXIST);
            if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id])) {
                // One allocation per program only.
                continue;
            }
            self::allocate_user($program, $source, $user->id, []);
        }

        \enrol_programs\local\allocation::fix_user_enrolments($programid, null);
        \enrol_programs\local\notification::trigger_notifications($programid, null);
    }
}

