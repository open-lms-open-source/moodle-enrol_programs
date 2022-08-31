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

/**
 * Program item abstraction.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class item {
    /** @var ?int */
    protected $id = null;
    /** @var int */
    protected $programid;
    /** @var string */
    protected $fullname;
    /** @var bool */
    protected $problemdetected = false;

    /**
     * Item instances can be created only from the top class.
     */
    protected function __construct() {
        // Properties are initialised from init_from_record() method.
    }

    /**
     * Factory method.
     *
     * @param \stdClass $record
     * @param item|null $previous
     * @param array $unusedrecords
     * @param array $prerequisites
     * @return item
     */
    abstract protected static function init_from_record(\stdClass $record, ?item $previous, array &$unusedrecords, array &$prerequisites): item;

    /**
     * Fix item prerequisites if necessary.
     *
     * @param array $prerequisites
     * @return bool true if fix applied
     */
    abstract protected function fix_prerequisites(array &$prerequisites): bool;

    /**
     * Set previous item to new value.
     *
     * @param item|null $previous new previous item
     * @return void
     */
    abstract protected function fix_previous(?item $previous): void;

    /**
     * Returns item full name.
     *
     * @return string
     */
    public function get_fullname(): string {
        return format_string($this->fullname);
    }

    /**
     * Returns item id.
     *
     * @return int|null
     */
    public function get_id(): ?int {
        return $this->id;
    }

    /**
     * Returns program id.
     *
     * @return int
     */
    public function get_programid(): int {
        return $this->programid;
    }

    /**
     * Is this a course item?
     *
     * @return bool
     */
    final public function is_course(): bool {
        return ($this instanceof course);
    }

    /**
     * Is this item deletable?
     *
     * @return bool
     */
    public function is_deletable(): bool {
        if (!$this->id) {
            return false;
        }
        if ($this->get_children()) {
            return false;
        }
        return true;
    }

    /**
     * @return item[]
     */
    public function get_children(): array {
        return [];
    }

    /**
     * Search for item by id.
     *
     * @param int $itemid
     * @return item|null
     */
    final public function find_item(int $itemid): ?item {
        if ($this->id == $itemid) {
            return $this;
        }
        $children = $this->get_children();
        foreach ($children as $child) {
            $found = $child->find_item($itemid);
            if ($found) {
                return $found;
            }
        }
        return null;
    }

    /**
     * Look for parent of item with given id.
     *
     * @param int $itemid
     * @return set|null
     */
    final public function find_parent_set(int $itemid): ?set {
        if (!($this instanceof set)) {
            return null;
        }
        if ($this->id == $itemid) {
            return null;
        }
        $children = $this->get_children();
        foreach ($children as $child) {
            if ($child->id == $itemid) {
                return $this;
            }
            $found = $child->find_parent_set($itemid);
            if ($found) {
                return $found;
            }
        }
        return null;
    }

    /**
     * Was there any program detected in this item during loading?
     *
     * @return bool
     */
    public function is_problem_detected(): bool {
        return $this->problemdetected;
    }

    /**
     * Returns expected item record data.
     *
     * @return array
     */
    abstract protected function get_record(): array;
}

