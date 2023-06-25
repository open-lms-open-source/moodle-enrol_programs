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
 * Deallocates the given users from the program.
 *
 * @package     enrol_programs
 * @copyright   2023 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class delete_program_allocations extends external_api {
    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'programid' => new external_value(PARAM_INT, 'Program id'),
            'userids' => new \external_multiple_structure(
                new external_value(PARAM_INT, 'User id')
                , 'User ids to be deallocated from program')
        ]);
    }

    /**
     * Deallocates the users from the program.
     *
     * @param int $programid Program id.
     * @param array $userids Users list to whom the program should be deallocated.
     * @return array
     */
    public static function execute(int $programid, array $userids): array {
        global $DB;
        $params = self::validate_parameters(self::execute_parameters(),
            ['programid' => $programid, 'userids' => $userids]);
        $programid = $params['programid'];
        $userids = $params['userids'];

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_capability('enrol/programs:allocate', $context);

        $sourceclasses = allocation::get_source_classes();
        $sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id]);

        // Check all data is valid first.
        $deallocate = [];
        foreach ($userids as $userid) {
            $allocationrecord = $DB->get_record('enrol_programs_allocations',
                ['programid' => $programid, 'userid' => $userid]);
            if (!$allocationrecord) {
                // Not allocated - ignore.
                continue;
            }
            if (!isset($sources[$allocationrecord->sourceid])
                || !isset($sourceclasses[$sources[$allocationrecord->sourceid]->type])) {
                // This was not included in get_program_allocations results.
                throw new \invalid_parameter_exception('Invalid user allocation');
            }
            $source = $sources[$allocationrecord->sourceid];
            /** @var class-string<\enrol_programs\local\source\base> $sourceclass */
            $sourceclass = $sourceclasses[$source->type];

            if (!$sourceclass::allocation_delete_supported($program, $source, $allocationrecord)) {
                // They should have checked data returned from get_program_allocations.
                throw new \invalid_parameter_exception('Cannot deallocate');
            }

            $deallocate[$userid] = [$sourceclass, $source, $allocationrecord];
        }

        // Deallocate after validation of all data.
        foreach ($deallocate as $v) {
            /** @var class-string<\enrol_programs\local\source\base> $sourceclass */
            list($sourceclass, $source, $allocationrecord) = $v;
            $sourceclass::deallocate_user($program, $source, $allocationrecord);
        }

        return array_keys($deallocate);
    }
    /**
     * Describes the external function parameters.
     *
     * @return \external_multiple_structure
     */
    public static function execute_returns(): \external_multiple_structure {
        return new \external_multiple_structure(
            new external_value(PARAM_INT, 'User id')
            , 'List of users who were de allocated');
    }
}