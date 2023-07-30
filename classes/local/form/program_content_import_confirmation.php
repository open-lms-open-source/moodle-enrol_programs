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
 * Add program content items confirmation.
 *
 * @package    enrol_programs
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class program_content_import_confirmation extends \local_openlms\dialog_form {
    protected function definition() {
        global $DB, $PAGE;
        $mform = $this->_form;

        $renderer = $PAGE->get_renderer('core', null, RENDERER_TARGET_GENERAL);

        $targetprogram = $DB->get_record('enrol_programs_programs', ['id' => $this->_customdata['id']], '*', MUST_EXIST);
        $fromprogram = $DB->get_record('enrol_programs_programs', ['id' => $this->_customdata['fromprogram']], '*', MUST_EXIST);

        $fromcontext = \context::instance_by_id($fromprogram->contextid);

        $a = new \stdClass();
        $a->fullname = format_string($fromprogram->fullname);
        $a->idnumber = s($fromprogram->idnumber);
        $a->category = $fromcontext->get_context_name(false);
        $message = get_string('importprogramcontentconfirmation', 'enrol_programs', $a);
        $message = markdown_to_html($message);
        $message = $renderer->notification($message, \core\notification::INFO);
        $mform->addElement('html', $message);

        /** @var \enrol_programs\output\catalogue\renderer $catalogueoutput */
        $catalogueoutput = $PAGE->get_renderer('enrol_programs', 'catalogue', 'general');

        $content = $catalogueoutput->render_program_content($fromprogram);
        $mform->addElement('html', $content);

        $mform->addElement('hidden', 'fromprogram');
        $mform->setType('fromprogram', PARAM_INT);
        $mform->setDefault('fromprogram', $fromprogram->id);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $targetprogram->id);

        $this->add_action_buttons(true, get_string('importprogramcontent', 'enrol_programs'));
    }

    public function validation($data, $files) {
        global $DB;
        $errors = parent::validation($data, $files);

        // Check if the user has capability to copy the selected program.
        $programid = $data['fromprogram'];
        $programcontextid = $DB->get_field('enrol_programs_programs', 'contextid', ['id' => $programid]);
        $context = \context::instance_by_id($programcontextid);
        if (!has_capability('enrol/programs:clone', $context )) {
            $errors['fromprogram'] = get_string('error');
        }
        return $errors;
    }
}
