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
use core_table\output\html_table;
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
        $data['programdue'] =  (isset($allocation->timedue) ? userdate($allocation->timedue) : null);
        $data['programend'] =  (isset($allocation->timeend) ? userdate($allocation->timeend) : null);
        $data['completiondate'] = (isset($allocation->timecompleted) ? userdate($allocation->timecompleted) : null);
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

        $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $context->id, 'enrol_programs', 'description', $program->id);
        $data['description'] = format_text($description, $program->descriptionformat, ['context' => $context]);

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
            $completiondelaytext = '';
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
            $completioninfo = get_string('notset', 'enrol_programs');
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
                'completionperct' => $completionperct ? round($completionperct, 2) : 0,
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
        $totalpages = ceil(count(allocation::get_my_allocations())/allocation::PROGRAMCOUNTPERPAGE);

        $PAGE->requires->js_call_amd('enrol_programs/selector', 'init', [['totalpages' => $totalpages]]);

        $allocations = allocation::get_my_allocations(null, true, 0, allocation::PROGRAMCOUNTPERPAGE);
        if (!$allocations) {
            return '<em>' . get_string('errornomyprograms', 'enrol_programs') . '</em>';
        }

        $programicon = $this->output->pix_icon('program', '', 'enrol_programs');
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
                $row['thumbnail'] = $imageurl;
            } else {
                $row['thumbnail'] = $OUTPUT->get_generated_image_for_id($program->id);
            }

            $fullname = shorten_text(format_string($program->fullname), 23, true);
            $detailurl = new moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);
            $fullname = \html_writer::link($detailurl, $fullname);
            $row['fullname'] = $fullname;

            $row['status'] = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

            $row['programstart'] = userdate($allocation->timestart, $dateformat);

            $row['programdue'] = (isset($allocation->timedue) ? userdate($allocation->timedue, $dateformat) : null);

            $row['programend'] = (isset($allocation->timeend) ? userdate($allocation->timeend, $dateformat) : null);

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
        global $OUTPUT;
        $url = \enrol_programs\local\catalogue::get_catalogue_url();

        if ($url) {
            return '<div class="float-end">'. \html_writer::link($url, get_string('catalogue', 'enrol_programs')) . '</div>';
        }
        return '';
    }

    /**
     * Returns My programs data.
     *
     * @return array
     */
    public function get_my_programs_data($orderby): array {
        global $DB, $OUTPUT, $CFG, $USER;

        $sql = "SELECT p.*
          FROM {enrol_programs_programs} p
          JOIN {enrol_programs_allocations} pa ON pa.programid = p.id
         WHERE p.archived = 0 AND pa.archived = 0
               AND pa.userid = :userid
      ORDER BY $orderby";
        $params = ['userid' => $USER->id];
        $programs = $DB->get_records_sql($sql, $params);

        if (!$programs) {
            echo get_string('errornomyprograms', 'enrol_programs');
            echo $OUTPUT->footer();
            die;
        }

        $items = [];
        $programicon = $OUTPUT->pix_icon('program', '', 'enrol_programs');
        $dateformat = get_string('strftimedatetimeshort');
        $strnotset = get_string('notset', 'enrol_programs');
        $sourceclasses = \enrol_programs\local\allocation::get_source_classes();

        foreach ($programs as $program) {
            $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $USER->id]);
            $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid]);
            /** @var \enrol_programs\local\source\base $sourceclass */
            $sourceclass = $sourceclasses[$source->type];
            $pcontext = \context::instance_by_id($program->contextid);
            $fullname = $programicon . format_string($program->fullname);
            $detailurl = new moodle_url('/enrol/programs/my/program.php', ['id' => $program->id]);
            $fullname = \html_writer::link($detailurl, $fullname, array('title' => format_string($program->fullname)));
            if ($CFG->usetags) {
                $tags = \core_tag_tag::get_item_tags('enrol_programs', 'program', $program->id);
                if ($tags) {
                    $fullname .= '<br />' . $OUTPUT->tag_list($tags, '', 'program-tags');
                }
            }

            $idnumber = s($program->idnumber);
            $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $pcontext->id, 'enrol_programs', 'description', $program->id);
            $description = format_text($description, $program->descriptionformat, ['context' => $pcontext]);
            $programstart = userdate($allocation->timestart, $dateformat);
            if ($allocation->timedue) {
                $timedue = userdate($allocation->timedue, $dateformat);
            } else {
                $timedue = $strnotset;
            }
            if ($allocation->timeend) {
                $timeend = userdate($allocation->timeend, $dateformat);
            } else {
                $timeend = $strnotset;
            }
            $source = $sourceclass::render_allocation_source($program, $source, $allocation);
            $status = \enrol_programs\local\allocation::get_completion_status_html($program, $allocation);

            $presentation = (array)json_decode($program->presentationjson);
            if (!empty($presentation['image'])) {
                $context = \context::instance_by_id($program->contextid);
                $imageurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                    '/' . $context->id . '/enrol_programs/image/' . $program->id . '/'. $presentation['image'], false);
                $image = $imageurl;
            } else {
                $image = $OUTPUT->get_generated_image_for_id($program->id);
            }

            $items[] = [
                'fullname' => $fullname,
                'idnumber' => $idnumber,
                'description' => $description,
                'programstart' => $programstart,
                'programdue' => $timedue,
                'programend' => $timeend,
                'source' => $source,
                'status' => $status,
                'image' => $image,
            ];
        }
        return $items;
    }

    /**
     * Returns my programs columns for table layout.
     *
     * @return array
     */
    public function get_my_programs_table_layout_columns($sort, $dir): array {
        global $OUTPUT;

        $pageparams = [];
        if ($sort !== 'fullname') {
            $pageparams['sort'] = $sort;
        }
        if ($dir !== 'ASC') {
            $pageparams['dir'] = $dir;
        }
        $currenturl = new moodle_url('/enrol/programs/my/index.php', $pageparams);

        $column = get_string('programname', 'enrol_programs');
        $columndir = ($dir === "ASC" ? "DESC" : "ASC");
        $columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
        $columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
            ['class' => 'iconsort']);
        $changeurl = new moodle_url($currenturl);
        $changeurl->param('sort', 'fullname');
        $changeurl->param('dir', $columndir);
        $column = \html_writer::link($changeurl, $column);
        if ($sort === 'fullname') {
            $column .= $columnicon;
        }
        $namecol = $column;

        $column = get_string('idnumber');
        $columndir = ($dir === "ASC" ? "DESC" : "ASC");
        $columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
        $columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
            ['class' => 'iconsort']);
        $changeurl = new moodle_url($currenturl);
        $changeurl->param('sort', 'idnumber');
        $changeurl->param('dir', $columndir);
        $column = \html_writer::link($changeurl, $column);
        if ($sort === 'idnumber') {
            $column .= $columnicon;
        }
        $idnumbercol = $column;

        $descriptioncol = get_string('description');

        $column = get_string('programstart', 'enrol_programs');
        $columndir = ($dir === "ASC" ? "DESC" : "ASC");
        $columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
        $columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
            ['class' => 'iconsort']);
        $changeurl = new moodle_url($currenturl);
        $changeurl->param('sort', 'start');
        $changeurl->param('dir', $columndir);
        $column = \html_writer::link($changeurl, $column);
        if ($sort === 'start') {
            $column .= $columnicon;
        }
        $programstartcol = $column;

        $column = get_string('duedate', 'enrol_programs');
        $columndir = ($dir === "ASC" ? "DESC" : "ASC");
        $columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
        $columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
            ['class' => 'iconsort']);
        $changeurl = new moodle_url($currenturl);
        $changeurl->param('sort', 'due');
        $changeurl->param('dir', $columndir);
        $column = \html_writer::link($changeurl, $column);
        if ($sort === 'due') {
            $column .= $columnicon;
        }
        $programduecol = $column;

        $column = get_string('programend', 'enrol_programs');
        $columndir = ($dir === "ASC" ? "DESC" : "ASC");
        $columnicon = ($dir === "ASC" ? "sort_asc" : "sort_desc");
        $columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core',
            ['class' => 'iconsort']);
        $changeurl = new moodle_url($currenturl);
        $changeurl->param('sort', 'end');
        $changeurl->param('dir', $columndir);
        $column = \html_writer::link($changeurl, $column);
        if ($sort === 'end') {
            $column .= $columnicon;
        }
        $programendcol = $column;

        $sourcecol = get_string('source', 'enrol_programs');
        $statuscol = get_string('programstatus', 'enrol_programs');

        $columns = [
            'namecol' => $namecol,
            'idnumbercol' => $idnumbercol,
            'descriptioncol' => $descriptioncol,
            'programstartcol' => $programstartcol,
            'programduecol' => $programduecol,
            'programendcol' => $programendcol,
            'sourcecol' => $sourcecol,
            'statuscol' => $statuscol,
        ];

        return $columns;
    }

    /**
     * Returns my programs in table layout.
     *
     * @return string
     */
    public function render_my_programs_table_layout($sort, $dir): string {
        global $OUTPUT;

        if ($sort === 'idnumber') {
            $orderby = 'idnumber';
        } else {
            $orderby = 'fullname';
        }
        if ($dir === 'ASC') {
            $orderby .= ' ASC';
        } else {
            $orderby .= ' DESC';
        }

        $programstable = $this->get_my_programs_table_layout_columns($sort, $dir);
        $programstable ['tabledata'] = $this->get_my_programs_data($orderby);
        return $OUTPUT->render_from_template('enrol_programs/myprogramstable', $programstable);
    }

    /**
     * Returns my programs in grid layout.
     *
     * @return string
     */
    public function render_my_programs_grid_layout($sort, $dir): string {
        global $OUTPUT;
        if ($sort === 'idnumber') {
            $orderby = 'idnumber';
        } else {
            $orderby = 'fullname';
        }
        if ($dir === 'ASC') {
            $orderby .= ' ASC';
        } else {
            $orderby .= ' DESC';
        }
        $programs = [
        'items' => $this->get_my_programs_data($orderby),
        ];
        return $OUTPUT->render_from_template('enrol_programs/myprogramsgrid', $programs);
    }

    /**
     * Returns my programs filters.
     *
     * @return string
     */
    public function render_my_programs_filters($sort, $dir): string {
        global $OUTPUT;

        $pageparams = [];
        if ($sort !== 'fullname') {
            $pageparams['sort'] = $sort;
        }
        if ($dir !== 'ASC') {
            $pageparams['dir'] = $dir;
        }
        $currenturl = new moodle_url('/enrol/programs/my/index.php', $pageparams);

        // Sort by name.
        $sortbyprogramname = new moodle_url($currenturl);
        $sortbyprogramname->param('sort', 'fullname');
        if ($sort === 'fullname' && $dir === 'ASC') {
            $sorticon = $OUTPUT->pix_icon('t/sort_asc', get_string(strtolower("ASC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramname->param('dir', 'DESC');
        } else {
            $sorticon = $OUTPUT->pix_icon('t/sort_desc', get_string(strtolower("DESC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramname->param('dir', 'ASC');
        }
        $sortbyprogramname = \html_writer::link(
            $sortbyprogramname,
            get_string('sortbyprogramname', 'enrol_programs').$sorticon,
            ['class' => 'dropdown-item']);;

        // Sort by idnumber.
        $sortbyprogramid = new moodle_url($currenturl);
        $sortbyprogramid->param('sort', 'idnumber');
        if ($sort === 'idnumber' && $dir === 'ASC') {
            $sorticon = $OUTPUT->pix_icon('t/sort_asc', get_string(strtolower("ASC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramid->param('dir', 'DESC');
        } else {
            $sorticon = $OUTPUT->pix_icon('t/sort_desc', get_string(strtolower("DESC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramid->param('dir', 'ASC');
        }
        $sortbyprogramid = \html_writer::link(
            $sortbyprogramid,
            get_string('sortbyprogramid', 'enrol_programs').$sorticon,
            ['class' => 'dropdown-item']);

        // Sort by program start.
        $sortbyprogramstart = new moodle_url($currenturl);
        $sortbyprogramstart->param('sort', 'start');
        if ($sort === 'start' && $dir === 'ASC') {
            $sorticon = $OUTPUT->pix_icon('t/sort_asc', get_string(strtolower("ASC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramstart->param('dir', 'DESC');
        } else {
            $sorticon = $OUTPUT->pix_icon('t/sort_desc', get_string(strtolower("DESC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramstart->param('dir', 'ASC');
        }
        $sortbyprogramstart = \html_writer::link(
            $sortbyprogramstart,
            get_string('sortbyprogramstart', 'enrol_programs').$sorticon,
            ['class' => 'dropdown-item']);

        // Sort by program due
        $sortbyprogramdue = new moodle_url($currenturl);
        $sortbyprogramdue->param('sort', 'due');
        if ($sort === 'due' && $dir === 'ASC') {
            $sorticon = $OUTPUT->pix_icon('t/sort_asc', get_string(strtolower("ASC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramdue->param('dir', 'DESC');
        } else {
            $sorticon = $OUTPUT->pix_icon('t/sort_desc', get_string(strtolower("DESC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramdue->param('dir', 'ASC');
        }
        $sortbyprogramdue = \html_writer::link(
            $sortbyprogramdue,
            get_string('sortbyprogramdue', 'enrol_programs').$sorticon,
            ['class' => 'dropdown-item']);

        // Sort by program end.
        $sortbyprogramend = new moodle_url($currenturl);
        $sortbyprogramend->param('sort', 'end');
        if ($sort === 'end' && $dir === 'ASC') {
            $sorticon = $OUTPUT->pix_icon('t/sort_asc', get_string(strtolower("ASC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramend->param('dir', 'DESC');
        } else {
            $sorticon = $OUTPUT->pix_icon('t/sort_desc', get_string(strtolower("DESC")), 'core',
                ['class' => 'iconsort']);
            $sortbyprogramend->param('dir', 'ASC');
        }
        $sortbyprogramend = \html_writer::link(
            $sortbyprogramend,
            get_string('sortbyprogramend', 'enrol_programs').$sorticon,
            ['class' => 'dropdown-item']);

        $sortedbyname = $sortedbyid = $sortedbystart = $sortedbydue = $sortedbyend = false;
        switch ($sort) {
            case 'idnumber':
                $sortedbyid = true;
                break;
            case 'start':
                $sortedbystart = true;
                break;
            case 'end':
                $sortedbyend = true;
                break;
            case 'due':
                $sortedbydue = true;
                break;
            case 'fullname':
            default:
                $sortedbyname = true;
                break;
        }

        $filtersparams = [
            'sortbyprogramname' => $sortbyprogramname,
            'sortbyprogramid' => $sortbyprogramid,
            'sortbyprogramstart' => $sortbyprogramstart,
            'sortbyprogramdue' => $sortbyprogramdue,
            'sortbyprogramend' => $sortbyprogramend,
            'sortedbyname' => $sortedbyname,
            'sortedbyid' => $sortedbyid,
            'sortedbystart' => $sortedbystart,
            'sortedbydue' => $sortedbydue,
            'sortedbyend' => $sortedbyend,
        ];
        return $OUTPUT->render_from_template('enrol_programs/myprogramsfilters', $filtersparams);
    }

}
