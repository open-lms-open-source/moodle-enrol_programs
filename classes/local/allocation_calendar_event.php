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

require_once($CFG->dirroot.'/calendar/lib.php');

use stdClass;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

/**
 * ALLOCATION_CALENDAR_EVENTTYPE_START - value for the allocation start date type
 */
define('ALLOCATION_CALENDAR_EVENTTYPE_START', 'programstart');

/**
 * ALLOCATION_CALENDAR_EVENTTYPE_END - value for the allocation end date type
 */
define('ALLOCATION_CALENDAR_EVENTTYPE_END', 'programend');

/**
 * ALLOCATION_CALENDAR_EVENTTYPE_DUE - value for the allocation due date type
 */
define('ALLOCATION_CALENDAR_EVENTTYPE_DUE', 'programsdue');


/**
 * Program allocation calendar event.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Chris Tranel
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
final class allocation_calendar_event {
    /**
     * Creates calendar events for allocation.
     * @param Object $allocation
     * @param Object $program
     *
     * @return void
     */
    public static function create_allocation_calendar_events(Object $allocation, Object $program): void {
        $eventprops = self::get_base_properties($allocation, $program);

        // Create start event
        if ($allocation->timestart) {
            $eventprops['name'] = $program->fullname . ' ' . get_string('programstart', 'enrol_programs');
            $eventprops['eventtype'] = ALLOCATION_CALENDAR_EVENTTYPE_START;
            $eventprops['timestart'] = $allocation->timestart;
            \calendar_event::create($eventprops, false);
        }

        // Create end event
        if ($allocation->timeend) {
            $eventprops['name'] = $program->fullname . ' ' . get_string('programend', 'enrol_programs');
            $eventprops['eventtype'] = ALLOCATION_CALENDAR_EVENTTYPE_END;
            $eventprops['timestart'] = $allocation->timeend;
            \calendar_event::create($eventprops, false);
        }

        // Create due entry
        if ($allocation->timedue) {
            $eventprops['name'] = $program->fullname . ' ' . get_string('programdue', 'enrol_programs');
            $eventprops['eventtype'] = ALLOCATION_CALENDAR_EVENTTYPE_DUE;
            $eventprops['timestart'] = $allocation->timedue;
            \calendar_event::create($eventprops, false);
        }
    }

    /**
     * Creates calendar events for allocation.
     * @param Object $allocation
     * @param Object $program
     *
     * @return void
     */
    public static function update_allocation_calendar_events(Object $allocation, Object $program): void {
        global $DB;

        $events = $DB->get_recordset('event', ['component' => 'enrol_programs', 'instance' => $allocation->id]);
        foreach ($events as $event) {
            // Only event name, startdate and description can be updated.
            $newdata = [];
            if ($event->description !== $program->description || strpos($event->name, $program->fullname) !== 0) {
                $newdata['description'] = $program->description;
                $newdata['name'] = $program->fullname;
            }

            if (
                $event->eventtype === ALLOCATION_CALENDAR_EVENTTYPE_START && $allocation->timestart &&
                ($allocation->timestart !== $event->timestart || count($newdata) > 0)
            ) {
                $newdata['name'] = $program->fullname . ' ' . get_string('programstart', 'enrol_programs');
                $newdata['timestart'] = $allocation->timestart;
            }
            if (
                $event->eventtype === ALLOCATION_CALENDAR_EVENTTYPE_END && $allocation->timeend &&
                ($allocation->timeend !== $event->timestart || count($newdata) > 0)
            ) {
                $newdata['name'] = $program->fullname . ' ' . get_string('programend', 'enrol_programs');
                $newdata['timestart'] = $allocation->timeend;
            }
            if (
                $event->eventtype === ALLOCATION_CALENDAR_EVENTTYPE_DUE && $allocation->timedue &&
                ($allocation->timedue !== $event->timestart || count($newdata) > 0)
            ) {
                $newdata['name'] = $program->fullname . ' ' . get_string('programdue', 'enrol_programs');
                $newdata['timestart'] = $allocation->timedue;
            }

            if (count($newdata) > 0) {
                $calendarevent = \calendar_event::load($event);
                $calendarevent->update((object)$newdata);
            }
        }
        $events->close();
    }

    /**
     * Delete calendar events associated with allocation.
     * @param Object $allocation
     *
     * @return void
     */
    public static function delete_allocation_calendar_events(Object $allocation): void {
        global $DB;

        $events = $DB->get_recordset('event', ['component' => 'enrol_programs', 'instance' => $allocation->id]);
        foreach ($events as $event) {
            $calendarevent = \calendar_event::load($event);
            $calendarevent->delete();
        }
        $events->close();
    }

    /**
     * Adjusts calendar events for allocation completions.
     * @param Object $allocation
     *
     * @return void
     */
    public static function adjust_allocation_completion_calendar_events(Object $allocation): void {
        global $DB;

        // Delete due date calendar events when allocation is completed.
        $events = $DB->get_recordset('event', ['instance' => $allocation->id, 'component' => 'enrol_programs', 'eventtype' => ALLOCATION_CALENDAR_EVENTTYPE_DUE]);
        foreach ($events as $event) {
            $calendarevent = \calendar_event::load($event);
            $calendarevent->delete();
        }
        $events->close();
    }

    /**
     * Returns base calendar event information based on passed allocation and program.
     * @param Object $allocation
     * @param Object $program
     *
     * @return Array
     */
    public static function get_base_properties(Object $allocation, Object $program): Array {
        return [
            'description' => $program->description,
            'format' => 1,
            'courseid' => 0,
            'groupid' => 0,
            'userid' => $allocation->userid,
            'component' => 'enrol_programs',
            'modulename' => 0,
            'instance' => $allocation->id,
            'type' => CALENDAR_EVENT_TYPE_ACTION,
            'timeduration' => 0,
            'visible' => 1
        ];
    }

    /**
     * Delete calendar event due dates (completed allocation).
     * @param Object $program
     *
     * @return void
     */
    public static function delete_program_calendar_events(Int $programid): void {
        global $DB;

        $events = $DB->get_recordset('enrol_programs_allocations', ['programid' => $programid]);
        foreach ($events as $allocation) {
            self::delete_allocation_calendar_events($allocation);
        }
        $events->close();
    }

    /**
     * Check and fix all program/allocation calendar events.
     *
     * NOTE: this can be used as a quick way to make sure all program/allocation calendar events are up-to-date.
     *
     * @param Object|null $program
     * @return void
     */
    public static function fix_allocation_calendar_events(?Object $program): void {
        global $DB;

        // Delete calendar events with no matching allocations.
        $params = [];
        $sql = "SELECT e.* FROM {event} e WHERE component='enrol_programs' AND NOT EXISTS (SELECT 1 FROM {enrol_programs_allocations} a WHERE a.id = e.instance";
        if ($program) {
            $params[] = $program->id;
            $sql .= " AND a.programid = ?";
        }
        $sql .= ');';

        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $event) {
            $calendarevent = \calendar_event::load($event);
            $calendarevent->delete();
        }
        $rs->close();

        // Add calendar events when allocations exist without a calendar event.
        $params = [];
        $sql =
            "SELECT a.*
            FROM {enrol_programs_programs} p
                INNER JOIN {enrol_programs_allocations} a ON p.id=a.programid AND p.archived=0 AND a.archived=0 AND a.timecompleted IS NULL";
        if ($program) {
            $params[] = $program->id;
            $sql .= " AND a.programid = ?";
        }
        $sql .= " WHERE (SELECT COUNT(1) FROM {event} WHERE instance=a.id AND component='enrol_programs') <> 3
            ORDER BY p.id;";

        $allocationprogram = $program;
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $allocation) {
            if (!$allocationprogram || $allocationprogram->id !== $allocation->programid){
                $allocationprogram = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid], '*', MUST_EXIST);
            }

            // Make sure there are no partial sets of calendar dates for the allocation
            self::delete_allocation_calendar_events($allocation);

            self::create_allocation_calendar_events($allocation, $allocationprogram);
        }
        $rs->close();

        // Delete due date calendar events when allocation is completed.
        $params = [ALLOCATION_CALENDAR_EVENTTYPE_DUE];
        $sql =
            "SELECT e.*
            FROM {event} e
            WHERE eventtype=? AND e.component='enrol_programs' AND EXISTS (
                SELECT 1 FROM {enrol_programs_allocations} a WHERE a.id = e.instance AND a.timecompleted IS NOT NULL";
        if ($program) {
            $params[] = $program->id;
            $sql .= " AND a.programid = ?";
        }
        $sql .= ");";

        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $event) {
            $calendarevent = \calendar_event::load($event);
            $calendarevent->delete();
        }
        $rs->close();

        // Sync active programs/allocations with events
        $params = [ALLOCATION_CALENDAR_EVENTTYPE_START, ALLOCATION_CALENDAR_EVENTTYPE_END, ALLOCATION_CALENDAR_EVENTTYPE_DUE];
        $sql =
            "SELECT a.*
            FROM {enrol_programs_programs} p
                INNER JOIN {enrol_programs_allocations} a ON p.id=a.programid AND p.archived=0 AND a.archived=0 AND a.timecompleted IS NULL
            WHERE EXISTS (
                SELECT 1 FROM {event}
                WHERE instance=a.id AND component='enrol_programs' AND (
                    name NOT LIKE CONCAT(p.fullname, '%%') OR description != p.description OR
                    (eventtype=? AND timestart <> a.timestart) OR
                    (eventtype=? AND timestart <> a.timeend) OR
                    (eventtype=? AND timestart <> a.timedue)
                )
            )";
        if ($program) {
            $params[] = $program->id;
            $sql .= " AND a.programid = ?";
        }
        $sql .= " ORDER BY p.id;";

        $allocationprogram = $program;
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $allocation) {
            if (!$allocationprogram || $allocationprogram->id !== $allocation->programid){
                $allocationprogram = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid], '*', MUST_EXIST);
            }
            self::update_allocation_calendar_events($allocation, $allocationprogram);
        }
        $rs->close();
    }
}
