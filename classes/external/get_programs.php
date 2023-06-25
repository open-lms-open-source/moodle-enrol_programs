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
                        'field' => new external_value(PARAM_ALPHANUM, 'The name of the field to be searched by list of'
                            . ' acceptable fields is : id, contextid, fullname, idnumber, public, archived, tenantid'),
                        'value' => new external_value(PARAM_RAW, 'Value of the field to be searched, NULL allowed only for tenantid')
                    ]), 'Program search parameters'
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
        $fieldvalues = self::validate_parameters(self::execute_parameters(),
            ['fieldvalues' => $fieldvalues])['fieldvalues'];

        $allowedfieldlist = ['id', 'contextid', 'fullname', 'idnumber', 'public', 'archived', 'tenantid'];
        $params = [];
        $where = [];
        $tenantjoin = '';
        foreach ($fieldvalues as $fieldvalue) {
            list('field' => $field, 'value' => $value) = $fieldvalue;
            if (!in_array($field, $allowedfieldlist, true)) {
                throw new \invalid_parameter_exception('Invalid field name: '. $field);
            }
            if (array_key_exists($field, $params)) {
                throw new \invalid_parameter_exception('Invalid duplicate field name: '. $field);
            }
            if ($field === 'tenantid') {
                if (!\enrol_programs\local\tenant::is_available()) {
                    throw new \invalid_parameter_exception('Invalid field name: '. $field);
                }
                if ($value === null) {
                    $tenantjoin = "JOIN {context} c ON c.id = p.contextid AND c.tenantid IS NULL";
                } else {
                    $tenantjoin = "JOIN {context} c ON c.id = p.contextid AND c.tenantid = :tenantid";
                }
            } else {
                if ($value === null) {
                    throw new \invalid_parameter_exception('Field value cannot be NULL: '. $field);
                }
                $where[] = "p.$field = :$field";
            }
            $params[$field] = $value;
        }
        if ($where) {
            $where = 'WHERE ' . implode(' AND ', $where);
        } else {
            $where = '';
        }
        $sql = "SELECT p.*
                  FROM {enrol_programs_programs} p
           $tenantjoin
                $where
              ORDER BY p.id ASC";
        $programs = $DB->get_records_sql($sql, $params);

        $results = [];
        foreach ($programs as $program) {
            $context = \context::instance_by_id($program->contextid);
            if (has_capability('enrol/programs:view', $context)) {
                self::validate_context($context);
                $sources = $DB->get_records_menu('enrol_programs_sources',
                    ['programid' => $program->id], 'type ASC', 'type');
                $program->sources = array_keys($sources);
                if ($program->public) {
                    $program->cohortids = [];
                } else {
                    $cohorts = $DB->get_records_menu('enrol_programs_cohorts',
                        ['programid' => $program->id], 'cohortid ASC', 'cohortid');
                    $program->cohortids = array_keys($cohorts);
                }
                $results[] = $program;
            }
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
                'id' => new external_value(PARAM_INT, 'Program id'),
                'contextid' => new external_value(PARAM_INT, 'Program context id'),
                'fullname' => new external_value(PARAM_TEXT, 'Program fullname'),
                'idnumber' => new external_value(PARAM_RAW, 'Program idnumber'),
                'description' => new external_value(PARAM_RAW, 'Program description text (in original text format)'),
                'descriptionformat' => new external_value(PARAM_INT, 'Program description text format'),
                'presentationjson' => new external_value(PARAM_RAW, 'Presentation json (not stable internal API data)'),
                'public' => new external_value(PARAM_BOOL, 'Public flag'),
                'archived' => new external_value(PARAM_BOOL, 'Archived flag (archived problems do not change)'),
                'creategroups' => new external_value(PARAM_BOOL, 'Create course groups flag'),
                'timeallocationstart' => new external_value(PARAM_INT, 'Allocation start date'),
                'timeallocationend' => new external_value(PARAM_INT, 'Allocation end date'),
                'startdatejson' => new external_value(PARAM_RAW, 'Start date calculation logic in json format'),
                'duedatejson' => new external_value(PARAM_RAW, 'Due date calculation logic in json format'),
                'enddatejson' => new external_value(PARAM_RAW, 'End date calculation logic in json format'),
                'timecreated' => new external_value(PARAM_INT, 'Program creation date'),
                'sources' => new \external_multiple_structure(
                    new external_value(PARAM_ALPHANUMEXT, 'Internal source name'), 'Enabled allocation sources'
                ),
                'cohortids' => new \external_multiple_structure(
                    new external_value(PARAM_INT, 'Cohort id'), 'Visible cohorts for non-public programs'
                ),
            ], 'List of programs')
        );
    }
}