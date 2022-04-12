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
use external_api;
use external_description;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;

/**
 * Provides list of candidates for program allocation.
 *
 * NOTE: this code is based on search identity in core and OLMS tenant plugin.
 *
 * @package     enrol_programs
 * @copyright   2022 Petr Skoda
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class search_candidate extends external_api {

    /**
     * Finds users with the identity matching the given query.
     *
     * @param string $query The search request.
     * @param int $programid The Program.
     * @return array
     */
    public static function execute(string $query, int $programid): array {
        global $DB, $CFG;

        $params = external_api::validate_parameters(self::execute_parameters(),
            ['query' => $query, 'programid' => $programid]);
        $query = $params['query'];
        $programid = $params['programid'];

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);

        // Validate context.
        $context = \context::instance_by_id($program->contextid);
        self::validate_context($context);
        require_capability('enrol/programs:allocate', $context);

        $hasviewfullnames = has_capability('moodle/site:viewfullnames', $context);

        $fields = fields::for_name()->with_identity($context, false);
        $extrafields = $fields->get_required_fields([fields::PURPOSE_IDENTITY]);

        list($searchsql, $searchparams) = users_search_sql($query, 'usr', true, $extrafields);
        list($sortsql, $sortparams) = users_order_by_sql('usr', $query, $context);
        $params = array_merge($searchparams, $sortparams);
        $params['programid'] = $programid;

        // NOTE: hardcoded tenant restrictions would go here too.

        $additionalfields = $fields->get_sql('usr')->selects;
        $sqlquery = <<<SQL
            SELECT usr.id {$additionalfields}
              FROM {user} usr
         LEFT JOIN {enrol_programs_allocations} pa ON (pa.userid = usr.id AND pa.programid = :programid)
             WHERE pa.id IS NULL AND {$searchsql}
          ORDER BY {$sortsql}
SQL;

        $rs = $DB->get_recordset_sql($sqlquery, $params, 0, $CFG->maxusersperpage + 1);

        $count = 0;
        $list = [];

        foreach ($rs as $record) {
            $user = (object) [
                'id' => $record->id,
                'fullname' => fullname($record, $hasviewfullnames),
                'extrafields' => [],
            ];

            foreach ($extrafields as $extrafield) {
                // Sanitize the extra fields to prevent potential XSS exploit.
                $user->extrafields[] = (object) [
                    'name' => $extrafield,
                    'value' => s($record->$extrafield)
                ];
            }

            $count++;

            if ($count <= $CFG->maxusersperpage) {
                $list[$record->id] = $user;
            }
        }
        $rs->close();

        return [
            'list' => $list,
            'maxusersperpage' => $CFG->maxusersperpage,
            'overflow' => ($count > $CFG->maxusersperpage),
        ];
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {

        return new external_function_parameters([
            'query' => new external_value(PARAM_RAW, 'The search query', VALUE_REQUIRED),
            'programid' => new external_value(PARAM_INT, 'Program id'),
        ]);
    }

    /**
     * Describes the external function result value.
     *
     * @return external_description
     */
    public static function execute_returns(): external_description {

        return new external_single_structure([
            'list' => new external_multiple_structure(
                new external_single_structure([
                    'id' => new external_value(core_user::get_property_type('id'), 'ID of the user'),
                    // The output of the {@see fullname()} can contain formatting HTML such as <ruby> tags.
                    // So we need PARAM_RAW here and the caller is supposed to render it appropriately.
                    'fullname' => new external_value(PARAM_RAW, 'The full name of the user'),
                    'extrafields' => new external_multiple_structure(
                        new external_single_structure([
                            'name' => new external_value(PARAM_TEXT, 'Name of the extrafield.'),
                            'value' => new external_value(PARAM_TEXT, 'Value of the extrafield.'),
                        ]), 'List of extra fields', VALUE_OPTIONAL)
                ])
            ),
            'maxusersperpage' => new external_value(PARAM_INT, 'Configured maximum users per page.'),
            'overflow' => new external_value(PARAM_BOOL, 'Were there more records than maxusersperpage found?'),
        ]);
    }
}
