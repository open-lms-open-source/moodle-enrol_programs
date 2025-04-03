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

use core_course\external\course_summary_exporter;
use enrol_programs\local\allocation;
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_value;
use core_external\external_multiple_structure;
use core_external\external_single_structure;
use enrol_programs\local\content\course;
use enrol_programs\local\content\item;
use enrol_programs\local\content\set;
use enrol_programs\local\content\top;
use enrol_programs\local\content\training;
use enrol_programs\local\program;
use enrol_programs\local\util;

/**
 * Provides list of program user progress.
 *
 * @package     enrol_programs
 * @copyright   2025 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class get_my_programuserprogress extends external_api {

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'programid' => new external_value(PARAM_INT, 'Program id'),
            'allocationid' => new external_value(PARAM_INT, 'Allocation id')
        ]);
    }

    /**
     * Returns list of programs allocations for the user.
     *
     * @return array
     */
    public static function execute(int $programid, int $allocationid): string {
        global $DB, $OUTPUT, $CFG, $PAGE, $OUTPUT;
        require_once($CFG->libdir .'/filelib.php');
        $params = self::validate_parameters(self::execute_parameters(),
            ['programid' => $programid, 'allocationid' => $allocationid]);
        $allocationid = $params['allocationid'];
        $programid = $params['programid'];
        $allocation = $DB->get_record('enrol_programs_allocations', array('id' => $allocationid), '*', MUST_EXIST);
        $program = $DB->get_record('enrol_programs_programs', array('id' => $programid), '*', MUST_EXIST);
        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_login();

        $myouput = $PAGE->get_renderer('enrol_programs', 'my');

        return $myouput->render_user_progress($program, $allocation);
    }

    /**
     * Describes the external function parameters.
     *
     * Since the output of the user progress contains a program tree that can have any number of children nested, it is difficult
     * to define the structure of the webservice properly, so for now this directly uses the html output of the render method.
     *
     * @return external_multiple_structure
     */
    public static function execute_returns(): external_value {
        return new external_value(PARAM_RAW, 'html of the program user progress');
    }
}
