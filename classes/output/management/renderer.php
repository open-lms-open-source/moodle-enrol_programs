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

namespace enrol_programs\output\management;

use enrol_programs\local\notification_manager;
use enrol_programs\local\allocation;
use enrol_programs\local\management;
use enrol_programs\local\program;
use enrol_programs\local\util;
use enrol_programs\local\content\item,
    enrol_programs\local\content\top,
    enrol_programs\local\content\set,
    enrol_programs\local\content\course;
use stdClass, moodle_url, tabobject, html_writer;

/**
 * Program management renderer.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {
    public function render_program_general(stdClass $program): string {
        global $CFG;

        $context = \context::instance_by_id($program->contextid);

        $result = '';

        $presentation = (array)json_decode($program->presentationjson);
        if (!empty($presentation['image'])) {
            $imageurl = moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                '/' . $context->id . '/enrol_programs/image/' . $program->id . '/'. $presentation['image'], false);
            $result .= '<div class="float-right programimage">' . html_writer::img($imageurl, '') . '</div>';
        }
        $result .= '<dl class="row">';
        $result .= '<dt class="col-3">' . get_string('fullname') . ':</dt><dd class="col-9">'
            . format_string($program->fullname) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('idnumber') . ':</dt><dd class="col-9">'
            . s($program->idnumber) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('category') . ':</dt><dd class="col-9">'
            . html_writer::link(new moodle_url('/enrol/programs/management/index.php',
                ['contextid' => $context->id]), $context->get_context_name(false)) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('creategroups', 'enrol_programs') . ':</dt><dd class="col-9">'
            . ($program->creategroups ? get_string('yes') : get_string('no')) . '</dd>';
        if ($CFG->usetags) {
            $tags = \core_tag_tag::get_item_tags('enrol_programs', 'program', $program->id);
            if ($tags) {
                $result .= '<dt class="col-3">' . get_string('tags') . ':</dt><dd class="col-9">'
                    . $this->output->tag_list($tags, '', 'program-tags') . '</dd>';
            }
        }
        $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $context->id, 'enrol_programs', 'description', $program->id);
        $description = format_text($description, $program->descriptionformat, ['context' => $context]);
        $result .= '<dt class="col-3">' . get_string('description') . ':</dt><dd class="col-9">' . $description . '</dd>';
        $result .= '<dt class="col-3">' . get_string('archived', 'enrol_programs') . ':</dt><dd class="col-9">'
            . ($program->archived ? get_string('yes') : get_string('no')) . '<br />';
        $result .= '</dl>';

        return $result;
    }

    public function render_program_allocation(stdClass $program): string {
        $result = '';

        $result .= '<dl class="row">';
        $result .= '<dt class="col-3">' . get_string('allocationstart', 'enrol_programs') . ':</dt><dd class="col-9">'
            . ($program->timeallocationstart ? userdate($program->timeallocationstart) : get_string('notset', 'enrol_programs')) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('allocationend', 'enrol_programs') . ':</dt><dd class="col-9">'
            . ($program->timeallocationend ? userdate($program->timeallocationend) : get_string('notset', 'enrol_programs')) . '</dd>';
        $result .= '</dl>';

        return $result;
    }

    public function render_program_scheduling(stdClass $program): string {
        $result = '';

        $result .= '<dl class="row">';
        $result .= '<dt class="col-3">' . get_string('programstart', 'enrol_programs') . ':</dt><dd class="col-9">';
        $start = (object)json_decode($program->startdatejson);
        $types = program::get_program_startdate_types();

        if ($start->type === 'date') {
            $result .= userdate($start->date);
        } else if ($start->type === 'delay') {
            $result .= $types[$start->type] . ' - ' . util::format_delay($start->delay);
        } else {
            $result .= $types[$start->type];
        }
        $result .= '</dd>';

        $result .= '<dt class="col-3">' . get_string('programdue', 'enrol_programs') . ':</dt><dd class="col-9">';
        $due = (object)json_decode($program->duedatejson);
        $types = program::get_program_duedate_types();
        if ($due->type === 'date') {
            $result .= userdate($due->date);
        } else if ($due->type === 'delay') {
            $result .= $types[$due->type] . ' - ' . util::format_delay($due->delay);
        } else {
            $result .= $types[$due->type];
        }
        $result .= '</dd>';

        $result .= '<dt class="col-3">' . get_string('programend', 'enrol_programs') . ':</dt><dd class="col-9">';
        $end = (object)json_decode($program->enddatejson);
        $types = program::get_program_enddate_types();
        if ($end->type === 'date') {
            $result .= userdate($end->date);
        } else if ($end->type === 'delay') {
            $result .= $types[$end->type] . ' - ' . util::format_delay($end->delay);
        } else {
            $result .= $types[$end->type];
        }
        $result .= '</dd>';
        $result .= '</dl>';

        return $result;
    }

    public function render_program_visibility(stdClass $program): string {
        $result = '';

        $result .= '<dl class="row">';
        $result .= '<dt class="col-3">' . get_string('public', 'enrol_programs') . ':</dt><dd class="col-9">'
            . ($program->public ? get_string('yes') : get_string('no')) . '</dd>';
        $result .= '<dt class="col-3">' . get_string('cohorts', 'enrol_programs') . ':</dt><dd class="col-9">';
        $cohorts = management::fetch_current_cohorts_menu($program->id);
        if ($cohorts) {
            $result .= implode(', ', array_map('format_string', $cohorts));
        } else {
            $result .= '-';
        }
        $result .= '</dd>';
        $result .= '</dl>';

        return $result;
    }

    public function render_management_program_tabs(stdClass $program, string $currenttab): string {
        $url = new moodle_url('/enrol/programs/management/program.php', ['id' => $program->id]);
        $tabs[] = new tabobject('general', $url, get_string('tabgeneral', 'enrol_programs'));

        $url = new moodle_url('/enrol/programs/management/program_content.php', ['id' => $program->id]);
        $tabs[] = new tabobject('content', $url, get_string('tabcontent', 'enrol_programs'));

        $url = new moodle_url('/enrol/programs/management/program_visibility.php', ['id' => $program->id]);
        $tabs[] = new tabobject('visibility', $url, get_string('tabvisibility', 'enrol_programs'));

        $url = new moodle_url('/enrol/programs/management/program_allocation.php', ['id' => $program->id]);
        $tabs[] = new tabobject('allocation', $url, get_string('taballocation', 'enrol_programs'));

        $url = new moodle_url('/enrol/programs/management/program_notifications.php', ['id' => $program->id]);
        $tabs[] = new tabobject('notifications', $url, get_string('notifications', 'local_openlms'));

        /** @var \enrol_programs\local\source\base[] $sourceclasses */ // Class name hack.
        $sourceclasses = allocation::get_source_classes();
        foreach ($sourceclasses as $sourceclass) {
            $extras = $sourceclass::get_extra_management_tabs($program);
            foreach ($extras as $tab) {
                $tabs[] = $tab;
            }
        }

        if (\enrol_programs\local\certificate::is_available()) {
            // NOTE: this should be implemented via hooks, then the tab would be stored
            // in new subplugin in tool_certificate.
            $url = new moodle_url('/enrol/programs/management/program_certificate.php', ['id' => $program->id]);
            $tabs[] = new tabobject('certificate', $url, get_string('certificate', 'tool_certificate'));
        }

        $url = new moodle_url('/enrol/programs/management/program_users.php', ['id' => $program->id]);
        $tabs[] = new tabobject('users', $url, get_string('tabusers', 'enrol_programs'), '', true);

        if (count($tabs) > 1) {
            return $this->output->render(new \tabtree($tabs, $currenttab));
        } else {
            return '';
        }
    }

    public function render_content(int $programid, ?int $movetargetsfor): string {
        global $DB;

        /** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
        $dialogformoutput = $this->page->get_renderer('local_openlms', 'dialog_form');

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
        $context = \context::instance_by_id($program->contextid);
        if ($program->archived) {
            $canedit = false;
        } else {
            $canedit = has_capability('enrol/programs:edit', $context);
        }

        $result = '';

        // Load the content tree with full problem detections.
        $top = program::load_content($program->id);

        if ($top->is_problem_detected()) {
            $result .= $this->output->notification(get_string('errorcontentproblem', 'enrol_programs'), \core\output\notification::NOTIFY_ERROR);
            if (has_capability('enrol/programs:admin', $context)) {
                $fixurl = new moodle_url('/enrol/programs/management/program_content.php', ['id' => $program->id, 'autofix' => 1, 'sesskey' => sesskey()]);
                $result .= '<div class="buttons mb-3">';
                $result .= $this->output->single_button($fixurl, get_string('programautofix', 'enrol_programs'));
                $result .= '</div>';
            }
        }

        if (!$canedit || !$movetargetsfor) {
            $movetargetsfor = null;
        }
        $movetargetsforname = null;
        if ($movetargetsfor) {
            $movetargetsforname = $DB->get_field('enrol_programs_items', 'fullname', ['id' => $movetargetsfor]);
            $movetargetsforname = format_string($movetargetsforname);
            $cancelmove = get_string('moveitemcancel', 'enrol_programs');
            $result .= $this->output->single_button($this->page->url, $cancelmove, 'get');
        }

        $rows = [];
        $hasactions = false;
        $output = $this->output;
        $renderercolumns = function(item $item, int $itemdepth, int $position, ?set $parent, bool $showtargets) use(&$renderercolumns, &$rows, $canedit, &$hasactions,
            &$output, $dialogformoutput, &$movetargetsfor, $movetargetsforname): void {
            $fullname = $item->get_fullname();
            $id = $item->get_id();
            $padding = str_repeat('&nbsp;', $itemdepth * 6);
            $childpadding = str_repeat('&nbsp;', ($itemdepth + 1) * 6);

            $completion = '';
            if ($item instanceof set) {
                $completion = $item->get_sequencetype_info();
            }

            if ($movetargetsfor == $item->get_id()) {
                $showtargets = false;
            }
            if ($movetargetsfor && !$showtargets) {
                $fullname = '<span class="dimmed_text">' . $fullname . '</span>';
            }

            $actions = [];
            if ($canedit) {
                if ($item instanceof set) {
                    $appendurl = new moodle_url('/enrol/programs/management/item_append.php', ['parentitemid' => $id]);
                    $appendaction = new \local_openlms\output\dialog_form\icon($appendurl, 'appenditem', get_string('appenditem', 'enrol_programs'), 'enrol_programs');
                    $actions[] = $dialogformoutput->render($appendaction);
                } else {
                    $actions[] = $output->pix_icon('i/empty', '');
                }
                if ($item->is_deletable()) {
                    if ($item instanceof set) {
                        $deletestr = get_string('deleteset', 'enrol_programs');
                    } else {
                        $deletestr = get_string('deletecourse', 'enrol_programs');
                    }
                    $deleteurl = new moodle_url('/enrol/programs/management/item_delete.php', ['id' => $id]);
                    $deleteaction = new \local_openlms\output\dialog_form\icon($deleteurl, 'deleteitem', $deletestr, 'enrol_programs');
                    $actions[] = $dialogformoutput->render($deleteaction);
                } else {
                    $actions[] = $output->pix_icon('i/empty', '');
                }

                $targetpre = false;
                $targetpost = false;
                if ($item instanceof top) {
                    $actions[] = $output->pix_icon('i/empty', '');
                } else if ($movetargetsfor) {
                    $actions[] = $output->pix_icon('i/empty', '');
                    if ($showtargets) {
                        if ($position == 0 || $parent->get_children()[$position - 1]->get_id() != $movetargetsfor) {
                            $targetpre = true;
                        }
                        if ($position == count($parent->get_children()) - 1) {
                            $targetpost = true;
                        }
                    }
                } else {
                    $moveurl = new moodle_url('/enrol/programs/management/program_content.php', ['id' => $item->get_programid(), 'movetargetsfor' => $item->get_id()]);
                    $moveicon = $output->pix_icon('move', get_string('moveitem', 'enrol_programs'), 'enrol_programs');
                    $actions[] = \html_writer::link($moveurl, $moveicon, array('title' => get_string('moveitem', 'enrol_programs')));
                }

                if ($item instanceof set) {
                    $editurl = new moodle_url('/enrol/programs/management/item_edit.php', ['id' => $id]);
                    $editaction = new \local_openlms\output\dialog_form\icon($editurl, 'i/settings', get_string('updateset', 'enrol_programs'));
                    $actions[] = $dialogformoutput->render($editaction);
                } else {
                    $actions[] = $output->pix_icon('i/empty', '');
                }
            }

            if ($item instanceof course) {
                $courseid = $item->get_courseid();
                $coursecontext = \context_course::instance($courseid, IGNORE_MISSING);
                if ($coursecontext) {
                    if (has_capability('moodle/course:view', $coursecontext) && !$movetargetsfor) {
                        $detailurl = new moodle_url('/course/view.php', ['id' => $courseid]);
                        $fullname = \html_writer::link($detailurl, $fullname);
                    }
                }
            }

            if ($item instanceof top) {
                $itemname = $output->pix_icon('itemtop', get_string('program', 'enrol_programs'), 'enrol_programs') . '&nbsp;' . $fullname;
            } else if ($item instanceof course) {
                $itemname = $padding . $output->pix_icon('itemcourse', get_string('course'), 'enrol_programs') . $fullname;
            } else {
                $itemname = $padding . $output->pix_icon('itemset', get_string('set', 'enrol_programs'), 'enrol_programs') . $fullname;
            }
            if ($actions) {
                $hasactions = true;
            }

            if ($canedit && $targetpre) {
                $turl = new moodle_url('/enrol/programs/management/program_content.php',
                    ['id' => $item->get_programid(), 'moveitem' => $movetargetsfor, 'movetoparent' => $parent->get_id(), 'moveposition' => $position, 'sesskey' => sesskey()]);
                $a = (object)['item' => $movetargetsforname, 'target' => $item->get_fullname()];
                $movehere = get_string('movebefore', 'enrol_programs', $a);
                $target = $padding . \html_writer::link($turl, $movehere, ['class' => 'movehere']);
                $rows[]  = [$target, '', ''];
            }
            $rows[] = [$itemname, $completion, implode('', $actions)];

            $children = $item->get_children();
            if ($children) {
                $i = 0;
                foreach ($children as $child) {
                    $renderercolumns($child, $itemdepth + 1, $i, $item, $showtargets);
                    $i++;
                }
            } else if ($showtargets && ($item instanceof set)) {
                $turl = new moodle_url('/enrol/programs/management/program_content.php',
                    ['id' => $item->get_programid(), 'moveitem' => $movetargetsfor, 'movetoparent' => $item->get_id(), 'moveposition' => 0, 'sesskey' => sesskey()]);
                $a = (object)['item' => $movetargetsforname, 'target' => $item->get_fullname()];
                $movehere = get_string('moveinto', 'enrol_programs', $a);
                $target = $childpadding . \html_writer::link($turl, $movehere, ['class' => 'movehere']);
                $rows[]  = [$target, '', ''];
            }

            if ($canedit && $targetpost) {
                $turl = new moodle_url('/enrol/programs/management/program_content.php',
                    ['id' => $item->get_programid(), 'moveitem' => $movetargetsfor, 'movetoparent' => $parent->get_id(), 'moveposition' => $position + 1, 'sesskey' => sesskey()]);
                $a = (object)['item' => $movetargetsforname, 'target' => $item->get_fullname()];
                $movehere = get_string('moveafter', 'enrol_programs', $a);
                $target = $padding . \html_writer::link($turl, $movehere, ['class' => 'movehere']);
                $rows[]  = [$target, '', ''];
            }
        };
        $renderercolumns($top, 0, 0, null, isset($movetargetsfor));

        $table = new \html_table();
        $table->head = [get_string('item', 'enrol_programs'), get_string('sequencetype', 'enrol_programs'), get_string('actions')];
        $table->id = 'program_content';
        $table->attributes['class'] = 'admintable generaltable';
        $table->data = $rows;

        if (isset($movetargetsfor)) {
            $hasactions = false;
        }

        if (!$hasactions) {
            array_pop($table->head);
            foreach ($table->data as $k => $v) {
                array_pop($table->data[$k]);
            }
        }

        $result .= \html_writer::table($table);

        return $result;
    }

    public function render_content_orphans(int $programid): string {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid], '*', MUST_EXIST);
        $context = \context::instance_by_id($program->contextid);

        if ($program->archived) {
            return '';
        }
        if (!has_capability('enrol/programs:edit', $context)) {
            return '';
        }

        $top = program::load_content($program->id);

        $orphanedsets = $top->get_orphaned_sets();
        $orphanedcourses = $top->get_orphaned_courses();

        if (!$orphanedsets && !$orphanedcourses) {
            return '';
        }

        $rows = [];

        $iconcourse = $this->output->pix_icon('itemcourse', get_string('course'), 'enrol_programs');
        $iconset = $this->output->pix_icon('itemset', get_string('set', 'enrol_programs'), 'enrol_programs');

        foreach ($orphanedsets as $set) {
            $fullname = $iconset . $set->get_fullname();

            $actions = [];
            $deletestr = get_string('deleteset', 'enrol_programs');
            $deleteurl = new moodle_url('/enrol/programs/management/item_delete.php', ['id' => $set->get_id()]);
            $deleteimg = $this->output->pix_icon('deleteitem', $deletestr, 'enrol_programs');
            $actions[] = \html_writer::link($deleteurl, $deleteimg, array('title' => $deletestr));

            $rows[] = [$fullname, implode('', $actions)];
        }

        foreach ($orphanedcourses as $course) {
            $fullname = $iconcourse . $course->get_fullname();

            $actions = [];
            $deletestr = get_string('deletecourse', 'enrol_programs');
            $deleteurl = new moodle_url('/enrol/programs/management/item_delete.php', ['id' => $course->get_id()]);
            $deleteimg = $this->output->pix_icon('deleteitem', $deletestr, 'enrol_programs');
            $actions[] = \html_writer::link($deleteurl, $deleteimg, array('title' => $deletestr));

            $rows[] = [$fullname, implode('', $actions)];
        }

        $table = new \html_table();
        $table->head = [get_string('item', 'enrol_programs'), get_string('actions')];
        $table->id = 'program_content_orphaned_sets';
        $table->attributes['class'] = 'admintable generaltable';
        $table->data = $rows;

        $result = '';
        $result .= $this->output->heading(get_string('unlinkeditems', 'enrol_programs'));
        $result .= \html_writer::table($table);

        return $result;
    }

    public function render_user_allocation(stdClass $program, stdClass $allocation): string {
        global $DB;

        /** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
        $dialogformoutput = $this->page->get_renderer('local_openlms', 'dialog_form');
        /** @var \enrol_programs\output\catalogue\renderer $catalogueoutput */
        $catalogueoutput = $this->page->get_renderer('enrol_programs', 'catalogue');

        $strnotset = get_string('notset', 'enrol_programs');
        $sourceclasses = allocation::get_source_classes();
        $sourcenames = allocation::get_source_names();
        $context = \context::instance_by_id($program->contextid);
        $source = $DB->get_record('enrol_programs_sources', ['id' => $allocation->sourceid], '*', MUST_EXIST);
        /** @var \enrol_programs\local\source\base $sourceclass */
        $sourceclass = $sourceclasses[$source->type];

        $buttons = [];
        if (has_capability('enrol/programs:admin', $context)) {
            if ($sourceclass::allocation_edit_supported($program, $source, $allocation)) {
                $updateurl = new \moodle_url('/enrol/programs/management/user_allocation_edit.php', ['id' => $allocation->id]);
                $updatebutton = new \local_openlms\output\dialog_form\button($updateurl, get_string('updateallocation', 'enrol_programs'));
                $buttons[] = $dialogformoutput->render($updatebutton);
            }
        }
        if (has_capability('enrol/programs:allocate', $context)) {
            if ($sourceclass::allocation_delete_supported($program, $source, $allocation)) {
                $deleteurl = new \moodle_url('/enrol/programs/management/user_allocation_delete.php', ['id' => $allocation->id]);
                $deletebutton = new \local_openlms\output\dialog_form\button($deleteurl, get_string('deleteallocation', 'enrol_programs'));
                $deletebutton->set_after_submit($deletebutton::AFTER_SUBMIT_REDIRECT);
                $buttons[] = $dialogformoutput->render($deletebutton);
            }
        }

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
        $result .= '<dt class="col-3">' . get_string('source', 'enrol_programs') . ':</dt><dd class="col-9">'
            . $sourcenames[$source->type] . '</dd>';
        $result .= '</dl>';

        if ($buttons) {
            $result .= '<div class="buttons mb-5">';
            $result .= implode(' ', $buttons);
            $result .= '</div>';
        }

        return $result;
    }

    public function render_user_notifications(stdClass $program, stdClass $allocation): string {
        $strnotset = get_string('notset', 'enrol_programs');

        $result = $this->output->heading(get_string('notificationdates', 'enrol_programs'), 4);

        $result .= '<dl class="row">';

        $types = notification_manager::get_all_types();
        /** @var class-string<\enrol_programs\local\notification\base> $classname */
        foreach ($types as $notificationtype => $classname) {
            if ($notificationtype === 'deallocation') {
                continue;
            }
            $result .= '<dt class="col-3">';
            $result .= $classname::get_name();
            $result .= ':</dt><dd class="col-9">';
            $timenotified = notification_manager::get_timenotified($allocation->userid, $program->id, $notificationtype);
            $result .= ($timenotified ? userdate($timenotified) : $strnotset);
            $result .= '</dd>';
        }

        return $result;
    }

    public function render_user_progress(stdClass $program, stdClass $allocation): string {
        global $DB;

        $context = \context::instance_by_id($program->contextid);
        $canhack = (has_capability('enrol/programs:admin', $context) || has_capability('enrol/programs:manageevidence', $context));
        $dateformat = get_string('strftimedatetimeshort');

        /** @var \local_openlms\output\dialog_form\renderer $dialogformoutput */
        $dialogformoutput = $this->page->get_renderer('local_openlms', 'dialog_form');

        $top = program::load_content($program->id);

        $output = $this->output;
        $rows = [];
        $renderercolumns = function(item $item, $itemdepth) use(&$renderercolumns, &$rows, $allocation, &$output, &$dialogformoutput,
            &$DB, &$context, $dateformat, $canhack): void {
            $fullname = $item->get_fullname();
            $id = $item->get_id();
            $padding = str_repeat('&nbsp;', $itemdepth * 6);

            $completiontype = '';
            if ($item instanceof set) {
                $completiontype = $item->get_sequencetype_info();
            }

            $actions = [];

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
                $itemname = $output->pix_icon('itemtop', get_string('program', 'enrol_programs'), 'enrol_programs') . '&nbsp;' . $fullname;
            } else if ($item instanceof course) {
                $itemname = $padding . $output->pix_icon('itemcourse', get_string('course'), 'enrol_programs') . $fullname;
            } else {
                $itemname = $padding . $output->pix_icon('itemset', get_string('set', 'enrol_programs'), 'enrol_programs') . $fullname;
            }

            // Completion stuff.
            $completioninfo = '';
            $completion = $DB->get_record('enrol_programs_completions', ['itemid' => $item->get_id(), 'allocationid' => $allocation->id]);
            if ($completion) {
                $completioninfo = userdate($completion->timecompleted, $dateformat);
            }
            if ($canhack) {
                $editurl = new moodle_url('/enrol/programs/management/user_completion_edit.php', ['allocationid' => $allocation->id, 'itemid' => $item->get_id()]);
                $editaction = new \local_openlms\output\dialog_form\icon($editurl, 'i/settings', get_string('edit'));
                $actions[] = $dialogformoutput->render($editaction);
            }

            $evidenceinfo = '';
            $evidence = $DB->get_record('enrol_programs_evidences', ['itemid' => $item->get_id(), 'userid' => $allocation->userid]);
            if ($evidence) {
                $jsondata = (object)json_decode($evidence->evidencejson);
                $evidenceinfo .= format_text($jsondata->details);
            }

            $rows[] = [$itemname, $completiontype, $completioninfo, $evidenceinfo, implode('', $actions)];

            foreach ($item->get_children() as $child) {
                $renderercolumns($child, $itemdepth + 1);
            }
        };
        $renderercolumns($top, 0);

        $table = new \html_table();
        $table->head = [get_string('item', 'enrol_programs'), get_string('sequencetype', 'enrol_programs'), get_string('completiondate', 'enrol_programs'),
            get_string('evidence', 'enrol_programs'), get_string('actions')];
        $table->id = 'program_content';
        $table->attributes['class'] = 'admintable generaltable';
        $table->data = $rows;

        $result = $this->output->heading(get_string('completion', 'completion'), 4);
        $result .= \html_writer::table($table);

        return $result;
    }

    public function render_program_sources(\stdClass $program): string {
        global $DB;

        $result = '';

        $sources = [];
        /** @var \enrol_programs\local\source\base[] $sourceclasses */
        $sourceclasses = \enrol_programs\local\allocation::get_source_classes();
        foreach ($sourceclasses as $sourcetype => $sourceclass) {
            $sourcerecord = $DB->get_record('enrol_programs_sources', ['type' => $sourcetype, 'programid' => $program->id]);
            if (!$sourcerecord && !$sourceclass::is_new_allowed($program)) {
                continue;
            }
            if (!$sourcerecord) {
                $sourcerecord = null;
            }
            $sources[$sourcetype] = $sourceclass::render_status($program, $sourcerecord);
        }

        if ($sources) {
            $result .= '<dl class="row">';
            foreach ($sources as $sourcetype => $status) {
                $name = $sourceclasses[$sourcetype]::get_name();
                $result .= '<dt class="col-3">' . $name . ':</dt><dd class="col-9">' . $status . '</dd>';
            }
            $result .= '</dl>';
        } else {
            $result = get_string('notavailable');
        }

        return $result;
    }
}
