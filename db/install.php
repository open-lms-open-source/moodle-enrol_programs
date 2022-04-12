<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Program enrolment plugin installation.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c] 2022 Open LMS (https://www.openlms.net/]
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_enrol_programs_install() {
    global $CFG, $DB;

    // Unfortunately there is no proper API to enable enrol plugin during installation.

    $enabled = explode(',', $CFG->enrol_plugins_enabled);
    $enabled[] = 'programs';
    set_config('enrol_plugins_enabled', implode(',', $enabled));
    core_plugin_manager::reset_caches();
}
