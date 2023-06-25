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

global $CFG;
require_once("$CFG->libdir/externallib.php");

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
            ], 'Array of updates for timestart, timedue, timeend can be passed as unix timestamps', VALUE_DEFAULT, []),
            'archived' => new external_value(PARAM_BOOL, 'Archived flag', VALUE_DEFAULT, null)
        ]);
    }

    /**
     * Updates the allocation for the given userid and programid.
     *
     * @param int $programid Program id.
     * @param int $userid User id.
     * @param array $allocationdates optional allocation dates.
     * @param ?bool $archived Optional archived flag.
     * @return \stdClass
     */
    public static function execute(int $programid, int $userid, array $allocationdates = [], ?bool $archived = null): \stdClass {
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

        $allocation = $DB->get_record('enrol_programs_allocations',
            ['programid' => $programid, 'userid' => $userid], '*', MUST_EXIST);

        $sourceclasses = allocation::get_source_classes();
        $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid]);
        if (!$source || !isset($sourceclasses[$source->type])) {
            throw new \invalid_parameter_exception('Invalid allocation data');
        }

        /** @var class-string<\enrol_programs\local\source\base> $sourceclass */
        $sourceclass = $sourceclasses[$source->type];

        if (!$sourceclass::allocation_edit_supported($program, $source, $allocation)) {
            throw new \invalid_parameter_exception('Allocation data cannot be update');
        }

        if ($archived !== null) {
            $allocation->archived = (int)$archived;
        }
        foreach ($allocationdates as $name => $value) {
            if ($name !== 'timestart' && $name !== 'timedue' && $name !== 'timeend') {
                throw new \invalid_parameter_exception('Invalid date type');
            }
            $allocation->$name = $value;
        }
        $errors = allocation::validate_allocation_dates(
            $allocation->timestart, $allocation->timedue, $allocation->timeend);
        if ($errors) {
            throw new \invalid_parameter_exception('Allocation dates are invalid');
        }

        $allocation = allocation::update_user($allocation);
        $allocation->sourcetype = $source->type;
        $allocation->deletesupported = $sourceclass::allocation_delete_supported($program, $source, $allocation);
        $allocation->editsupported = $sourceclass::allocation_edit_supported($program, $source, $allocation);

        return $allocation;
    }

    /**
     * Describes the external function parameters.
     *
     * @return \external_single_structure
     */
    public static function execute_returns(): \external_single_structure {
        // NOTE: This matches \enrol_programs\external\get_program_allocations::execute_returns().
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
