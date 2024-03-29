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

use external_function_parameters;
use external_value;
use external_api;

global $CFG;
require_once("$CFG->libdir/externallib.php");

/**
 * Provides list of cohorts that are synchronized with a program.
 *
 * @package     enrol_programs
 * @copyright   2023 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class source_cohort_get_cohorts extends external_api {

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'programid' => new external_value(PARAM_INT, 'Program id')
        ]);
    }

    /**
     * Returns list of cohorts that are synced with the program.
     *
     * @param int $programid Program id to which the cohort has to be added.
     * @return array
     */
    public static function execute(int $programid): array {
        global $DB;
        $params = self::validate_parameters(self::execute_parameters(), ['programid' => $programid]);
        $programid = $params['programid'];

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_capability('enrol/programs:view', $context);

        return self::get_cohorts($program->id);
    }

    /**
     * Describes the external function parameters.
     *
     * @return \external_multiple_structure
     */
    public static function execute_returns(): \external_multiple_structure {
        return self::get_cohorts_returns();
    }

    /**
     * Description of get_cohorts() result.
     *
     * @return \external_multiple_structure
     */
    public static function get_cohorts_returns(): \external_multiple_structure {
        return new \external_multiple_structure(
            new \external_single_structure([
                'id' => new external_value(PARAM_INT, 'Cohort id'),
                'contextid' => new external_value(PARAM_INT, 'Cohort context id'),
                'name' => new external_value(PARAM_TEXT, 'Cohort name'),
                'idnumber' => new external_value(PARAM_RAW, 'Cohort idnumber'),
            ], 'List of cohorts that are synced with the program')
        );
    }

    /**
     * Returns cohorts synced with program.
     *
     * @param int $programid
     * @return array
     */
    public static function get_cohorts(int $programid): array {
        global $DB;

        $sql = "SELECT c.id, c.contextid, c.name, c.idnumber
                  FROM {enrol_programs_src_cohorts} sc
                  JOIN {cohort} c ON c.id = sc.cohortid
                  JOIN {enrol_programs_sources} ps ON ps.id = sc.sourceid
                 WHERE ps.programid = :programid and ps.type = 'cohort'
              ORDER BY id ASC";

        $cohorts = $DB->get_records_sql($sql, ['programid' => $programid]);
        return array_values($cohorts);
    }
}
