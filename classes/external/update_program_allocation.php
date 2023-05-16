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

namespace enrol_programs\external;

use enrol_programs\local\allocation;
use enrol_programs\local\source\manual;
use external_api;
use external_function_parameters;
use external_value;

/**
 * Updates the allocation for the given userid and program id.
 *
 * @package     enrol_programs
 * @copyright   2023 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class update_program_allocation extends external_api {
    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'programid' => new external_value(PARAM_INT, 'Program id'),
            'userid' => new external_value(PARAM_INT, 'User id'),
            'allocationdates' => new \external_single_structure([
                'timestart' => new external_value(PARAM_INT, 'time start', VALUE_OPTIONAL),
                'timedue' => new external_value(PARAM_INT, 'time due', VALUE_OPTIONAL),
                'timeend' => new external_value(PARAM_INT, 'time start', VALUE_OPTIONAL),
                'timecompleted' => new external_value(PARAM_INT, 'time start', VALUE_OPTIONAL)
            ], 'Array of allocation dates timestart timedue timeend timecompleted can be passed as unix timestamps', VALUE_DEFAULT, []),
            'archived' => new external_value(PARAM_BOOL, 'Archived flag', VALUE_DEFAULT, false)
        ]);
    }

    /**
     * Updates the allocation for the given userid and programid.
     *
     * @param int $programid Program id.
     * @param int $userid User id.
     * @param array $allocationdates Allocation dates.
     * @param bool $archived Archived false.
     * @return array
     */
    public static function execute(int $programid, int $userid, array $allocationdates = [], bool $archived = false): array {
        global $DB;
        $params = self::validate_parameters(self::execute_parameters(),
            ['programid' => $programid, 'userid' => $userid, 'allocationdates' => $allocationdates, 'archived' => $archived]);
        $userid = $params['userid'];
        $programid = $params['programid'];
        $allocationdates = $params['allocationdates'];
        $archived = $params['archived'];

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_capability('enrol/programs:admin', $context);

        $sourceclasses = allocation::get_source_classes();
        $allocationrecord = $DB->get_record('enrol_programs_allocations', ['programid' => $programid, 'userid' => $userid]);

        if (!$allocationrecord) {
            throw new \moodle_exception('errornoallocation', 'enrol_programs');
        }

        $source = $DB->get_record('enrol_programs_sources', ['id' => $allocationrecord->sourceid]);

        $sourceclass = $sourceclasses[$source->type];

        if ($sourceclass::is_update_allowed($program, $source, $allocationrecord)) {

            $timestart = $allocationdates['timestart'] ?? $allocationrecord->timestart;
            $timedue = $allocationdates['timedue'] ?? $allocationrecord->timedue;
            $timeend = $allocationdates['timeend'] ?? $allocationrecord->timeend;
            $timecompleted = $allocationdates['timecompleted'] ?? $allocationrecord->timeend;
            $errors = allocation::validate_allocation_dates($timestart, $timedue, $timeend);
            if (empty($errors)) {
                $allocationrecord->timestart = $timestart;
                $allocationrecord->timedue = $timedue;
                $allocationrecord->timeend = $timeend;
                $allocationrecord->archived = $archived;
                // TODO , do we need validation for time completed as well?
                $allocationrecord->timecompleted = $timecompleted;
                $DB->update_record('enrol_programs_allocations', $allocationrecord);
            } else {
                throw new \moodle_exception('errorinvalidoverridedates', 'enrol_programs');
            }
            $allocationrecord->sourcetype = $source->type;
            $allocationrecord->deletesupported = $sourceclass::allocation_delete_supported($program, $source, $allocationrecord);
            $allocationrecord->editsupported = $sourceclass::allocation_edit_supported($program, $source, $allocationrecord);
        } else {
            throw new \invalid_parameter_exception('Cannot update');
        }

        return (array) $allocationrecord;
    }

    /**
     * Describes the external function parameters.
     *
     * @return \external_single_structure
     */
    public static function execute_returns(): \external_single_structure {
        return new \external_single_structure([
            'id' => new external_value(PARAM_INT, 'Program allocation id'),
            'programid' => new external_value(PARAM_INT, 'Program id'),
            'userid' => new external_value(PARAM_INT, 'User id'),
            'sourceid' => new external_value(PARAM_INT, 'Allocation source id'),
            'archived' => new external_value(PARAM_BOOL, 'Archived flag (Archived allocations do not change)'),
            'sourcedatajson' => new external_value(PARAM_RAW, 'Source data json (internal)'),
            'sourceinstanceid' => new external_value(PARAM_INT, 'Allocation source instance id (internal)'),
            'timeallocated' => new external_value(PARAM_INT, 'Allocation date'),
            'timestart' => new external_value(PARAM_INT, 'Allocation start date'),
            'timedue' => new external_value(PARAM_INT, 'Allocation due date'),
            'timeend' => new external_value(PARAM_INT, 'Allocation end date'),
            'timecompleted' => new external_value(PARAM_INT, 'Allocation completed date'),
            'timecreated' => new external_value(PARAM_INT, 'Allocation created date'),
            'sourcetype' => new external_value(PARAM_ALPHANUMEXT, 'Internal source name'),
            'deletesupported' => new external_value(PARAM_BOOL, 'Flag to indicate if delete is supported'),
            'editsupported' => new external_value(PARAM_BOOL, 'Flag to indicate if edit is supported'),
        ], 'Details of the  program allocation');
    }
}