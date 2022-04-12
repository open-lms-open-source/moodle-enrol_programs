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

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Mink\Exception\ExpectationException;

/**
 * Program behat steps.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_enrol_programs extends behat_base {
    /**
     * Remove the useless Admin bookmarks block that takes precious screen space in tests.
     *
     * @Given Unnecessary Admin bookmarks block gets deleted
     */
    public function kill_admin_bookmark() {
        global $DB;
        $instances = $DB->get_records('block_instances', ['blockname' => 'admin_bookmarks']);
        foreach ($instances as $instance) {
            blocks_delete_instance($instance);
        }
    }

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

    /**
     * Looks for definition of a term in a list.
     *
     * @Then I should see :text in the :label definition list item
     *
     * @param string $label
     * @param string $text
     */
    public function list_term_contains_text($text, $label) {

        $labelliteral = behat_context_helper::escape($label);
        $xpath = "//dl/dt[text()=$labelliteral]/following-sibling::dd[1]";

        $nodes = $this->getSession()->getPage()->findAll('xpath', $xpath);
        if (empty($nodes)) {
            throw new ExpectationException(
                'Unable to find a term item with label = ' . $labelliteral,
                $this->getSession()
            );
        }
        if (count($nodes) > 1) {
            throw new ExpectationException(
                'Found more than one term item with label = ' . $labelliteral,
                $this->getSession()
            );
        }
        $node = reset($nodes);

        $xpathliteral = behat_context_helper::escape($text);
        $xpath = "/descendant-or-self::*[contains(., $xpathliteral)]" .
            "[count(descendant::*[contains(., $xpathliteral)]) = 0]";

        // Wait until it finds the text inside the container, otherwise custom exception.
        try {
            $nodes = $this->find_all('xpath', $xpath, false, $node);
        } catch (ElementNotFoundException $e) {
            throw new ExpectationException('"' . $text . '" text was not found in the "' . $label . '" term', $this->getSession());
        }

        // If we are not running javascript we have enough with the
        // element existing as we can't check if it is visible.
        if (!$this->running_javascript()) {
            return;
        }

        // We also check the element visibility when running JS tests. Using microsleep as this
        // is a repeated step and global performance is important.
        $this->spin(
            function($context, $args) {

                foreach ($args['nodes'] as $node) {
                    if ($node->isVisible()) {
                        return true;
                    }
                }

                throw new ExpectationException('"' . $args['text'] . '" text was found in the "' . $args['label'] . '" element but was not visible', $context->getSession());
            },
            array('nodes' => $nodes, 'text' => $text, 'label' => $label),
            false,
            false,
            true
        );
    }

    /**
     * Looks into definition of a term in a list and makes sure text is not there.
     *
     * @Then I should not see :text in the :label definition list item
     *
     * @param string $label
     * @param string $text
     */
    public function list_term_note_contains_text($text, $label) {

        $labelliteral = behat_context_helper::escape($label);
        $xpath = "//dl/dt[text()=$labelliteral]/following-sibling::dd[1]";

        $nodes = $this->getSession()->getPage()->findAll('xpath', $xpath);
        if (empty($nodes)) {
            throw new ExpectationException(
                'Unable to find a term item with label = ' . $labelliteral,
                $this->getSession()
            );
        }
        if (count($nodes) > 1) {
            throw new ExpectationException(
                'Found more than one term item with label = ' . $labelliteral,
                $this->getSession()
            );
        }
        $node = reset($nodes);

        $xpathliteral = behat_context_helper::escape($text);
        $xpath = "/descendant-or-self::*[contains(., $xpathliteral)]" .
            "[count(descendant::*[contains(., $xpathliteral)]) = 0]";

        $nodes = null;
        try {
            $nodes = $this->find_all('xpath', $xpath, false, $node);
        } catch (ElementNotFoundException $e) {
            // Good!
            $nodes = null;
        }
        if ($nodes) {
            throw new ExpectationException('"' . $text . '" text was found in the "' . $label . '" element', $this->getSession());
        }
    }
}
