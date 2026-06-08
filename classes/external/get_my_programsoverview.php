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
            'perpage'     => new external_value(PARAM_INT, 'per page', VALUE_DEFAULT, allocation::PROGRAMCOUNTPERPAGE),
            'status' => new external_value(PARAM_TEXT, 'status', VALUE_DEFAULT, ''),
            'search' => new external_value(PARAM_TEXT, 'search', VALUE_DEFAULT, ''),
            'orderby' => new external_value(PARAM_TEXT, 'sort by', VALUE_DEFAULT, ''),
        ]);
    }

    /**
     * Returns list of programs allocations for the user.
     *
     * @return array
     */
    public static function execute($currentpage, $perpage, $status, $search, $orderby): array {
        global $DB, $OUTPUT, $CFG, $PAGE, $OUTPUT;

        require_login();
        $context = \context_system::instance();
        $params = self::validate_parameters(self::execute_parameters(),
            ['currentpage' => $currentpage, 'status' => $status, 'perpage' => $perpage, 'search' => $search, 'orderby' => $orderby]);
        $currentpage = (int)$params['currentpage'];
        $perpage = (int)$params['perpage'];
        $filterstatus = $params['status'];
        $from = ($currentpage - 1) * $perpage;
        $PAGE->set_context($context);

        // Get all matching allocations for accurate total count with status filter.
        $allallocations = allocation::get_my_allocations(null, $params['orderby'], 0, null, $params['search']);
        // Apply status filter to get accurate total.
        $sourceclasses = allocation::get_source_classes();
        $filtered = [];
        foreach ($allallocations as $allocation) {
            if (!empty($filterstatus) && $filterstatus !== 'programstatus_any') {
                $program    = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
                $statusplain = \enrol_programs\local\allocation::get_completion_status_plain($program, $allocation);
                if ($statusplain !== get_string($filterstatus, 'enrol_programs')) {
                    continue;
                }
            }
            $filtered[] = $allocation;
        }

        $totalcount = count($filtered);
        if ($perpage) {
            $totalpages = (int)ceil($totalcount / $perpage);
            $totalpages = max(1, $totalpages);
            $pagedallocations = array_slice($filtered, $from, $perpage);
        } else {
            $totalpages = 1;
            $pagedallocations = $filtered;
        }
        $programicon = $OUTPUT->pix_icon('program', '', 'enrol_programs');
        $dateformat  = get_string('strftimedateformatprograms', 'enrol_programs');
        $data = [];

        foreach ($pagedallocations as $allocation) {
            $row     = [];
            $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
            $context = \context::instance_by_id($program->contextid);
            $presentation = (array) json_decode($program->presentationjson);

            $row['programicon'] = $programicon;

            if (!empty($presentation['image'])) {
                $imageurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                        '/' . $context->id . '/enrol_programs/image/' . $program->id . '/' . $presentation['image'], false);
                $row['thumbnail'] = $imageurl->out();
            } else {
                $row['thumbnail'] = $OUTPUT->get_generated_image_for_id($program->id);
            }

            $fullname = shorten_text(format_string($program->fullname), 23, true);
            $row['fullnameplain'] = format_string($program->fullname);
            $detailurl = new \moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);
            $row['fullname'] = \html_writer::link($detailurl, $fullname, ['title' => format_string($program->fullname)]);
            $row['idnumber'] = $program->idnumber;
            $row['description'] = $program->description;
            $row['status'] = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

            $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid], '*', MUST_EXIST);
            $sourceclass = $sourceclasses[$source->type];
            $row['source'] = $sourceclass::render_allocation_source($program, $source, $allocation);
            $row['programstart'] = userdate($allocation->timestart, $dateformat);
            $row['programdue'] = isset($allocation->timedue) ? userdate($allocation->timedue, $dateformat) : null;
            $row['programend'] = isset($allocation->timeend) ? userdate($allocation->timeend, $dateformat) : null;

            $data[] = $row;
        }

        return [
            'programs'   => $data,
            'totalpages' => $totalpages,
            'totalcount' => $totalcount,
        ];
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_multiple_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'totalpages' => new external_value(PARAM_INT, 'Total number of pages'),
            'totalcount' => new external_value(PARAM_INT, 'Total number of programs'),
            'programs' => new external_multiple_structure(
                new external_single_structure([
                    'fullnameplain' => new external_value(PARAM_TEXT, 'Program fullname without html'),
                    'fullname' => new external_value(PARAM_CLEANHTML, 'Program fullname'),
                    'idnumber' => new external_value(PARAM_TEXT, 'Program idnumber'),
                    'description' => new external_value(PARAM_RAW, 'Program description'),
                    'status' => new external_value(PARAM_CLEANHTML, 'Program status'),
                    'source' => new external_value(PARAM_CLEANHTML, 'Allocation source information'),
                    'thumbnail' => new external_value(PARAM_CLEANHTML, 'Program image'),
                    'programstart' => new external_value(PARAM_CLEANHTML, 'Program start', VALUE_OPTIONAL),
                    'programdue' => new external_value(PARAM_CLEANHTML, 'Program due', VALUE_OPTIONAL),
                    'programend' => new external_value(PARAM_CLEANHTML, 'Program end', VALUE_OPTIONAL),
                ], 'List of users own program allocations')
            ),
        ]);
    }
}
