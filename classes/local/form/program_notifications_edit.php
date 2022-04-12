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

/**
 * Edit program notifications.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_notifications_edit extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB;

        $mform = $this->_form;
        $program = $this->_customdata['program'];
        $context = $this->_customdata['context'];

        $sources = [];
        /** @var \enrol_programs\local\source\base[] $sourceclasses */
        $sourceclasses = \enrol_programs\local\allocation::get_source_classes();
        foreach ($sourceclasses as $sourcetype => $sourceclass) {
            $sourcerecord = $DB->get_record('enrol_programs_sources', ['type' => $sourcetype, 'programid' => $program->id]);
            if (!$sourcerecord) {
                continue;
            }
            $sources[$sourceclass::get_type()] = $sourcerecord;
        }

        if ($sources) {
            foreach ($sources as $sourcetype => $source) {
                $sourceclass = $sourceclasses[$sourcetype];
                $mform->addElement('advcheckbox', 'allocation_' . $sourcetype, $sourceclass::get_name());
                if ($source->notifyallocation) {
                    $mform->setDefault('allocation_' . $sourcetype, 1);
                }
            }
        }

        $mform->addElement('advcheckbox', 'notifystart', get_string('notification_start', 'enrol_programs'));

        $mform->addElement('advcheckbox', 'notifycompleted', get_string('notification_completion', 'enrol_programs'));
        $mform->addElement('advcheckbox', 'notifyduesoon', get_string('notification_duesoon', 'enrol_programs'));
        $mform->addElement('advcheckbox', 'notifydue', get_string('notification_due', 'enrol_programs'));
        $mform->addElement('advcheckbox', 'notifyendsoon', get_string('notification_endsoon', 'enrol_programs'));
        $mform->addElement('advcheckbox', 'notifyendcompleted', get_string('notification_endcompleted', 'enrol_programs'));
        $mform->addElement('advcheckbox', 'notifyendfailed', get_string('notification_endfailed', 'enrol_programs'));
        $mform->addElement('advcheckbox', 'notifydeallocation', get_string('notification_deallocation', 'enrol_programs'));

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $program->id);

        $this->add_action_buttons(true, get_string('updateprogram', 'enrol_programs'));

        $this->set_data($program);
    }

    public function validation($data, $files) {
        global $DB;
        $errors = parent::validation($data, $files);

        return $errors;
    }
}
