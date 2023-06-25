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
use external_api;
use external_function_parameters;
use external_value;

global $CFG;
require_once("$CFG->libdir/externallib.php");

/**
 * Provides list of program allocations for given program and optional list of users.
 *
 * @package     enrol_programs
 * @copyright   2023 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class get_program_allocations extends external_api {

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     * TODO For now Moodle does not allow multiple_structure to be null , so have left it as value default and empty array.
     * see MDL-78192 for details, when possible convert empty array to null.
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'programid' => new external_value(PARAM_INT, 'Program id'),
            'userids' => new \external_multiple_structure(
                new external_value(PARAM_INT, 'User id'),
                'List of user ids for whom the program allocation must be fetched',
                VALUE_DEFAULT, [])
        ]);
    }

    /**
     * Returns list of programs allocations for given programid and optional users.
     *
     * @param int $programid Program id
     * @param array $userids Users for whom this info has to be returned (optional).
     * @return array
     */
    public static function execute(int $programid, array $userids = []): array {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_capability('enrol/programs:view', $context);

        $params = self::validate_parameters(self::execute_parameters(),
            ['programid' => $programid, 'userids' => $userids]);

        $userids = $params['userids'];
        $programid = $params['programid'];

        $results = [];
        if (empty($userids)) {
            // TODO: for now treat empty array as all allocations until MDL-78192 adds support for NULLs.
            $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $programid], 'id');
        } else {
            $allocations = [];
            foreach ($userids as $userid) {
                $allocationrecord = $DB->get_record('enrol_programs_allocations', ['programid' => $programid, 'userid' => $userid]);
                if ($allocationrecord) {
                    $allocations[$allocationrecord->id] = $allocationrecord;
                }
            }
            ksort($allocations, SORT_NUMERIC);
        }

        $sourceclasses = allocation::get_source_classes();
        $sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id]);
        foreach ($allocations as $allocation) {
            if (!isset($sources[$allocation->sourceid]) || !isset($sourceclasses[$sources[$allocation->sourceid]->type])) {
                // Ignore invalid data.
                continue;
            }
            $source = $sources[$allocation->sourceid];
            /** @var class-string<\enrol_programs\local\source\base> $sourceclass */
            $sourceclass = $sourceclasses[$source->type];
            $allocation->sourcetype = $source->type;
            $allocation->deletesupported = $sourceclass::allocation_delete_supported($program, $source, $allocation);
            $allocation->editsupported = $sourceclass::allocation_edit_supported($program, $source, $allocation);
            $results[] = $allocation;
        }

        return $results;
    }

    /**
     * Describes the external function parameters.
     *
     * @return \external_multiple_structure
     */
    public static function execute_returns(): \external_multiple_structure {
        return new \external_multiple_structure(
            new \external_single_structure([
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
            ], 'List of program allocations')
        );
    }
}
