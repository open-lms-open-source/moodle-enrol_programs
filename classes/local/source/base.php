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
 * Program source abstraction.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class base {
    /**
     * Return short type name of source, it is used in database to identify this source.
     *
     * NOTE: this must be unique and ite cannot be changed later
     *
     * @return string
     */
    public static function get_type(): string {
        throw new \coding_exception('cannot be called on base class');
    }

    /**
     * Returns name of the source.
     *
     * @return string
     */
    public static function get_name(): string {
        $type = static::get_type();
        return get_string('source_' . $type, 'enrol_programs');
    }

    /**
     * Can a new source of this type be added to programs?
     *
     * NOTE: Existing enabled sources in programs cannot be deleted/hidden
     * if there are any allocated users to program.
     *
     * @return bool
     */
    public static function is_new_allowed(): bool {
        $type = static::get_type();
        return (bool)get_config('enrol_programs', 'source_' . $type . '_allownew');
    }

    /**
     * Make sure users are allocated properly.
     *
     * This is expected to be called from cron and when
     * program allocation settings are updated.
     *
     * @param int|null $programid
     * @param int|null $userid
     * @return bool true if anything updated
     */
    public static function fix_allocations(?int $programid, ?int $userid): bool {
        return false;
    }

    /**
     * Return extra tab for managing the source data in program.
     *
     * @param stdClass $program
     * @return array
     */
    public static function get_extra_management_tabs(stdClass $program): array {
        return [];
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
        return false;
    }

    /**
     * Allocation related buttons for program management page.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @return array
     */
    public static function get_management_program_users_buttons(\stdClass $program, \stdClass $source): array {
        return [];
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
        return [];
    }

    /**
     * Allocate user to program.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param int $userid
     * @param array $sourcedata
     * @param array $dateoverrides
     * @return stdClass user allocation record
     */
    final protected static function allocate_user(\stdClass $program, \stdClass $source, int $userid, array $sourcedata, array $dateoverrides = []): \stdClass {
        global $DB;

        if ($userid <= 0 || isguestuser($userid)) {
            throw new \coding_exception('Only real users can be allocated to programs');
        }

        $user = $DB->get_record('user', ['id' => $userid, 'deleted' => 0, 'confirmed' => 1], '*', MUST_EXIST);

        $now = time();

        $record = new \stdClass();
        $record->programid = $program->id;
        $record->userid = $userid;
        $record->sourceid = $source->id;
        $record->archived = 0;
        $record->sourcedatajson = \enrol_programs\local\util::json_encode($sourcedata);
        $record->timeallocated = $now;
        $record->timecreated = $now;

        $startdate = (object)json_decode($program->startdatejson);
        if ($startdate->type === 'allocation') {
            $record->timestart = $record->timeallocated;
        } else if ($startdate->type === 'date') {
            $record->timestart = $startdate->date;
        } else if ($startdate->type === 'delay') {
            $d = new \DateTime('@' . $record->timeallocated);
            $d->add(new \DateInterval($startdate->delay));
            $record->timestart = $d->getTimestamp();
        } else {
            throw new \coding_exception('invalid program start');
        }

        $duedate = (object)json_decode($program->duedatejson);
        if ($duedate->type === 'notset') {
            $record->timedue = null;
        } else if ($duedate->type === 'date') {
            $record->timedue = $duedate->date;
        } else if ($duedate->type === 'delay') {
            $d = new \DateTime('@' . $record->timeallocated);
            $d->add(new \DateInterval($duedate->delay));
            $record->timedue = $d->getTimestamp();
        } else {
            throw new \coding_exception('invalid program due');
        }

        $enddate = (object)json_decode($program->enddatejson);
        if ($enddate->type === 'notset') {
            $record->timeend = null;
        } else if ($enddate->type === 'date') {
            $record->timeend = $enddate->date;
        } else if ($enddate->type === 'delay') {
            $d = new \DateTime('@' . $record->timeallocated);
            $d->add(new \DateInterval($enddate->delay));
            $record->timeend = $d->getTimestamp();
        } else {
            throw new \coding_exception('invalid program end');
        }

        foreach ($dateoverrides as $k => $v) {
            if ($k !== 'timeallocated' && $k !== 'timestart' && $k !== 'timedue' && $k !== 'timeend') {
                throw new \coding_exception('invalid date override');
            }
            $record->{$k} = $v;
        }

        $record->id = $DB->insert_record('enrol_programs_allocations', $record);
        $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $record->id], '*', MUST_EXIST);

        \enrol_programs\local\allocation::make_snapshot($allocation->id, 'allocation');

        $event = \enrol_programs\event\user_allocated::create_from_allocation($allocation, $program);
        $event->trigger();

        static::notify_allocation($user, $program, $source, $allocation);

        return $allocation;
    }

    /**
     * Decode extra source settings.
     *
     * @param stdClass $source
     * @return stdClass
     */
    public static function decode_datajson(stdClass $source): stdClass {
        // Override if necessary.
        return $source;
    }

    /**
     * Encode extra source settings.
     * @param stdClass $formdata
     * @return string
     */
    public static function encode_datajson(stdClass $formdata): string {
        // Override if necessary.
        return \enrol_programs\local\util::json_encode([]);
    }

    /**
     * Returns class for editing of source settings in program.
     *
     * @return string
     */
    public static function get_edit_form_class(): string {
        $type = static::get_type();
        $class = "enrol_programs\\local\\form\source_{$type}_edit";
        if (!class_exists($class)) {
            throw new \coding_exception('source edit class not found, either override get_edit_form_class or add class: ' . $class);
        }
        return $class;
    }

    /**
     * Render details about this enabled source in a program management ui.
     *
     * @param stdClass $program
     * @param stdClass|null $source
     * @return string
     */
    public static function render_status_details(stdClass $program, ?stdClass $source): string {
        return ($source ? get_string('active') : get_string('inactive'));
    }

    /**
     * Render basic status of the program source.
     *
     * @param stdClass $program
     * @param stdClass|null $source
     * @return string
     */
    public static function render_status(stdClass $program, ?stdClass $source): string {
        global $PAGE;

        $type = static::get_type();

        if ($source && $source->type !== $type) {
            throw new \coding_exception('Invalid source type');
        }

        /** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
        $dialogformoutput = $PAGE->get_renderer('local_openlms', 'dialog_form');

        $result = static::render_status_details($program, $source);

        $context = \context::instance_by_id($program->contextid);
        if (has_capability('enrol/programs:edit', $context)) {
            $label = get_string('updatesource', 'enrol_programs', static::get_name());
            $editurl = new \moodle_url('/enrol/programs/management/program_source_edit.php', ['programid' => $program->id, 'type' => $type]);
            $editbutton = new \local_openlms\output\dialog_form\icon($editurl, 'i/settings', $label);
            $editbutton->set_dialog_name(static::get_name());
            $result .= ' ' . $dialogformoutput->render($editbutton);
        }

        return $result;
    }

    /**
     * Update source details.
     *
     * @param stdClass $data
     * @return stdClass|null allocation source
     */
    final public static function update_source(stdClass $data): ?stdClass {
        global $DB;

        /** @var base[] $sourceclasses */
        $sourceclasses = \enrol_programs\local\allocation::get_source_classes();
        if (!isset($sourceclasses[$data->type])) {
            throw new \coding_exception('Invalid source type');
        }
        $sourcetype = $data->type;
        $sourceclass = $sourceclasses[$sourcetype];

        $program = $DB->get_record('enrol_programs_programs', ['id' => $data->programid], '*', MUST_EXIST);
        $source = $DB->get_record('enrol_programs_sources', ['type' => $sourcetype, 'programid' => $program->id]);
        if ($source && $source->type !== $data->type) {
            throw new \coding_exception('Invalid source type');
        }

        if ($data->enable) {
            if ($source) {
                $source->datajson = $sourceclass::encode_datajson($data);
                $DB->update_record('enrol_programs_sources', $source);
            } else {
                $source = new \stdClass();
                $source->programid = $data->programid;
                $source->type = $sourcetype;
                $source->datajson = $sourceclass::encode_datajson($data);
                $source->id = $DB->insert_record('enrol_programs_sources', $source);
            }
        } else {
            if ($source) {
                if ($DB->record_exists('enrol_programs_allocations', ['sourceid' => $source->id])) {
                    throw new \coding_exception('Cannot delete source with allocations');
                }
                $DB->delete_records('enrol_programs_requests', ['sourceid' => $source->id]);
                $DB->delete_records('enrol_programs_sources', ['id' => $source->id]);
                $source = null;
            }
        }

        if ($source) {
            $source = $DB->get_record('enrol_programs_sources', ['id' => $source->id], '*', MUST_EXIST);
        } else {
            $source = null;
        }

        \enrol_programs\local\program::make_snapshot($data->programid, 'update_source');

        \enrol_programs\local\allocation::fix_allocation_sources($program->id, null);
        \enrol_programs\local\allocation::fix_enrol_instances($program->id);
        \enrol_programs\local\allocation::fix_user_enrolments($program->id, null);

        return $source;
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
        // NOTE: tweak this if there is a need for tenant specific sender.
        return get_admin();
    }

    /**
     * Send notifications related to allocation.
     *
     * @param stdClass $user
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return void
     */
    public static function notify_allocation(stdClass $user, stdClass $program, stdClass $source, stdClass $allocation): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$source->notifyallocation) {
            return;
        }

        $stringprefix = 'source_' . static::get_type() . '_notification_allocation';
        if (!get_string_manager()->string_exists($stringprefix . '_subject', 'enrol_programs')) {
            $stringprefix = 'source_base_notification_allocation';
        }

        $oldforcelang = force_current_language($user->lang);

        $a = \enrol_programs\local\notification::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string($stringprefix . '_subject', 'enrol_programs', $a);
        $body = get_string($stringprefix . '_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'allocation_notification';
        $message->userfrom = static::get_allocator($program, $source, $allocation);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $DB->set_field('enrol_programs_allocations', 'timenotifiedallocation', time(), ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }

    /**
     * Deallocate user from a program.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return void
     */
    public static function deallocate_user(stdClass $program, stdClass $source, stdClass $allocation): void {
        global $DB;

        if (static::get_type() !== $source->type || $program->id != $allocation->programid || $program->id != $source->programid) {
            throw new \coding_exception('invalid paramters');
        }
        $user = $DB->get_record('user', ['id' => $allocation->userid]);

        $trans = $DB->start_delegated_transaction();

        \enrol_programs\local\allocation::make_snapshot($allocation->id, 'deallocation');

        $items = $DB->get_records('enrol_programs_items', ['programid' => $allocation->programid]);
        foreach ($items as $item) {
            $DB->delete_records('enrol_programs_evidences', ['itemid' => $item->id, 'userid' => $allocation->userid]);
            $DB->delete_records('enrol_programs_completions', ['itemid' => $item->id, 'allocationid' => $allocation->id]);
        }
        $DB->delete_records('enrol_programs_allocations', ['id' => $allocation->id]);

        $trans->allow_commit();

        \enrol_programs\local\allocation::fix_allocation_sources($program->id, $allocation->userid);
        \enrol_programs\local\allocation::fix_user_enrolments($program->id, $allocation->userid);

        $event = \enrol_programs\event\user_deallocated::create_from_allocation($allocation, $program);
        $event->trigger();

        if ($user && !$user->deleted) {
            static::notify_deallocation($user, $program, $source, $allocation);
        }
    }

    /**
     * Notify users about deallocation.
     *
     * @param stdClass $user
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return void
     */
    public static function notify_deallocation(stdClass $user, stdClass $program, stdClass $source, stdClass $allocation): void {
        global $DB;

        if ($program->archived || $allocation->archived) {
            // Never send notifications for archived stuff.
            return;
        }

        if (!$program->notifydeallocation) {
            return;
        }

        $stringprefix = 'source_' . static::get_type() . '_notification_deallocation';
        if (!get_string_manager()->string_exists($stringprefix . '_subject', 'enrol_programs')) {
            $stringprefix = 'source_base_notification_deallocation';
        }

        $oldforcelang = force_current_language($user->lang);

        $a = \enrol_programs\local\notification::get_standard_placeholders($program, $source, $allocation, $user);
        $subject = get_string($stringprefix . '_subject', 'enrol_programs', $a);
        $body = get_string($stringprefix . '_body', 'enrol_programs', $a);

        $message = new \core\message\message();
        $message->notification = 1;
        $message->component = 'enrol_programs';
        $message->name = 'deallocation_notification';
        $message->userfrom = static::get_allocator($program, $source, $allocation);
        $message->userto = $user;
        $message->subject = $subject;
        $message->fullmessage = $body;
        $message->fullmessageformat = FORMAT_MARKDOWN;
        $message->fullmessagehtml = markdown_to_html($body);
        $message->smallmessage = $subject;
        $message->contexturlname = $a->program_fullname;
        $message->contexturl = $a->program_url;

        if (message_send($message)) {
            $DB->set_field('enrol_programs_allocations', 'timenotifieddeallocation', time(), ['id' => $allocation->id]);
        }

        force_current_language($oldforcelang);
    }
}

