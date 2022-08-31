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

namespace enrol_programs\local\content;

use enrol_programs\local\program;
use enrol_programs\local\util;
use enrol_programs\local\allocation;

/**
 * Program top item.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class top extends set {
    /** @var course[] list of orphaned courses in program */
    protected $orphanedcourses = [];

    /** @var set[] list of orphaned sets in program */
    protected $orphanedsets = [];

    /**
     * Is this item deletable?
     *
     * @return bool
     */
    public function is_deletable(): bool {
        return false;
    }

    /**
     * Returns expected item record data.
     *
     * @return array
     */
    protected function get_record(): array {
        global $DB;

        $program = $DB->get_record('enrol_programs_programs', ['id' => $this->programid], '*', MUST_EXIST);

        $record = parent::get_record();
        $record['topitem'] = '1';
        $record['fullname'] = $program->fullname;

        return $record;
    }

    /**
     * Create in memory program content structure representation.
     *
     * @param int $programid
     * @return top
     */
    public static function load(int $programid): top {
        global $DB;

        $records = $DB->get_records('enrol_programs_items', ['programid' => $programid], 'id ASC');
        if (!$records) {
            throw new \coding_exception('No program items found');
        }

        $prerequisites = self::get_prerequisites($programid);

        $toprecord = null;
        foreach ($records as $k => $record) {
            if ($record->topitem) {
                $toprecord = $record;
                unset($records[$k]);
                break;
            }
        }
        if (!$toprecord) {
            throw new \coding_exception('Missing top program item');
        }
        /** @var top $top */
        $top = set::init_from_record($toprecord, null, $records, $prerequisites);

        if ($records) {
            // Deal with orphans.
            foreach ($records as $record) {
                if ($record->topitem) {
                    throw new \coding_exception('only one item can be topitem');
                }
                if ($record->courseid) {
                    $fakerecords = [];
                    // Prevent course access by requiring program completion.
                    $orphan = course::init_from_record($record, $top, $fakerecords, $prerequisites);
                    if ($orphan->problemdetected) {
                        $top->problemdetected = true;
                    }
                    $top->orphanedcourses[$orphan->id] = $orphan;
                } else {
                    $record = clone($record);
                    $fakerecords = [];  // We do not want to load any children for orphaned sets.
                    $orphan = set::init_from_record($record, null, $fakerecords, $prerequisites);
                    if ($orphan->problemdetected) {
                        $top->problemdetected = true;
                    }
                    $top->orphanedsets[$orphan->id] = $orphan;
                }
            }
        }

        if ($prerequisites) {
            // Unexpected pre-requisites detected.
            $top->problemdetected = true;
        }

        return $top;
    }

    /**
     * Returns list of program courses that are not correctly linked to any valid set.
     *
     * @return course[]
     */
    public function get_orphaned_courses(): array {
        return $this->orphanedcourses;
    }

    /**
     * Returns list of sets that are not correctly linked to any valid set.
     *
     * @return set[]
     */
    public function get_orphaned_sets(): array {
        return $this->orphanedsets;
    }

    /**
     * Returns orphaned item with given id.
     *
     * @param int $itemid
     * @return item|null
     */
    public function find_orphaned_item(int $itemid): ?item {
        if (isset($this->orphanedcourses[$itemid])) {
            return $this->orphanedcourses[$itemid];
        }
        if (isset($this->orphanedsets[$itemid])) {
            return $this->orphanedsets[$itemid];
        }
        return null;
    }

    /**
     * Fetches all current prerequisites for given program id.
     *
     * @param int $programid
     * @return array
     */
    protected static function get_prerequisites(int $programid): array {
        global $DB;

        $sql = "SELECT p.*
                  FROM {enrol_programs_prerequisites} p
                  JOIN {enrol_programs_items} i ON i.id = p.itemid AND i.programid = :programid
                  JOIN {enrol_programs_items} pi ON pi.id = p.prerequisiteitemid AND pi.programid = i.programid
              ORDER BY p.id ASC";
        return $DB->get_records_sql($sql, ['programid' => $programid]);
    }

    /**
     * Add new course item to given parent set.
     *
     * @param set $parent
     * @param int $courseid
     * @return course
     */
    public function append_course(set $parent, int $courseid): course {
        global $DB;

        if ($parent->programid != $this->programid) {
            throw new \coding_exception('invalid programid');
        }
        if (isset($this->orphanedsets[$parent->id])) {
            throw new \coding_exception('orphaned set cannot be modified');
        }

        $course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);

        $record = [
            'id' => null,
            'programid' => (string)$this->programid,
            'topitem' => null,
            'courseid' => (string)$course->id,
            'previtemid' => null,
            'fullname' => $course->fullname,
            'sequencejson' => util::json_encode([]),
            'minprerequisites' => '1',
        ];
        $fakerecords = [];
        $fakeprerequisites = [];
        /** @var course $item */
        $item = course::init_from_record((object)$record, null, $fakerecords, $fakeprerequisites);

        $trans = $DB->start_delegated_transaction();
        $item->id = (string)$DB->insert_record('enrol_programs_items', (object)$item->get_record());
        $parent->add_child($item);
        $DB->update_record('enrol_programs_items', (object)$parent->get_record());

        $this->fix_content();

        program::make_snapshot($item->programid, 'item_append');
        $trans->allow_commit();

        // Do not use transactions for enrolments, we can always fix them later.
        allocation::fix_enrol_instances($this->programid);
        allocation::fix_user_enrolments($this->programid, null);

        return $item;
    }

    /**
     * Add new course set to given parent set.
     *
     * @param set $parent
     * @param string $fullname
     * @param string $sequencetype
     * @param int $minprerequisites
     * @return set
     */
    public function append_set(set $parent, string $fullname, string $sequencetype, int $minprerequisites = 1): set {
        global $DB;

        if ($parent->programid != $this->programid) {
            throw new \coding_exception('invalid programid');
        }
        if (isset($this->orphanedsets[$parent->id])) {
            throw new \coding_exception('orphaned set cannot be modified');
        }
        $types = set::get_sequencetype_types();
        if (!isset($types[$sequencetype])) {
            throw new \coding_exception('invalid sequence type');
        }

        if ($sequencetype !== set::SEQUENCE_TYPE_ATLEAST) {
            $minprerequisites = 1;
        } else {
            if ($minprerequisites <= 0) {
                throw new \coding_exception('Minimum prerequisites number is required');
            }
        }

        $sequence = [
            'children' => [],
            'type' => $sequencetype,
        ];

        $record = [
            'id' => null,
            'programid' => (string)$this->programid,
            'topitem' => null,
            'courseid' => null,
            'previtemid' => null,
            'fullname' => $fullname,
            'sequencejson' => util::json_encode($sequence),
            'minprerequisites' => (string)$minprerequisites,
        ];

        $fakerecords = [];
        $fakeprerequisites = [];
        /** @var set $item */
        $item = set::init_from_record((object)$record, null, $fakerecords, $fakeprerequisites);

        $trans = $DB->start_delegated_transaction();
        $item->id = (string)$DB->insert_record('enrol_programs_items', (object)$item->get_record());
        $parent->add_child($item);
        $DB->update_record('enrol_programs_items', (object)$parent->get_record());

        $this->fix_content();

        program::make_snapshot($item->programid, 'item_append');
        $trans->allow_commit();

        // Do not use transactions for enrolments, we can always fix them later.
        allocation::fix_enrol_instances($this->programid);
        allocation::fix_user_enrolments($this->programid, null);

        return $item;
    }

    /**
     * Update course set.
     *
     * @param set $set
     * @param string $fullname ignored in case of top item
     * @param string $sequencetype
     * @param int $minprerequisites
     * @return set
     */
    public function update_set(set $set, string $fullname, string $sequencetype, int $minprerequisites = 1): set {
        global $DB;

        if ($set->programid != $this->programid) {
            throw new \coding_exception('invalid programid');
        }
        if (isset($this->orphanedsets[$set->id])) {
            throw new \coding_exception('orphaned set cannot be modified');
        }
        $types = set::get_sequencetype_types();
        if (!isset($types[$sequencetype])) {
            throw new \coding_exception('invalid sequence type');
        }

        if ($set->get_id() != $this->id) {
            $set->fullname = $fullname;
        }
        $set->sequencetype = $sequencetype;
        if ($sequencetype !== set::SEQUENCE_TYPE_ALLINORDER) {
            $set->inorder = false;
        } else {
            $set->inorder = true;
        }
        if ($set->sequencetype !== set::SEQUENCE_TYPE_ATLEAST) {
            $set->minprerequisites = count($set->get_children());
            if (!$set->minprerequisites) {
                $set->minprerequisites = 1;
            }
        } else {
            if ($minprerequisites <= 0) {
                throw new \coding_exception('Minimum prerequisites number is required');
            }
            $set->minprerequisites = $minprerequisites;
        }

        $trans = $DB->start_delegated_transaction();
        $DB->update_record('enrol_programs_items', (object)$set->get_record());

        $this->fix_content();

        program::make_snapshot($set->programid, 'item_update');
        $trans->allow_commit();

        // Do not use transactions for enrolments, we can always fix them later.
        allocation::fix_enrol_instances($this->programid);
        allocation::fix_user_enrolments($this->programid, null);

        return $set;
    }

    /**
     * Move item to a different parent or position.
     *
     * @param int $itemid
     * @param int $parentid
     * @param int $position
     * @return bool
     */
    public function move_item(int $itemid, int $parentid, int $position): bool {
        global $DB;

        if ($itemid == $parentid) {
            debugging('Item cannot be moved to self', DEBUG_DEVELOPER);
            return false;
        }
        if ($itemid == $this->get_id()) {
            debugging('Top item cannot be moved', DEBUG_DEVELOPER);
            return false;
        }

        $item = $this->find_item($itemid);
        if (!$item) {
            debugging('Cannot find new item', DEBUG_DEVELOPER);
            return false;
        }
        $oldparent = $this->find_parent_set($item->get_id());
        if (!$oldparent) {
            debugging('Cannot find new item parent', DEBUG_DEVELOPER);
        }

        $newparent = $this->find_item($parentid);
        if (!$newparent || !($newparent instanceof set)) {
            debugging('Cannot find new parent of item', DEBUG_DEVELOPER);
            return false;
        }

        if ($item->find_item($newparent->get_id())) {
            debugging('Cannot move item to own child', DEBUG_DEVELOPER);
            return false;
        }

        $trans = $DB->start_delegated_transaction();

        if ($oldparent->get_id() != $newparent->get_id()) {
            foreach ($oldparent->children as $i => $child) {
                if ($child->get_id() == $item->get_id()) {
                    unset($oldparent->children[$i]);
                    $oldparent->children = array_values($oldparent->children);
                    break;
                }
            }
            if ($oldparent->sequencetype !== set::SEQUENCE_TYPE_ATLEAST) {
                $oldparent->minprerequisites = count($oldparent->children);
            }
            if ($oldparent->minprerequisites < 1) {
                $oldparent->minprerequisites = 1;
            }
            $DB->update_record('enrol_programs_items', (object)$oldparent->get_record());
        }

        $newchildren = [];
        $added = false;
        $i = 0;
        foreach ($newparent->children as $child) {
            if ($i == $position) {
                $newchildren[] = $item;
                $added = true;
            }
            if ($child->get_id() != $item->get_id()) {
                $newchildren[] = $child;
            }
            $i++;
        }
        if (!$added) {
            $newchildren[] = $item;
        }
        $newparent->children = $newchildren;
        if ($newparent->sequencetype !== set::SEQUENCE_TYPE_ATLEAST) {
            $newparent->minprerequisites = count($newparent->children);
        }
        if ($newparent->minprerequisites < 1) {
            $newparent->minprerequisites = 1;
        }
        $DB->update_record('enrol_programs_items', (object)$newparent->get_record());

        $this->fix_content();

        program::make_snapshot($this->programid, 'item_move');
        $trans->allow_commit();

        // Do not use transactions for enrolments, we can always fix them later.
        allocation::fix_enrol_instances($this->programid);
        allocation::fix_user_enrolments($this->programid, null);

        return true;
    }

    /**
     * Delete item if possible.
     *
     * @param int $itemid
     * @return bool true if item deleted
     */
    public function delete_item(int $itemid): bool {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/group/lib.php');

        $item = $this->find_item($itemid);
        if ($item) {
            if (!$item->is_deletable()) {
                return false;
            }
            $parent = $this->find_parent_set($item->get_id());
            if (!$parent) {
                debugging('Cannot find parent of item to be deleted', DEBUG_DEVELOPER);
                return false;
            }
            foreach ($parent->children as $i => $child) {
                if ($child->get_id() == $itemid) {
                    unset($parent->children[$i]);
                    break;
                }
            }
            $parent->children = array_values($parent->children);
            if ($parent->sequencetype !== set::SEQUENCE_TYPE_ATLEAST) {
                $parent->minprerequisites = count($parent->get_children());
                if (!$parent->minprerequisites) {
                    $parent->minprerequisites = 1;
                }
            }
        } else {
            $item = $this->find_orphaned_item($itemid);
            if (!$item) {
                return false;
            }
            // Do not bother with orphaned item parents, just delete it.
            $parent = null;
            if ($item instanceof course) {
                unset($this->orphanedcourses[$item->get_id()]);
            } else {
                unset($this->orphanedsets[$item->get_id()]);
            }
        }

        $trans = $DB->start_delegated_transaction();

        $record = $DB->get_record('enrol_programs_items', ['id' => $itemid], '*', MUST_EXIST);
        if ($record->courseid) {
            $groups = $DB->get_records('enrol_programs_groups', ['programid' => $record->programid, 'courseid' => $record->courseid]);
            foreach ($groups as $g) {
                groups_delete_group($g->groupid);
            }
        }
        $DB->delete_records('enrol_programs_prerequisites', ['itemid' => $itemid]);
        $DB->delete_records('enrol_programs_prerequisites', ['prerequisiteitemid' => $itemid]);
        if ($parent) {
            $parent->remove_chid($itemid);
            $DB->update_record('enrol_programs_items', (object)$parent->get_record());
        }
        $DB->delete_records('enrol_programs_evidences', ['itemid' => $itemid]);
        $DB->delete_records('enrol_programs_completions', ['itemid' => $itemid]);
        $DB->delete_records('enrol_programs_items', ['id' => $itemid]);

        $this->fix_content();

        program::make_snapshot($this->programid, 'item_delete');

        $trans->allow_commit();

        // Do not use transactions for enrolments, we can always fix them later.
        allocation::fix_enrol_instances($this->programid);
        allocation::fix_user_enrolments($this->programid, null);

        return true;
    }

    /**
     * Update content in database to match the in-memory representation.
     *
     * @return void
     */
    protected function fix_content(): void {
        global $DB;

        $this->fix_previous(null);

        $saveclosure = function(item $item) use (&$saveclosure, &$DB): void {
            $record = $item->get_record();
            if ($record['id']) {
                $oldrecord = $DB->get_record('enrol_programs_items', ['id' => $record['id']]);
                if ($oldrecord) {
                    foreach ((array)$oldrecord as $k => $v) {
                        if ($record[$k] !== $v) {
                            $DB->update_record('enrol_programs_items', (object)$record);
                            break;
                        }
                    }
                } else {
                    debugging('Ignoring update of missing item', DEBUG_DEVELOPER);
                }
            } else {
                $item->id = (string)$DB->insert_record('enrol_programs_items', $record);
            }

            foreach ($item->get_children() as $child) {
                $saveclosure($child);
            }
        };

        $saveclosure($this);

        foreach ($this->get_orphaned_courses() as $item) {
            $saveclosure($item);
        }
        foreach ($this->get_orphaned_sets() as $item) {
            $saveclosure($item);
        }

        // Fix all pre-requisites.
        $prerequisites = self::get_prerequisites($this->programid);
        $this->fix_prerequisites($prerequisites);
        foreach ($prerequisites as $prerequisite) {
            $DB->delete_records('enrol_programs_prerequisites', ['id' => $prerequisite->id]);
        }
    }

    /**
     * Attempt to automatically fix the content structure.
     *
     * @return void
     */
    public function autorepair(): void {
        global $DB;

        $trans = $DB->start_delegated_transaction();
        $this->fix_content();
        program::make_snapshot($this->programid, 'autorepair');
        $trans->allow_commit();

        // Do not use transactions for enrolments, we can always fix them later.
        allocation::fix_enrol_instances($this->programid);
        allocation::fix_user_enrolments($this->programid, null);
    }
}

