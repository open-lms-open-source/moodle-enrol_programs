<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace enrol_programs\output\my;

use core_course\external\course_summary_exporter;
use enrol_programs\local\allocation;
use enrol_programs\local\program;
use enrol_programs\local\util;
use enrol_programs\local\content\item,
    enrol_programs\local\content\top,
    enrol_programs\local\content\set,
    enrol_programs\local\content\course,
    enrol_programs\local\content\training;
use stdClass, moodle_url, tabobject;

/**
 * Program catalogue renderer.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {

    public function render_programinfo_and_user_allocation(stdClass $program, stdClass $source, stdClass $allocation): string {
        global $CFG, $OUTPUT, $PAGE;
        $strnotset = get_string('notset', 'enrol_programs');

        $sourceclasses = allocation::get_source_classes();
        /** @var \enrol_programs\local\source\base $sourceclass */
        $sourceclass = $sourceclasses[$source->type];
        $data = [];
        $allocationresult = '';
        $data['completionstatus'] = allocation::get_completion_status_html($program, $allocation);
        $data['allocationsource'] = $sourceclass::render_allocation_source($program, $source, $allocation);
        $data['allocationdate'] =  userdate($allocation->timeallocated);
        $data['programstart'] = userdate($allocation->timestart);
        $data['programdue'] =  (isset($allocation->timedue) ? userdate($allocation->timedue) : $strnotset);
        $data['programend'] =  (isset($allocation->timeend) ? userdate($allocation->timeend) : $strnotset);
        $data['completiondate'] = (isset($allocation->timecompleted) ? userdate($allocation->timecompleted) : $strnotset);
        $top = program::load_content($program->id);
        $data['sequencetype'] = $top->get_sequencetype_info();
        $customfieldoutput = $PAGE->get_renderer('enrol_programs', 'customfield');
        $data['customfields'] = $customfieldoutput->render_customfields($program->id);
        
        $context = \context::instance_by_id($program->contextid);
        $data['fullname'] = format_string($program->fullname);

        $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $context->id, 'enrol_programs', 'description', $program->id);
        $data['description'] = format_text($description, $program->descriptionformat, ['context' => $context]);

        $tagsdiv = '';
        if ($CFG->usetags) {
            $tags = \core_tag_tag::get_item_tags('enrol_programs', 'program', $program->id);
            if ($tags) {
                $tagsdiv = $this->output->tag_list($tags, '', 'program-tags');
            }
        }
        $data['tagsdiv'] = $tagsdiv;
        $presentation = (array)json_decode($program->presentationjson);
        if (!empty($presentation['image'])) {
            $imageurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                '/' . $context->id . '/enrol_programs/image/' . $program->id . '/'. $presentation['image'], false);
            $data['thumbnail'] = $imageurl;
        } else {
            $data['thumbnail'] = $OUTPUT->get_generated_image_for_id($program->id);
        }
        $data['programicon'] = $this->output->pix_icon('program', '', 'enrol_programs');
        $data['programid'] = $program->id;
        $layoutconfig = get_config('enrol_programs', 'programslayout');
        $allowuserlayoutchange = get_config('enrol_programs', 'programslayoutallowuserswitch');
        if ($allowuserlayoutchange) {
            $userpref = get_user_preferences('enrol_programs_detailpage_user_view_preference') ?? $layoutconfig;
        } else {
            $userpref = $layoutconfig;
        }
        $data['viewtable'] = $data['viewgrid'] = false;

        if ($userpref == 'table') {
            $data['viewtable'] = true;
        } else {
            $data['viewgrid'] = true;
        }
        $data['isprogramdetailpage'] = true;
        $data['allowuserlayoutchange'] = $allowuserlayoutchange;

        return $OUTPUT->render_from_template('enrol_programs/programinfocontainer', $data);
    }

    public function render_user_progress(stdClass $program, stdClass $allocation): string {
        global $DB, $OUTPUT;
        $top = program::load_content($program->id);
        $rows = [];
        $programtree = function(item $item, $itemdepth, $parent = null, $sequence = 1) use (&$programtree, &$rows, $allocation, &$DB, &$OUTPUT): array {
            $children = [];
            $isset = false;
            $istraining = false;
            $image = '';
            $disabled = false;
            $completionperct = 0;
            $completiondelaytext = get_string('notset', 'enrol_programs');
            $fullname = $item->get_fullname();
            foreach ($item->get_children() as $child) {
                if ($child instanceof set) {
                    $sequence = 1;
                }
                $children[] = $programtree($child, $itemdepth + 1, $item, $sequence);
                $sequence++;
            }
             if (isset($parent) && $parent->get_sequencetype_info() == 'All in order') {
                    $sequencerequired = true;
                } else {
                    $sequencerequired = false;
                }
            if ($item instanceof set) {
                $completiontype = $item->get_sequencetype_info();
            } else if ($item instanceof training) {
                $istraining = true;
                $completiontype = $item->get_training_progress($allocation);
            } else {
                $completiontype = '';
            }
            if ($completiondelay = $item->get_completiondelay()) {
                $completiondelaytext = '<small>' . get_string('completiondelay', 'enrol_programs') . ': ' . util::format_duration($completiondelay) . '</small>';
            }


            if ($item instanceof top) {
                $sequencerequired = false;
            } else if ($item instanceof set) {
                $isset = true;
            } else if ($item instanceof course) {
                $courseid = $item->get_courseid();
                $coursecontext = \context_course::instance($courseid, IGNORE_MISSING);
                if ($coursecontext) {
                    $canaccesscourse = false;
                    if (has_capability('moodle/course:view', $coursecontext)) {
                        $canaccesscourse = true;
                    } else {
                        $course = get_course($courseid);
                        if ($course && can_access_course($course, null, '', true)) {
                            $canaccesscourse = true;
                        }
                        $completionperct = \core_completion\progress::get_course_progress_percentage($course, $allocation->userid);
                    }
                    if ($canaccesscourse) {
                        $detailurl = new \moodle_url('/course/view.php', ['id' => $courseid]);
                        $fullname = \html_writer::link($detailurl, $fullname);
                    }
                    $image = course_summary_exporter::get_course_image(get_course($courseid));
                    $disabled = !$canaccesscourse;
                } else {
                    $fullname .= ' <span class="badge badge-danger">' . get_string('errorcoursemissing', 'enrol_programs') . '</span>';
                }
                if (!$image) {
                    $image = $OUTPUT->get_generated_image_for_id($courseid);
                }

            } else if ($item instanceof training) {
                $image = $OUTPUT->get_generated_image_for_id($item->get_id());
            }
            $points = $item->get_points();
            $completioninfo = '';
            $completion = $DB->get_record('enrol_programs_completions', ['itemid' => $item->get_id(), 'allocationid' => $allocation->id]);
            if ($completion) {
                $completioninfo = userdate($completion->timecompleted, get_string('strftimedatetimeshort'));
            }
            $padding = str_repeat('&nbsp;', $itemdepth * 6);
            if ($item instanceof top) {
                $icon = $this->output->pix_icon('itemtop', get_string('program', 'enrol_programs'), 'enrol_programs');
            } else if ($item instanceof course) {
                $icon = $this->output->pix_icon('itemcourse', get_string('course'), 'enrol_programs');
            } else if ($item instanceof training) {
                $icon = $this->output->pix_icon('itemtraining', get_string('training', 'enrol_programs'), 'enrol_programs');
            } else {
                $icon = $this->output->pix_icon('itemset', get_string('set', 'enrol_programs'), 'enrol_programs');
            }
            $data = [
                'fullname' => $fullname,
                'children' => $children,
                'isset' => $isset,
                'image' => $image,
                'disabled' => $disabled,
                'completiontype' => $completiontype,
                'points' => $points,
                'completioninfo' => $completioninfo,
                'istraining' => $istraining,
                'completiondelaytext' => $completiondelaytext,
                'parent' => isset($parent) ? $parent->get_fullname() : '',
                'sequence' => $sequence,
                'sequencerequired' => $sequencerequired,
                'completionperct' => $completionperct ?? 0,
                'detailurl' => $detailurl ?? null,
                'simplename' => $item->get_fullname(),
                'padding' => $padding,
                'icon' => $icon,
            ];
            return $data;
        };
        $programitemlist = $programtree($top, 0);
        $layoutconfig = get_config('enrol_programs', 'programslayout');
        $allowuserlayoutchange = get_config('enrol_programs', 'programslayoutallowuserswitch');
        if ($allowuserlayoutchange) {
            $userpref = get_user_preferences('enrol_programs_detailpage_user_view_preference') ?? $layoutconfig;
        } else {
            $userpref = $layoutconfig;
        }
        $programitemlist['viewtable'] = $programitemlist['viewgrid'] = false;

        if ($userpref == 'table') {
            $programitemlist['viewtable'] = true;
        } else {
            $programitemlist['viewgrid'] = true;
        }

        return $OUTPUT->render_from_template('enrol_programs/programcontentcontainer', $programitemlist);
    }

    /**
     * Returns body of My programs block.
     *
     * @return string
     */
    public function render_block_content(): string {
        global $DB, $OUTPUT, $CFG, $PAGE;
        $PAGE->requires->js_call_amd('enrol_programs/selector', 'init');

        $allocations = allocation::get_my_allocations();
        if (!$allocations) {
            return '<em>' . get_string('errornomyprograms', 'enrol_programs') . '</em>';
        }

        $programicon = $this->output->pix_icon('program', '', 'enrol_programs');
        $strnotset = get_string('notset', 'enrol_programs');
        $dateformat = get_string('strftimedatetimeshort');
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
                $row['thumbnail'] = $imageurl;
            } else {
                $row['thumbnail'] = $OUTPUT->get_generated_image_for_id($program->id);
            }

            $fullname = format_string($program->fullname);
            $detailurl = new moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);
            $fullname = \html_writer::link($detailurl, $fullname);
            $row['fullname'] = $fullname;

            $row['status'] = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

            $row['programstart'] = userdate($allocation->timestart, $dateformat);

            $row['programdue'] = (isset($allocation->timedue) ? userdate($allocation->timedue, $dateformat) : $strnotset);

            $row['programend'] = (isset($allocation->timeend) ? userdate($allocation->timeend, $dateformat) : $strnotset);

            $data[] = $row;
        }
        $layoutconfig = get_config('enrol_programs', 'programsblocklayout');
        $allowuserlayoutchange = get_config('enrol_programs', 'programslayoutallowuserswitch');
        if ($allowuserlayoutchange) {
            $userpref = get_user_preferences('enrol_programs_block_user_view_preference') ?? $layoutconfig;
        } else {
            $userpref = $layoutconfig;
        }
        $viewtable = $viewgrid = false;
        if ($userpref == 'table') {
            $viewtable = true;
        } else {
            $viewgrid = true;
        }
        return $OUTPUT->render_from_template('enrol_programs/block_myprograms_overview',
            ['programs' => $data, 'viewtable' => $viewtable, 'viewgrid' => $viewgrid, 'allowuserlayoutchange' => $allowuserlayoutchange]);

    }

    /**
     * Returns footer of My programs block.
     *
     * @return string
     */
    public function render_block_footer(): string {
        $url = \enrol_programs\local\catalogue::get_catalogue_url();
        if ($url) {
            return '<div class="float-end">' . \html_writer::link($url, get_string('catalogue', 'enrol_programs')) . '</div>';
        }
        return '';
    }
}
