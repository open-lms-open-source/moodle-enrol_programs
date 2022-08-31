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

namespace enrol_programs\local\form;

use enrol_programs\local\content\set;
use enrol_programs\local\content\top;

/**
 * Delete program content item.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class item_delete extends \local_openlms\dialog_form {
    protected function definition() {
        $mform = $this->_form;
        $item = $this->_customdata['item'];

        $mform->addElement('text', 'fullname', get_string('fullname'), 'maxlength="254" size="50"');
        $mform->setType('fullname', PARAM_TEXT);
        $mform->setDefault('fullname', format_string($item->get_fullname()));
        $mform->freeze('fullname');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $item->get_id());

        if ($item instanceof set) {
            $deletestr = get_string('deleteset', 'enrol_programs');
        } else {
            $deletestr = get_string('deletecourse', 'enrol_programs');
        }

        $this->add_action_buttons(true, $deletestr);
    }
}
