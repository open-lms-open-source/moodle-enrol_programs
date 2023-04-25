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

use context_system;
use core_user;
use core_user\fields;
use enrol_programs\local\source\manual;
use external_api;
use external_description;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;

/**
 * Gets the allocation source for a user and program.
 *
 * @package     enrol_programs
 * @copyright   2023 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class get_allocation_source extends external_api {

    /**
     * Gets the allocation source for a user and program.
     *
     * @param int $userid Userid.
     * @param int $programid Programid.
     * @return bool
     */
    public static function execute(int $userid, int $programid) {
        global $DB;
        $params = external_api::validate_parameters(self::execute_parameters(),
                ['userid' => $userid, 'programid' => $programid]);

        $userid = $params['userid'];
        $programid = $params['programid'];

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_capability('enrol/programs:allocate', $context);

        // TODO check what is to be done if the manual source is not added.
        $source = $DB->get_record('enrol_programs_sources', ['programid' => $programid, 'type' => 'manual'], '*', MUST_EXIST);


        return $source;
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'userid' => new external_value(PARAM_INT, 'User id', VALUE_REQUIRED),
            'programid' => new external_value(PARAM_INT, 'Program id', VALUE_REQUIRED),
        ]);
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_description
     */
    public static function execute_returns(): external_description {
        return new external_single_structure([
            'id' => new external_value(PARAM_INT, 'ID of the source'),
            'type' => new external_value(PARAM_TEXT, 'type'),
            'datajson' => new external_value(PARAM_TEXT, 'datajson')
        ]);
    }

}