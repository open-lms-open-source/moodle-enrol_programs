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

namespace enrol_programs\local\navmenu;

use local_navmenu\local\itemtype\root;
use local_navmenu\local\itemtype\pluginbase;

/**
 * Programs catalogue menu item.
 *
 * @package    tool_udplans
 * @author     Petr Skoda
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class enrol_programs_catalogue extends pluginbase {
    /**
     * Human-readable item type name.
     *
     * @return string
     */
    public static function get_type_name(): string {
        return get_string('catalogue', 'enrol_programs');
    }

    /**
     * Returns item URL.
     *
     * @return string
     */
    public function get_url(): string {
        $url = new \moodle_url('/enrol/programs/catalogue/index.php');
        return $url->out(false);
    }

    /**
     * Is item available for any user?
     *
     * @return bool
     */
    public static function is_available(): bool {
        if (!enrol_is_enabled('programs')) {
            return false;
        }
        return parent::is_available();
    }

    /**
     * Is current user allowed to see the item?
     *
     * @return bool
     */
    public function is_visible(root $root): bool {
        if (!isloggedin() || isguestuser()) {
            return false;
        }
        return parent::is_visible($root);
    }

    /**
     * Returns true if item is active in primary menu.
     *
     * @param bool $exactmatch first called with true to, then with false in case no exact match found
     * @return bool
     */
    public function is_active_item(bool $exactmatch): bool {
        global $PAGE;

        if ($exactmatch) {
            return $PAGE->url->compare(new \moodle_url($this->get_url()), URL_MATCH_BASE);
        }

        return false;
    }
}
