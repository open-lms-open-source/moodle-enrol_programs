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

namespace enrol_programs\local;

use stdClass;

/**
 * Program helper.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program {
    /**
     * Options for editing of program descriptions.
     *
     * @param int $contextid
     * @return array
     */
    public static function get_description_editor_options(int $contextid): array {
        $context = \context::instance_by_id($contextid);
        return ['maxfiles' => EDITOR_UNLIMITED_FILES, 'maxbytes' => get_site()->maxbytes, 'context' => $context];
    }

    /**
     * Options for editing of program image.
     *
     * @return array
     */
    public static function get_image_filemanager_options(): array {
        global $CFG;
        return ['maxbytes' => $CFG->maxbytes, 'maxfiles' => 1, 'subdirs' => 0 , 'accepted_types' => ['.jpg', '.jpeg', '.jpe', '.png']];
    }

    /**
     * Called before course category is deleted.
     *
     * @param stdClass $category
     * @return void
     */
    public static function pre_course_category_delete(stdClass $category): void {
        global $DB;

        $catcontext = \context_coursecat::instance($category->id, MUST_EXIST);
        $parentcontext = $catcontext->get_parent_context();

        $programs = $DB->get_records('enrol_programs_programs', ['contextid' => $catcontext->id]);
        foreach ($programs as $program) {
            $data = (object)[
                'id' => $program->id,
                'contextid' => $parentcontext->id,
            ];
            self::update_program_general($data);
        }
    }

    /**
     * Add new program.
     *
     * NOTE: no access control done, includes hacks for form submission.
     *
     * @param stdClass $data
     * @return stdClass program record
     */
    public static function add_program(stdClass $data): stdClass {
        global $DB, $CFG;
        $data = clone($data);

        $trans = $DB->start_delegated_transaction();

        $context = \context::instance_by_id($data->contextid);
        if (!($context instanceof \context_system) && !($context instanceof \context_coursecat)) {
            throw new \coding_exception('program contextid must be a system or course category');
        }

        if (strlen($data->fullname) === 0) {
            throw new \coding_exception('program fullname is required');
        }

        if (strlen($data->idnumber) === 0) {
            throw new \coding_exception('program idnumber is required');
        }

        $editorused = false;
        if (isset($data->description_editor)) {
            $rawdescription = $data->description_editor['text'];
            $data->description = $rawdescription;
            $data->descriptionformat = $data->description_editor['format'];
            $editorused = true;
        } else if (!isset($data->description)) {
            $data->description = '';
        }
        if (!isset($data->descriptionformat)) {
            $data->descriptionformat = FORMAT_HTML;
        }

        $data->presentationjson = util::json_encode([]);
        unset($data->presentation);

        $data->public = isset($data->public) ? (int)(bool)$data->public : 0;
        $data->archived = isset($data->archived) ? (int)(bool)$data->archived : 0;
        $data->creategroups = isset($data->creategroups) ? (int)(bool)$data->creategroups : 0;
        if (empty($data->timeallocationstart)) {
            $data->timeallocationstart = null;
        }
        if (empty($data->timeallocationend)) {
            $data->timeallocationend = null;
        }

        // NOTE: allocation has complex format, we can implement it here later.
        $data->startdatejson = util::json_encode(['type' => 'allocation']);
        $data->duedatejson = util::json_encode(['type' => 'notset']);
        $data->enddatejson = util::json_encode(['type' => 'notset']);

        $data->timecreated = time();
        $data->id = $DB->insert_record('enrol_programs_programs', $data);

        $program = self::update_program_image($data);

        if ($CFG->usetags && isset($data->tags)) {
            \core_tag_tag::set_item_tags('enrol_programs', 'program', $data->id, $context, $data->tags);
        }

        if ($editorused) {
            $editoroptions = self::get_description_editor_options($data->contextid);
            $data = file_postupdate_standard_editor($data, 'description', $editoroptions, $editoroptions['context'],
                'enrol_programs', 'description', $data->id);
            if ($rawdescription !== $data->description) {
                $DB->set_field('enrol_programs_programs', 'description', $data->description, ['id' => $data->id]);
            }
        }

        $sequence = [
            'children' => [],
            'type' => content\set::SEQUENCE_TYPE_ALLINANYORDER,
            'minprerequisites' => 1, // No completion possible yet.
        ];

        $item = new \stdClass();
        $item->programid = $data->id;
        $item->topitem = 1;
        $item->courseid = null;
        $item->fullname = $data->fullname;
        $item->sequencejson = util::json_encode($sequence);
        $item->minprerequisites = $sequence['minprerequisites'];
        $DB->insert_record('enrol_programs_items', $item);

        $program = self::make_snapshot($data->id, 'add');

        $trans->allow_commit();

        $event = \enrol_programs\event\program_created::create_from_program($program);
        $event->trigger();

        allocation::fix_allocation_sources($program->id, null);
        allocation::fix_enrol_instances($program->id);
        allocation::fix_user_enrolments($program->id, null);

        return $program;
    }

    /**
     * Update general program settings.
     *
     * @param stdClass $data
     * @return stdClass program record
     */
    public static function update_program_general(stdClass $data): stdClass {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/group/lib.php');

        $data = clone($data);

        $trans = $DB->start_delegated_transaction();

        $oldprogram = $DB->get_record('enrol_programs_programs', ['id' => $data->id], '*', MUST_EXIST);

        $record = new stdClass();
        $record->id = $oldprogram->id;

        if (isset($data->contextid) && $data->contextid != $oldprogram->contextid) {
            // Cohort was moved to another context.
            $context = \context::instance_by_id($data->contextid);
            if (!($context instanceof \context_system) && !($context instanceof \context_coursecat)) {
                throw new \coding_exception('program contextid must be a system or course category');
            }
            // The category pre-delete hook should be called before the category delete,
            // so the $oldcontext should be still here.
            $oldcontext = \context::instance_by_id($oldprogram->contextid, IGNORE_MISSING);
            if ($oldcontext) {
                get_file_storage()->move_area_files_to_new_context($oldprogram->contextid, $context->id,
                    'enrol_programs', 'description', $data->id);
                // Delete tags even if they are not enabled before move,
                // tags API is not designed to deal with this,
                // we cannot create instance of deleted context.
                \core_tag_tag::set_item_tags('enrol_programs', 'program', $data->id, $oldcontext, null);
            }
            $record->contextid = $context->id;
        } else {
            $record->contextid = $oldprogram->contextid;
            $context = \context::instance_by_id($record->contextid);
        }

        if (isset($data->fullname)) {
            if (strlen($data->fullname) === 0) {
                throw new \coding_exception('program fullname is required');
            }
            $record->fullname = $data->fullname;
        }
        if (isset($data->idnumber)) {
            if (strlen($data->idnumber) === 0) {
                throw new \coding_exception('program idnumber is required');
            }
            $record->idnumber = $data->idnumber;
        }

        if (isset($data->description_editor)) {
            $data->description = $data->description_editor['text'];
            $data->descriptionformat = $data->description_editor['format'];
            $editoroptions = self::get_description_editor_options($data->contextid);
            $data = file_postupdate_standard_editor($data, 'description', $editoroptions, $editoroptions['context'],
                'enrol_programs', 'description', $data->id);
        }
        if (isset($data->description)) {
            $record->description = $data->description;
        }
        if (isset($data->descriptionformat)) {
            $record->descriptionformat = $data->descriptionformat;
        }
        if (isset($data->archived)) {
            $record->archived = (int)(bool)$data->archived;
        }
        if (isset($data->creategroups)) {
            $record->creategroups = (int)(bool)$data->creategroups;
        }

        $DB->update_record('enrol_programs_programs', $record);

        if ($CFG->usetags && isset($data->tags)) {
            \core_tag_tag::set_item_tags('enrol_programs', 'program', $data->id, $context, $data->tags);
        }

        $program = self::update_program_image($data);

        $item = $DB->get_record('enrol_programs_items', ['programid' => $program->id, 'topitem' => 1], '*', MUST_EXIST);
        if ($item->fullname !== $program->fullname) {
            $item->fullname = $program->fullname;
            $DB->update_record('enrol_programs_items', $item);
        }

        // Update group names only if program name changed.
        if ($oldprogram->fullname !== $program->fullname) {
            $sql = "SELECT g.*
                      FROM {groups} g
                      JOIN {enrol_programs_groups} pg ON pg.groupid = g.id
                     WHERE pg.programid = :programid
                  ORDER BY g.id ASC";
            $params = ['programid' => $program->id];
            $groups = $DB->get_records_sql($sql, $params);
            foreach ($groups as $group) {
                if ($group->name !== $program->fullname) {
                    $group->name = $program->fullname;
                    groups_update_group($group);
                }
            }
        }

        $program = self::make_snapshot($program->id, 'update_general');

        $trans->allow_commit();

        allocation::fix_allocation_sources($program->id, null);
        allocation::fix_enrol_instances($program->id);
        allocation::fix_user_enrolments($program->id, null);
        allocation_calendar_event::fix_allocation_calendar_events($program);

        $event = \enrol_programs\event\program_updated::create_from_program($program);
        $event->trigger();

        return $program;
    }

    /**
     * Update program image changed via file manager.
     *
     * @param stdClass $data
     * @return stdClass
     */
    private static function update_program_image(stdClass $data): stdClass {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $data->id], '*', MUST_EXIST);
        $context = \context::instance_by_id($program->contextid);

        if (isset($data->image)) {
            file_save_draft_area_files($data->image, $context->id, 'enrol_programs', 'image', $data->id, array('subdirs' => 0, 'maxfiles' => 1));
            $files = get_file_storage()->get_area_files($context->id, 'enrol_programs', 'image', $data->id, '', false);
            $presenation = (array)json_decode($program->presentationjson);
            if ($files) {
                $file = reset($files);
                $presenation['image'] = $file->get_filename();
            } else {
                unset($presenation['image']);
            }
            $DB->set_field('enrol_programs_programs', 'presentationjson', util::json_encode($presenation), ['id' => $program->id]);
            $program = $DB->get_record('enrol_programs_programs', ['id' => $data->id], '*', MUST_EXIST);
        }

        return $program;
    }

    /**
     * Update program visibility.
     *
     * @param stdClass $data
     * @return stdClass
     */
    public static function update_program_visibility(stdClass $data): stdClass {
        global $DB;

        if ((isset($data->cohorts) && !is_array($data->cohorts))
            || empty($data->id) || !isset($data->public)) {

            throw new \coding_exception('Invalid data');
        }

        $trans = $DB->start_delegated_transaction();

        $oldprogram = $DB->get_record('enrol_programs_programs', ['id' => $data->id], '*', MUST_EXIST);

        if ($oldprogram->public != $data->public) {
            $DB->set_field('enrol_programs_programs', 'public', (int)(bool)$data->public, ['id' => $data->id]);
        }

        if (isset($data->cohorts)) {
            $oldcohorts = management::fetch_current_cohorts_menu($data->id);
            $oldcohorts = array_keys($oldcohorts);
            $oldcohorts = array_flip($oldcohorts);
            foreach ($data->cohorts as $cid) {
                if (isset($oldcohorts[$cid])) {
                    unset($oldcohorts[$cid]);
                    continue;
                }
                $record = (object)['programid' => $data->id, 'cohortid' => $cid];
                $DB->insert_record('enrol_programs_cohorts', $record);
            }
            foreach ($oldcohorts as $cid => $unused) {
                $DB->delete_records('enrol_programs_cohorts', ['programid' => $data->id, 'cohortid' => $cid]);
            }
        }

        $program = self::make_snapshot($data->id, 'update_visibility');

        $trans->allow_commit();

        allocation::fix_allocation_sources($program->id, null);
        allocation::fix_enrol_instances($program->id);
        allocation::fix_user_enrolments($program->id, null);

        $event = \enrol_programs\event\program_updated::create_from_program($program);
        $event->trigger();

        return $program;
    }

    /**
     * Update program allocation settings.
     *
     * @param stdClass $data
     * @return stdClass
     */
    public static function update_program_allocation(stdClass $data): stdClass {
        global $DB;

        if (!isset($data->id)) {
            throw new \coding_exception('Invalid data');
        }

        $oldprogram = $DB->get_record('enrol_programs_programs', ['id' => $data->id], '*', MUST_EXIST);

        $updated = false;
        $record = new \stdClass();
        $record->id = $data->id;
        if (property_exists($data, 'timeallocationstart')) {
            $record->timeallocationstart = $data->timeallocationstart;
            if (!$record->timeallocationstart) {
                $record->timeallocationstart = null;
            }
            if ($record->timeallocationstart !== $oldprogram->timeallocationstart) {
                $updated = true;
            }
        } else {
            $record->timeallocationstart = $oldprogram->timeallocationstart;
        }
        if (property_exists($data, 'timeallocationend')) {
            $record->timeallocationend = $data->timeallocationend;
            if (!$record->timeallocationend) {
                $record->timeallocationend = null;
            }
            if ($record->timeallocationend !== $oldprogram->timeallocationend) {
                $updated = true;
            }
        } else {
            $record->timeallocationend = $oldprogram->timeallocationend;
        }
        if ($record->timeallocationstart && $record->timeallocationend
            && $record->timeallocationstart >= $record->timeallocationend) {
            throw new \coding_exception('Allocation start must be earlier than end');
        }

        if ($updated) {
            $trans = $DB->start_delegated_transaction();

            $DB->update_record('enrol_programs_programs', $record);
            $program = self::make_snapshot($data->id, 'update_allocation');

            $trans->allow_commit();
        } else {
            $program = $oldprogram;
        }

        allocation::fix_allocation_sources($program->id, null);
        allocation::fix_enrol_instances($program->id);
        allocation::fix_user_enrolments($program->id, null);

        if ($updated) {
            allocation_calendar_event::fix_allocation_calendar_events($program);
            $event = \enrol_programs\event\program_updated::create_from_program($program);
            $event->trigger();
        }

        return $program;
    }

    /**
     * Returns all types of program start date.
     * @return array
     */
    public static function get_program_startdate_types(): array {
        return [
            'allocation' => get_string('programstart_allocation', 'enrol_programs'),
            'date' => get_string('fixeddate', 'enrol_programs'),
            'delay' => get_string('programstart_delay', 'enrol_programs'),
        ];
    }

    /**
     * Returns all types of program due date.
     * @return array
     */
    public static function get_program_duedate_types(): array {
        return [
            'notset' => get_string('notset', 'enrol_programs'),
            'date' => get_string('fixeddate', 'enrol_programs'),
            'delay' => get_string('programdue_delay', 'enrol_programs'),
        ];
    }

    /**
     * Returns all types of program end date.
     * @return array
     */
    public static function get_program_enddate_types(): array {
        return [
            'notset' => get_string('notset', 'enrol_programs'),
            'date' => get_string('fixeddate', 'enrol_programs'),
            'delay' => get_string('programend_delay', 'enrol_programs'),
        ];
    }

    /**
     * Parse form data for scheduling settings.
     *
     * @param string $name
     * @param stdClass $data
     */
    protected static function process_submitted_program_allocation_delay(string $name, stdClass $data): string {
        $type = $data->{'program' . $name . '_delay'}['type'];
        $value = (int)$data->{'program' . $name . '_delay'}['value'];
        unset($data->{'program' . $name . '_delay'});

        if ($value <= 0) {
            throw new \coding_exception('Invalid delay value');
        }
        if ($type === 'months') {
            return 'P' . $value . 'M';
        } else if ($type === 'days') {
            return 'P' . $value . 'D';
        } else if ($type === 'hours') {
            return 'PT' . $value . 'H';
        }
        throw new \coding_exception('Invalid delay type');
    }

    /**
     * Update program scheduling.
     *
     * @param stdClass $data
     * @return stdClass
     */
    public static function update_program_scheduling(stdClass $data): stdClass {
        global $DB;

        if (!isset($data->id) || !isset($data->programstart_type) || !isset($data->programdue_type) || !isset($data->programend_type)) {
            throw new \coding_exception('Invalid data');
        }

        $trans = $DB->start_delegated_transaction();

        $oldprogram = $DB->get_record('enrol_programs_programs', ['id' => $data->id], '*', MUST_EXIST);

        $record = new \stdClass();
        $record->id = $data->id;

        $types = self::get_program_startdate_types();
        if (!isset($types[$data->programstart_type])) {
            throw new \coding_exception('Invalid date type');
        }
        $json = ['type' => $data->programstart_type];
        if ($data->programstart_type === 'date') {
            $json['date'] = $data->programstart_date;
        } else if ($data->programstart_type === 'delay') {
            $json['delay'] = self::process_submitted_program_allocation_delay('start', $data);
        }
        $record->startdatejson = util::json_encode($json);

        $types = self::get_program_duedate_types();
        if (!isset($types[$data->programdue_type])) {
            throw new \coding_exception('Invalid date type');
        }
        $json = ['type' => $data->programdue_type];
        if ($data->programdue_type === 'date') {
            $json['date'] = $data->programdue_date;
        } else if ($data->programdue_type === 'delay') {
            $json['delay'] = self::process_submitted_program_allocation_delay('due', $data);
        }
        $record->duedatejson = util::json_encode($json);

        $types = self::get_program_enddate_types();
        if (!isset($types[$data->programend_type])) {
            throw new \coding_exception('Invalid date type');
        }
        $json = ['type' => $data->programend_type];
        if ($data->programend_type === 'date') {
            $json['date'] = $data->programend_date;
        } else if ($data->programend_type === 'delay') {
            $json['delay'] = self::process_submitted_program_allocation_delay('end', $data);
        }
        $record->enddatejson = util::json_encode($json);

        $DB->update_record('enrol_programs_programs', $record);

        $program = self::make_snapshot($data->id, 'update_scheduling');

        $trans->allow_commit();

        allocation::fix_allocation_sources($program->id, null);
        allocation::fix_enrol_instances($program->id);
        allocation::fix_user_enrolments($program->id, null);
        allocation_calendar_event::fix_allocation_calendar_events($program);

        $event = \enrol_programs\event\program_updated::create_from_program($program);
        $event->trigger();

        return $program;
    }

    /**
     * Delete program.
     *
     * @param int $id
     * @return void
     */
    public static function delete_program(int $id): void {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/group/lib.php');

        $trans = $DB->start_delegated_transaction();

        $program = $DB->get_record('enrol_programs_programs', ['id' => $id], '*', MUST_EXIST);
        $context = \context::instance_by_id($program->contextid);

        self::make_snapshot($program->id, 'delete_before');

        $allocations = $DB->get_records('enrol_programs_allocations', ['programid' => $program->id], 'userid ASC', 'id');
        foreach ($allocations as $allocation) {
            allocation::make_snapshot($allocation->id, 'program_delete');
        }
        unset($allocations);

        $pgs = $DB->get_records('enrol_programs_groups', ['programid' => $program->id]);
        foreach ($pgs as $pg) {
            groups_delete_group($pg->groupid);
        }

        // Delete notifications configuration and data.
        notification_manager::delete_program_notifications($program);

        $items = $DB->get_records('enrol_programs_items', ['programid' => $program->id]);
        foreach ($items as $item) {
            $DB->delete_records('enrol_programs_evidences', ['itemid' => $item->id]);
            $DB->delete_records('enrol_programs_completions', ['itemid' => $item->id]);
            $DB->delete_records('enrol_programs_prerequisites', ['itemid' => $item->id]);
            $DB->delete_records('enrol_programs_prerequisites', ['prerequisiteitemid' => $item->id]);
        }
        unset($items);
        $DB->delete_records('enrol_programs_allocations', ['programid' => $program->id]);
        $sources = $DB->get_records('enrol_programs_sources', ['programid' => $program->id]);
        foreach ($sources as $source) {
            $DB->delete_records('enrol_programs_requests', ['sourceid' => $source->id]);
            $DB->delete_records('enrol_programs_src_cohorts', ['sourceid' => $source->id]);
        }
        unset($sources);
        $DB->delete_records('enrol_programs_sources', ['programid' => $program->id]);
        $DB->delete_records('enrol_programs_cohorts', ['programid' => $program->id]);
        $DB->delete_records('enrol_programs_items', ['programid' => $program->id]);

        // Delete enrolment instances.
        allocation::fix_enrol_instances($program->id);

        // Program details last.
        \core_tag_tag::set_item_tags('enrol_programs', 'program', $program->id, $context, null);
        $fs = get_file_storage();
        $fs->delete_area_files($context->id, 'enrol_programs', 'description', $program->id);
        $fs->delete_area_files($context->id, 'enrol_programs', 'image', $program->id);

        $DB->delete_records('enrol_programs_programs', ['id' => $program->id]);

        self::make_snapshot($program->id, 'delete');

        $trans->allow_commit();

        allocation_calendar_event::delete_program_calendar_events($program->id);

        $event = \enrol_programs\event\program_deleted::create_from_program($program);
        $event->trigger();
    }

    /**
     * Make a full program snapshot.
     *
     * @param int $programid
     * @param string $reason
     * @param string|null $explanation
     * @return \stdClass|null null of program does not exist any more, program record otherwise
     */
    public static function make_snapshot(int $programid, string $reason, ?string $explanation = null): ?\stdClass {
        global $DB, $USER;

        $data = new \stdClass();
        $data->programid = $programid;
        $data->reason = $reason;
        $data->timesnapshot = time();
        if ($USER->id > 0) {
            $data->snapshotby = $USER->id;
        }
        $data->explanation = $explanation;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $programid]);
        if (!$program) {
            // Most have been just deleted.
            $DB->insert_record('enrol_programs_prg_snapshots', $data);
            return null;
        }

        $data->programjson = util::json_encode($program);
        $data->itemsjson = util::json_encode($DB->get_records('enrol_programs_items', ['programid' => $program->id], 'id ASC'));
        $data->cohortsjson = util::json_encode($DB->get_records('enrol_programs_cohorts', ['programid' => $program->id], 'id ASC'));
        $data->sourcesjson = util::json_encode($DB->get_records('enrol_programs_sources', ['programid' => $program->id], 'id ASC'));

        $DB->insert_record('enrol_programs_prg_snapshots', $data);

        return $program;
    }

    /**
     * Load program content.
     *
     * @param int $programid
     * @return content\top
     */
    public static function load_content(int $programid): content\top {
        return content\top::load($programid);
    }
}
