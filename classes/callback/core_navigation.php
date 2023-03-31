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

namespace enrol_programs\callback;

use \moodle_url;

/**
 * Callbacks from core_navigation related code.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS
 * @author     Petr Skoda
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_navigation {
    /**
     * Callback method for tweaking of primary navigation.
     */
    public static function core_navigation_primary(\local_olms_work\hook\core_navigation_primary $hook): void {
        if (PHPUNIT_TEST) {
            return;
        }
        if (isloggedin() && !isguestuser() && enrol_is_enabled('programs')) {
            $hook->primary->add(
                get_string('myprograms', 'enrol_programs'),
                new moodle_url('/enrol/programs/my/index.php'),
                $hook->primary::TYPE_CUSTOM, null, 'myprograms', new \pix_icon('myprograms', '', 'enrol_programs'));

            if (has_capability('enrol/programs:viewcatalogue', \context_system::instance(), null, false)) {
                $hook->primary->add(
                    get_string('catalogue', 'enrol_programs'),
                    new moodle_url('/enrol/programs/catalogue/index.php'),
                    $hook->primary::TYPE_CUSTOM, null, 'programscatalogue', new \pix_icon('catalogue', '', 'enrol_programs'));
            }
        }
    }
}
