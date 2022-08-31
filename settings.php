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

/**
 * Program management interface.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/** @var core_renderer $OUTPUT */
/** @var admin_root $ADMIN */

defined('MOODLE_INTERNAL') || die();

// Do not use enrol plugin settings, create a top level management section.
$settings = null;

$ADMIN->add('root', new admin_category('programs', new lang_string('programs', 'enrol_programs')), 'analytics');

$programsenabled = enrol_is_enabled('programs');
$ADMIN->add('programs', new admin_externalpage('programsmanagement',
    new lang_string('management', 'enrol_programs'),
    new moodle_url("/enrol/programs/management/index.php"),
    'enrol/programs:view', !$programsenabled));

$settings = new admin_settingpage('programssettings', new lang_string('settings', 'enrol_programs'), 'moodle/site:config');
$ADMIN->add('programs', $settings);
if ($ADMIN->fulltree) {
    if (!$programsenabled) {
        $url = new moodle_url('/admin/enrol.php', ['sesskey' => sesskey(), 'action' => 'enable', 'enrol' => 'programs']);
        $a = new stdClass();
        $a->url = $url->out(false);
        $notify = get_string('plugindisabled', 'enrol_programs', $a);
        $notify = markdown_to_html($notify);
        $notify = new \core\output\notification($notify, \core\output\notification::NOTIFY_WARNING);
        $settings->add(new admin_setting_heading('enrol_programs_enable_plugin', '', $OUTPUT->render($notify)));
    }
    if (!during_initial_install()) {
        $options = get_default_enrol_roles(context_system::instance());
        $student = get_archetype_roles('student');
        $student = reset($student);
        $settings->add(new admin_setting_configselect('enrol_programs/roleid',
            new lang_string('enrolrole', 'enrol_programs'),
            new lang_string('enrolrole_desc', 'enrol_programs'),
            $student->id ?? null, $options));

        unset($options);
        unset($student);
    }

    $settings->add(new admin_setting_configcheckbox('enrol_programs/source_approval_allownew',
        new lang_string('source_approval_allownew', 'enrol_programs'),
        new lang_string('source_approval_allownew_desc', 'enrol_programs'), 1));
    $settings->add(new admin_setting_configcheckbox('enrol_programs/source_cohort_allownew',
        new lang_string('source_cohort_allownew', 'enrol_programs'),
        new lang_string('source_cohort_allownew_desc', 'enrol_programs'), 1));
    $settings->add(new admin_setting_configcheckbox('enrol_programs/source_selfallocation_allownew',
        new lang_string('source_selfallocation_allownew', 'enrol_programs'),
        new lang_string('source_selfallocation_allownew_desc', 'enrol_programs'), 1));
}
unset($programsenabled);

// Do not use enrol plugin settings, create a top level management section.
$settings = null;
