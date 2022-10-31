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

use enrol_programs\local\allocation;
use enrol_programs\local\program;
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
        global $CFG;

        $context = \context::instance_by_id($program->contextid);
        $fullname = format_string($program->fullname);
        $programicon = $this->output->pix_icon('program', '', 'enrol_programs');

        $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $context->id, 'enrol_programs', 'description', $program->id);
        $description = format_text($description, $program->descriptionformat, ['context' => $context]);

        $tagsdiv = '';
        if ($CFG->usetags) {
            $tags = \core_tag_tag::get_item_tags('enrol_programs', 'program', $program->id);
            if ($tags) {
                $tagsdiv = $this->output->tag_list($tags, '', 'program-tags');
            }
        }

        $programimage = '';
        $presentation = (array)json_decode($program->presentationjson);
        if (!empty($presentation['image'])) {
            $imageurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                '/' . $context->id . '/enrol_programs/image/' . $program->id . '/'. $presentation['image'], false);
            $programimage = '<div class="float-right programimage">' . \html_writer::img($imageurl, '') . '</div>';
        }

        $result = '';
        $result .= <<<EOT
<div class="programbox clearfix" data-programid="$program->id">
  $programimage
  <div class="info">
  <div class="info">
    <h2 class="programname">{$programicon}{$fullname}</h2>
  </div>$tagsdiv
  <div class="content">
    <div class="summary">$description</div>
  </div>
</div>
EOT;

        return $result;
    }

    public function render_user_allocation(stdClass $program, stdClass $allocation): string {
        $strnotset = get_string('notset', 'enrol_programs');

        $result = '';

        $result .= '<dl class="row">';
        $result .= '<dt class="col-3">' . get_string('programstatus', 'enrol_programs') . ':</dt><dd class="col-9">'
            . allocation::get_completion_status_html($program, $allocation) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('allocationdate', 'enrol_programs') . ':</dt><dd class="col-9">'
            . userdate($allocation->timeallocated) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('programstart', 'enrol_programs') . ':</dt><dd class="col-9">'
            . userdate($allocation->timestart) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('programdue', 'enrol_programs') . ':</dt><dd class="col-9">'
            . (isset($allocation->timedue) ? userdate($allocation->timedue) : $strnotset) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('programend', 'enrol_programs') . ':</dt><dd class="col-9">'
            . (isset($allocation->timeend) ? userdate($allocation->timeend) : $strnotset) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('completiondate', 'enrol_programs') . ':</dt><dd class="col-9">'
            . (isset($allocation->timecompleted) ? userdate($allocation->timecompleted) : $strnotset) . '</dd>';
        $result .= '</dl>';

        return $result;
    }

    public function render_user_progress(stdClass $program, stdClass $allocation): string {
        global $DB;

        $top = program::load_content($program->id);

        $rows = [];
        $renderercolumns = function(item $item, $itemdepth) use (&$renderercolumns, &$rows, $allocation, &$DB): void {
            $fullname = $item->get_fullname();
            $id = $item->get_id();
            $padding = str_repeat('&nbsp;', $itemdepth * 6);

            $completiontype = '';
            if ($item instanceof set) {
                $completiontype = $item->get_sequencetype_info();
            }

            if ($item instanceof course) {
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
                }
            }

            if ($item instanceof top) {
                $itemname = $this->output->pix_icon('itemtop', get_string('program', 'enrol_programs'), 'enrol_programs') . '&nbsp;' . $fullname;
            } else if ($item instanceof course) {
                $itemname = $padding . $this->output->pix_icon('itemcourse', get_string('course'), 'enrol_programs') . $fullname;
            } else {
                $itemname = $padding . $this->output->pix_icon('itemset', get_string('set', 'enrol_programs'), 'enrol_programs') . $fullname;
            }

            $row = [$itemname, $completiontype];

            $completioninfo = '';
            $completion = $DB->get_record('enrol_programs_completions', ['itemid' => $item->get_id(), 'allocationid' => $allocation->id]);
            if ($completion) {
                $completioninfo = userdate($completion->timecompleted, get_string('strftimedatetimeshort'));
            }
            $row[] = $completioninfo;

            $rows[] = $row;

            foreach ($item->get_children() as $child) {
                $renderercolumns($child, $itemdepth + 1);
            }
        };
        $renderercolumns($top, 0);

        $table = new \html_table();
        $table->head = [get_string('item', 'enrol_programs'), get_string('sequencetype', 'enrol_programs')];
        $table->head[] = get_string('completiondate', 'enrol_programs');
        $table->id = 'program_content';
        $table->attributes['class'] = 'admintable generaltable';
        $table->data = $rows;

        $result = $this->output->heading(get_string('tabcontent', 'enrol_programs'), 3);
        $result .= \html_writer::table($table);

        return $result;
    }

    /**
     * Returns body of My programs block.
     *
     * @return string
     */
    public function render_block_content(): string {
        global $DB;

        $allocations = allocation::get_my_allocations();
        if (!$allocations) {
            return '<em>' . get_string('errornomyprograms', 'enrol_programs') . '</em>';
        }

        $programicon = $this->output->pix_icon('program', '', 'enrol_programs');
        $strnotset = get_string('notset', 'enrol_programs');
        $dateformat = get_string('strftimedatetimeshort');

        foreach ($allocations as $allocation) {
            $row = [];

            $program = $DB->get_record('enrol_programs_programs', ['id' => $allocation->programid]);
            $fullname = $programicon . format_string($program->fullname);
            $detailurl = new moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);
            $fullname = \html_writer::link($detailurl, $fullname);
            $row[] = $fullname;

            $row[] = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

            $row[] = userdate($allocation->timestart, $dateformat);

            $row[] = (isset($allocation->timedue) ? userdate($allocation->timedue, $dateformat) : $strnotset);

            $row[] = (isset($allocation->timeend) ? userdate($allocation->timeend, $dateformat) : $strnotset);

            $data[] = $row;
        }

        $table = new \html_table();
        $table->head = [get_string('programname', 'enrol_programs'), get_string('programstatus', 'enrol_programs'),
            get_string('programstart', 'enrol_programs'), get_string('programdue', 'enrol_programs'),
            get_string('programend', 'enrol_programs')];
        $table->attributes['class'] = 'admintable generaltable';
        $table->data = $data;
        return \html_writer::table($table);
    }

    /**
     * Returns footer of My programs block.
     *
     * @return string
     */
    public function render_block_footer(): string {
        $url = \enrol_programs\local\catalogue::get_catalogue_url();
        if ($url) {
            return '<div class="float-right">' . \html_writer::link($url, get_string('catalogue', 'enrol_programs')) . '</div>';
        }
        return '';
    }
}
