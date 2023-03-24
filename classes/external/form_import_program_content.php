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

/**
 * Provides list of programs from which the user can import content.
 *
 * @package     enrol_programs
 * @copyright   2023 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class form_import_program_content extends \local_openlms\external\form_autocomplete_field {
    /**
     * True means returned field data is array, false means value is scalar.
     *
     * @return bool
     */
    public static function is_multi_select_field(): bool {
        return false;
    }

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'query' => new external_value(PARAM_RAW, 'The search query', VALUE_REQUIRED),
            'programid' => new external_value(PARAM_INT, 'Program id', VALUE_REQUIRED),
        ]);
    }

    /**
     * Gets list of available programs.
     *
     * @param string $query The search request.
     * @param int $programid The Program to which the program has to be imported, we will exclude this program.
     * @return array
     */
    public static function execute(string $query, int $programid): array {
        global $DB;

        $params = self::validate_parameters(self::execute_parameters(),
            ['query' => $query, 'programid' => $programid]);
        $query = $params['query'];
        $programid = $params['programid'];


        $targetprogram = $DB->get_record('enrol_programs_programs', ['id' => $programid]);
        $context = \context::instance_by_id($targetprogram->contextid);

        $targetprogramtenantid = $DB->get_field('context', 'tenantid', ['id' => $context->id]);
        self::validate_context($context);
        require_capability('enrol/programs:edit', $context);

        $sql = "SELECT p.*, c.tenantid
                  FROM {enrol_programs_programs} p
                  JOIN {context} c ON c.id = p.contextid
                 WHERE ".$DB->sql_like('fullname', ':query', false);
        $params = ['query' => $query.'%'];
        if ($targetprogramtenantid) {
            $sql .= " AND (c.tenantid = :tenantid OR c.tenantid IS NULL)";
            $params['tenantid'] = $targetprogramtenantid;
        }
        $programs = $DB->get_records_sql($sql, $params);

        unset($programs[$programid]);

        $notice = null;
        $list = [];
        foreach ($programs as $program) {
            $context = \context::instance_by_id($program->contextid);
            if (has_capability('enrol/programs:clone', $context)) {
                self::validate_context($context);
                $list[] = ['value' => $program->id, 'label' => $program->fullname];
            }
        }

        return [
            'notice' => $notice,
            'list' => $list,
        ];
    }

}