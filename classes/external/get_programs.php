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

/**
 * Provides list of programs based on search parameters.
 *
 * @package     enrol_programs
 * @copyright   2023 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class get_programs extends external_api {

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'fieldvalues' => new \external_multiple_structure(
                new \external_single_structure(
                    [
                        'field' => new external_value(PARAM_ALPHANUM, 'The name of the field to be searched by
    list of acceptable fields is : id, contextid, fullname, idnumber, public, archived, tenantid'),
                        'value' => new external_value(PARAM_RAW, 'Value of the field to be searched')
                    ])
            )
        ]);
    }

    /**
     * Returns list of programs matching the given query.
     *
     * @param array $fieldvalues Key value pairs.
     * @return array
     */
    public static function execute(array $fieldvalues): array {
        global $DB;
        $params = self::validate_parameters(self::execute_parameters(),
            ['fieldvalues' => $fieldvalues]);
        $fieldvalues = $params['fieldvalues'];

        $allowedfieldlist = ['id', 'contextid', 'fullname', 'idnumber', 'public', 'archived', 'tenantid'];
        $params = [];
        foreach ($fieldvalues as $fieldvalue) {
            if (!in_array($fieldvalue['field'], $allowedfieldlist)) {
                throw new \invalid_parameter_exception('Invalid field name'. $fieldvalue['field']);
            }
            $params[$fieldvalue['field']] = $fieldvalue['value'];
        }

        if (array_key_exists('tenantid', $params)) {
            $sql = "SELECT p.*
                      FROM {enrol_programs_programs} p
                      JOIN {context} c ON c.id = p.contextid
                     WHERE c.tenantid = :tenantid ";
            foreach ($params as $key => $value) {
                if ($key != 'tenantid') {
                    $sql .= "AND p.$key = :$key ";
                }
            }
            $programs = $DB->get_records_sql($sql, $params);
        } else {
            $programs = $DB->get_records('enrol_programs_programs', $params);
        }

        $results = [];
        foreach ($programs as $program) {
            $context = \context::instance_by_id($program->contextid);
            self::validate_context($context);
            if (has_capability('enrol/programs:view', $context)) {
                list($program->description, $format) = external_format_text($program->description, FORMAT_HTML, $context);
                $sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id], 'id', 'type');
                $program->sources = array_keys($sources);
                $results[] = $program;
            }
        }

        return $results;
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_description
     */
    public static function execute_returns(): \external_multiple_structure {
        return new \external_multiple_structure(
            new \external_single_structure([
                'id' => new external_value(PARAM_INT, 'Program id'),
                'contextid' => new external_value(PARAM_INT, 'context id'),
                'fullname' => new external_value(PARAM_RAW, 'Program fullname'),
                'idnumber' => new external_value(PARAM_RAW, 'Program idnumber'),
                'description' => new external_value(PARAM_RAW, 'Program description'),
                'descriptionformat' => new external_value(PARAM_INT, 'Description format'),
                'presentationjson' => new external_value(PARAM_RAW, 'Presentation json / Not stable API data'),
                'public' => new external_value(PARAM_INT, 'public'),
                'archived' => new external_value(PARAM_INT, 'archived'),
                'creategroups' => new external_value(PARAM_INT, 'create groups'),
                'timeallocationstart' => new external_value(PARAM_INT, 'time allocation start'),
                'timeallocationend' => new external_value(PARAM_INT, 'time allocation end'),
                'startdatejson' => new external_value(PARAM_RAW, 'start date json'),
                'duedatejson' => new external_value(PARAM_RAW, 'due date json'),
                'enddatejson' => new external_value(PARAM_RAW, 'end date json'),
                'timecreated' => new external_value(PARAM_INT, 'time created'),
                'sources' => new \external_multiple_structure(
                    new external_value(PARAM_ALPHANUMEXT, 'source name')
                )
            ])
        );
    }

}