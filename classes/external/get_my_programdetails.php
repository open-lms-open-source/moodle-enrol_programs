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
use enrol_programs\local\program;
use enrol_programs\local\util;

/**
 * Provides list of details of a particular program and allocation details that the user has been allocated to.
 *
 * @package     enrol_programs
 * @copyright   2025 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class get_my_programdetails extends external_api {

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'programid' => new external_value(PARAM_INT, 'Program id'),
            'sourceid' => new external_value(PARAM_INT, 'source id'),
            'allocationid' => new external_value(PARAM_INT, 'Allocation id'),
        ]);
    }

    /**
     * Returns list of programs allocations for the user.
     *
     * @return array
     */
    public static function execute(int $programid, int $sourceid, int $allocationid): array {
        global $DB, $OUTPUT, $CFG, $PAGE, $OUTPUT;
        require_once($CFG->libdir .'/filelib.php');
        require_login();
        $context = \context_system::instance();
        $PAGE->set_context($context);
        $params = self::validate_parameters(self::execute_parameters(),
            ['programid' => $programid, 'allocationid' => $allocationid, 'sourceid' => $sourceid]);
        $programid = $params['programid'];
        $allocationid = $params['allocationid'];
        $sourceid = $params['sourceid'];

        $source = $DB->get_record('enrol_programs_sources', array('id' => $sourceid), '*', MUST_EXIST);
        $allocation = $DB->get_record('enrol_programs_allocations', array('id' => $allocationid), '*', MUST_EXIST);
        $program = $DB->get_record('enrol_programs_programs', array('id' => $programid), '*', MUST_EXIST);

        $strnotset = get_string('notset', 'enrol_programs');

        $sourceclasses = allocation::get_source_classes();
        /** @var \enrol_programs\local\source\base $sourceclass */
        $sourceclass = $sourceclasses[$source->type];
        $data = [];
        $allocationresult = '';
        $completiondelaytext = '';
        $data['completionstatus'] = allocation::get_completion_status_html($program, $allocation);
        $data['allocationsource'] = $sourceclass::render_allocation_source($program, $source, $allocation);
        $data['allocationdate'] =  userdate($allocation->timeallocated);
        $data['programstart'] = userdate($allocation->timestart);
        $data['programdue'] =  (isset($allocation->timedue) ? userdate($allocation->timedue) : $strnotset);
        $data['programend'] =  (isset($allocation->timeend) ? userdate($allocation->timeend) : $strnotset);
        $data['completiondate'] = (isset($allocation->timecompleted) ? userdate($allocation->timecompleted) : $strnotset);
        $top = program::load_content($program->id);
        $data['sequencetype'] = $top->get_sequencetype_info();
        if ($completiondelay = $top->get_completiondelay()) {
            $completiondelaytext = util::format_duration($completiondelay);
        }
        $data['completiondelaytext'] = $completiondelaytext;
        $customfieldoutput = $PAGE->get_renderer('enrol_programs', 'customfield');
        $data['customfields'] = $customfieldoutput->render_customfields($program->id);

        $context = \context::instance_by_id($program->contextid);
        $data['fullname'] = format_string($program->fullname);

        $description = \file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $context->id, 'enrol_programs', 'description', $program->id);
        $data['description'] = format_text($description, $program->descriptionformat, ['context' => $context]);

        $tagsdiv = '';
        if ($CFG->usetags) {
            $tags = \core_tag_tag::get_item_tags('enrol_programs', 'program', $program->id);
            if ($tags) {
                $tagsdiv = $OUTPUT->tag_list($tags, '', 'program-tags');
            }
        }
        $data['tagsdiv'] = $tagsdiv;
        $presentation = (array)json_decode($program->presentationjson);
        if (!empty($presentation['image'])) {
            $imageurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                '/' . $context->id . '/enrol_programs/image/' . $program->id . '/'. $presentation['image'], false);
            $data['thumbnail'] = $imageurl->out();
        } else {
            $data['thumbnail'] = $OUTPUT->get_generated_image_for_id($program->id);
        }
        $data['programicon'] = $OUTPUT->pix_icon('program', '', 'enrol_programs');
        $data['programid'] = $program->id;
        $layoutconfig = get_config('enrol_programs', 'programslayout');
        $userpref = get_user_preferences('enrol_programs_detailpage_user_view_preference') ?? $layoutconfig;
        $data['viewtable'] = $data['viewgrid'] = false;

        if ($userpref == 'table') {
            $data['viewtable'] = true;
        } else {
            $data['viewgrid'] = true;
        }
        $data['isprogramdetailpage'] = true;
        return $data;
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_multiple_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'fullname' => new external_value(PARAM_CLEANHTML, 'Program fullname'),
            'completionstatus' => new external_value(PARAM_CLEANHTML, 'Program status'),
            'allocationsource' => new external_value(PARAM_TEXT, 'Allocation source'),
            'allocationdate' => new external_value(PARAM_TEXT, 'Program allocationdate'),
            'description' => new external_value(PARAM_CLEANHTML, 'Program desciption'),
            'thumbnail' => new external_value(PARAM_TEXT, 'Program image'),
            'programicon' => new external_value(PARAM_RAW, 'Program icon'),
            'tagsdiv' => new external_value(PARAM_CLEANHTML, 'Program tags'),
            'customfields' => new external_value(PARAM_CLEANHTML, 'Program customfields'),
            'programstart' => new external_value(PARAM_TEXT, 'Program start', VALUE_OPTIONAL),
            'programdue' => new external_value(PARAM_TEXT, 'Program due', VALUE_OPTIONAL),
            'programend' => new external_value(PARAM_TEXT, 'Program end', VALUE_OPTIONAL),
            'completiondate' => new external_value(PARAM_TEXT, 'Program completiondate', VALUE_OPTIONAL),
            'sequencetype' => new external_value(PARAM_TEXT, 'Program sequencetype', VALUE_OPTIONAL),
        ], 'Details about a program for a user');

    }
}
