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

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

/**
 * Program behat steps.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_enrol_programs extends behat_base {
    /**
     * Opens program management page with all programs.
     *
     * @Given I am on all programs management page
     */
    public function i_am_on_all_programs_management_page() {
        $url = new moodle_url('/enrol/programs/management/index.php');
        $this->execute('behat_general::i_visit', [$url]);
    }

    /**
     * Opens program management page for course category or system.
     *
     * @Given I am on programs management page in :categoryname
     *
     * @param string $categoryname The full name of the course category
     */
    public function i_am_on_programs_management_page(string $categoryname) {
        global $DB;
        if (strtolower($categoryname) === 'system' || trim($categoryname) === '') {
            $context = context_system::instance();
        } else {
            $category = $DB->get_record("course_categories", ['name' => $categoryname], 'id', MUST_EXIST);
            $context = context_coursecat::instance($category->id);
        }
        $url = new moodle_url('/enrol/programs/management/index.php', ['contextid' => $context->id]);
        $this->execute('behat_general::i_visit', [$url]);
    }

    /**
     * Opens program catalogue page.
     *
     * @Given I am on Program catalogue page
     */
    public function i_am_on_program_catalogue_page() {
        $url = new moodle_url('/enrol/programs/catalogue/index.php');
        $this->execute('behat_general::i_visit', [$url]);
    }

    /**
     * Opens My programs page.
     *
     * @Given I am on My programs page
     */
    public function i_am_on_my_programs_page() {
        $url = new moodle_url('/enrol/programs/my/index.php');
        $this->execute('behat_general::i_visit', [$url]);
    }
}
