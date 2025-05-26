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

namespace enrol_programs\output\catalogue;

use enrol_programs\local\allocation;
use enrol_programs\local\content\training;
use core_course\external\course_summary_exporter;
use enrol_programs\local\program;
use enrol_programs\local\util;
use enrol_programs\local\content\item,
    enrol_programs\local\content\top,
    enrol_programs\local\content\set,
    enrol_programs\local\content\course;
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
    public function render_program(\stdClass $program): string {
        global $CFG, $DB, $PAGE, $OUTPUT;

        $result = '';
        $context = \context::instance_by_id($program->contextid);
        $completiondelaytext = '';

        $data = [];
        $data['completionstatus'] = get_string('errornoallocation', 'enrol_programs');
        $data['programstart'] = isset($program->timeallocationstart) ? userdate($program->timeallocationstart) : null;
        $data['programend'] =  isset($allocation->timeend) ? userdate($allocation->timeend) : null;
        $customfieldoutput = $PAGE->get_renderer('enrol_programs', 'customfield');
        $data['customfields'] = $customfieldoutput->render_customfields($program->id);
        $data['fullname'] = format_string($program->fullname);
        $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $context->id, 'enrol_programs', 'description', $program->id);
        $data['description'] = format_text($description, $program->descriptionformat, ['context' => $context]);
        $top = program::load_content($program->id);
        $data['sequencetype'] = $top->get_sequencetype_info();
        if ($completiondelay = $top->get_completiondelay()) {
            $completiondelaytext = util::format_duration($completiondelay);
        }
        $data['completiondelaytext'] = $completiondelaytext;

        $tagsdiv = '';
        if ($CFG->usetags) {
            $tags = \core_tag_tag::get_item_tags('enrol_programs', 'enrol_programs_programs', $program->id);
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
        $result .= $OUTPUT->render_from_template('enrol_programs/programinfogrid', $data);

        $actions = [];
        /** @var \enrol_programs\local\source\base[] $sourceclasses */ // Type hack.
        $sourceclasses = allocation::get_source_classes();
        foreach ($sourceclasses as $type => $classname) {
            $source = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => $type]);
            if (!$source) {
                continue;
            }
            $actions = array_merge($actions, $classname::get_catalogue_actions($program, $source));
        }

        if ($actions) {
            $result .= '<div class="buttons mb-5">';
            $result .= implode(' ', $actions);
            $result .= '</div>';
        }

        $result .= $this->render_program_content($program);

        return $result;
    }

    public function render_program_content(stdClass $program): string {
        global $DB, $OUTPUT;
        $top = program::load_content($program->id);

        $renderercolumns = function(item $item, $itemdepth) use (&$renderercolumns, &$DB, &$OUTPUT): array {

            $children = [];
            $isset = false;
            $istraining = false;
            $image = '';
            $disabled = false;
            $completiondelaytext = '';
            $fullname = $item->get_fullname();
            $sequence = 1;
            foreach ($item->get_children() as $child) {
                if ($child instanceof set) {
                    $sequence = 1;
                }
                $children[] = $renderercolumns($child, $itemdepth + 1, $item, $sequence);
                $sequence++;
            }
            if (isset($parent) && $parent->get_sequencetype_info() == 'All in order') {
                $sequencerequired = true;
            } else {
                $sequencerequired = false;
            }
            $completiontype = '';
            if ($item instanceof set) {
                $completiontype = $item->get_sequencetype_info();
            }
            if ($completiondelay = $item->get_completiondelay()) {
                $layoutconfig = get_config('enrol_programs', 'programslayout');
                if ($layoutconfig == 'table') {
                    $completiondelaytext = get_string('completiondelay', 'enrol_programs') . ': ' . util::format_duration($completiondelay);
                } else {
                    $completiondelaytext = util::format_duration($completiondelay);
                }
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
                'istraining' => $istraining,
                'completiondelaytext' => $completiondelaytext,
                'parent' => isset($parent) ? $parent->get_fullname() : '',
                'sequencerequired' => $sequencerequired,
                'detailurl' => $detailurl ?? null,
                'simplename' => $item->get_fullname(),
                'padding' => $padding,
                'icon' => $icon,
                'non-allocated' => true,
            ];
            return $data;
        };
        $layoutconfig = get_config('enrol_programs', 'programslayout');
        $programitemlist = $renderercolumns($top, 0);
        if ($layoutconfig == 'table') {
            return $OUTPUT->render_from_template('enrol_programs/programcontenttable', $programitemlist);
        } else {
            return $OUTPUT->render_from_template('enrol_programs/programcontentgrid', $programitemlist);
        }
    }
}
