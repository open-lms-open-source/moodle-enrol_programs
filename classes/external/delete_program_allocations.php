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
                , 'User ids to be allocated the program')
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
        $userids = $params['userids'];
        $programid = $params['programid'];

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_capability('enrol/programs:allocate', $context);

        $useridsdeallocated = [];
        $sourceclasses = allocation::get_source_classes();
        $sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id]);

        foreach ($userids as $userid) {
            $allocationrecord = $DB->get_record('enrol_programs_allocations', ['programid' => $programid, 'userid' => $userid]);

            if (!$allocationrecord || !isset($sources[$allocationrecord->sourceid]) || !isset($sourceclasses[$sources[$allocationrecord->sourceid]->type])) {
                // Ignore invalid data.
                continue;
            }
            $source = $sources[$allocationrecord->sourceid];
            /** @var class-string<\enrol_programs\local\source\base> $sourceclass */
            $sourceclass = $sourceclasses[$source->type];

            if ($sourceclass::allocation_delete_supported($program, $source, $allocationrecord)) {
                $sourceclass::deallocate_user($program, $source, $allocationrecord);
                $useridsdeallocated[] = $userid;
            }

        }

        return $useridsdeallocated;
    }
    /**
     * Describes the external function parameters.
     *
     * @return external_description
     */
    public static function execute_returns(): \external_multiple_structure {
        return new \external_multiple_structure(
            new external_value(PARAM_INT, 'User id')
            , 'List of users who were de allocated');
    }
}