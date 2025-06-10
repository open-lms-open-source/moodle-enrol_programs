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
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_value;
use core_external\external_multiple_structure;
use core_external\external_single_structure;

/**
 * Provides list of programs and their overview that the user has been allocated to.
 *
 * @package     enrol_programs
 * @copyright   2025 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class get_my_programsoverview extends external_api {

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'currentpage' => new external_value(PARAM_INT, 'current page'),
        ]);
    }

    /**
     * Returns list of programs allocations for the user.
     *
     * @return array
     */
    public static function execute($currentpage): array {
        global $DB, $OUTPUT, $CFG, $PAGE, $OUTPUT;

        require_login();
        $context = \context_system::instance();
        $params = self::validate_parameters(self::execute_parameters(),
            ['currentpage' => $currentpage]);
        $currentpage = (int)$params['currentpage'];
        $count = allocation::PROGRAMCOUNTPERPAGE;
        $from = ($currentpage - 1) * $count;
        $PAGE->set_context($context);
        $allocations = allocation::get_my_allocations(null, true, $from, $count);

        $programicon = $OUTPUT->pix_icon('program', '', 'enrol_programs');
        $dateformat = get_string('strftimedatefullshort');
        $data = [];

        foreach ($allocations as $allocation) {
            $row = [];
            $row['programicon'] = $programicon;
            $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
            $context = \context::instance_by_id($program->contextid);
            $presentation = (array)json_decode($program->presentationjson);
            if (!empty($presentation['image'])) {
                $imageurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                '/' . $context->id . '/enrol_programs/image/' . $program->id . '/'. $presentation['image'], false);
                $row['thumbnail'] = $imageurl->out();
            } else {
                $row['thumbnail'] = $OUTPUT->get_generated_image_for_id($program->id);
            }

            $fullname = shorten_text(format_string($program->fullname), 23, true);;
            $row['fullnameplain'] = format_string($program->fullname);
            $detailurl = new \moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);
            $row['fullname'] = \html_writer::link($detailurl, $fullname);

            $row['status'] = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

            $row['programstart'] = userdate($allocation->timestart, $dateformat);

            $row['programdue'] = (isset($allocation->timedue) ? userdate($allocation->timedue, $dateformat) : null);

            $row['programend'] = (isset($allocation->timeend) ? userdate($allocation->timeend, $dateformat) : null);

            $data[] = $row;
        }

        return $data;
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_multiple_structure
     */
    public static function execute_returns(): external_multiple_structure {
        return new external_multiple_structure(
            new external_single_structure([
                'fullnameplain' => new external_value(PARAM_TEXT, 'Program fullname without html'),
                'fullname' => new external_value(PARAM_CLEANHTML, 'Program fullname'),
                'status' => new external_value(PARAM_CLEANHTML, 'Program status'),
                'thumbnail' => new external_value(PARAM_CLEANHTML, 'Program image'),
                'programstart' => new external_value(PARAM_CLEANHTML, 'Program start', VALUE_OPTIONAL),
                'programdue' => new external_value(PARAM_CLEANHTML, 'Program due', VALUE_OPTIONAL),
                'programend' => new external_value(PARAM_CLEANHTML, 'Program end', VALUE_OPTIONAL),
            ], 'List of users own program allocations')
        );
    }
}
