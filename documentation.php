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
 * Programs documentation.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/** @var moodle_page $PAGE */
/** @var core_renderer $OUTPUT */
/** @var stdClass $CFG */

require('../../config.php');
require_once($CFG->libdir . '/filelib.php');

$relativepath = get_file_argument();

$currenturl = new moodle_url('/enrol/programs/documentation.php');
$currenturl->set_slashargument($relativepath);
$PAGE->set_url($currenturl);

$syscontext = context_system::instance();
$PAGE->set_context($syscontext);

if ($CFG->forcelogin) {
    require_login();
}

if (!enrol_is_enabled('programs')) {
    redirect(new moodle_url('/'));
}

// This page is THE docs, do not show link to wiki!
$CFG->docroot = null;

if (!$relativepath) {
    redirect(new moodle_url('/'));
}
$docsroot = __DIR__ . '/docs/';

$langs = get_string_manager()->get_language_dependencies(current_language());
array_unshift($langs, 'en');
$langs = array_reverse($langs);
$file = null;
foreach ($langs as $lang) {
    if (file_exists($docsroot . $lang . $relativepath)) {
        $file = $docsroot . $lang . $relativepath;
        break;
    }
}
if ($file === null) {
    send_file_not_found();
}

if (substr($file, -4) === '.png') {
    send_file($file, basename($file), 60);

} else if (substr($file, -3) === '.md') {
    $content = file_get_contents($file);
    $content = markdown_to_html($content);
    $PAGE->set_heading(get_string('documentation', 'enrol_programs'));
    echo $OUTPUT->header();
    echo '<div id="programs_docs">';
    echo $content;
    echo '</div>';
    echo $OUTPUT->footer();
    die;

} else {
    send_file_not_found();
}

