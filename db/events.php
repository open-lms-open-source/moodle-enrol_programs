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
 * Program enrolment plugin events.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname'   => \core\event\course_updated::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::course_updated',
    ],
    [
        'eventname'   => \core\event\course_deleted::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::course_deleted',
    ],
    [
        'eventname'   => \core\event\course_category_deleted::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::course_category_deleted',
    ],
    [
        'eventname'   => \core\event\user_deleted::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::user_deleted',
    ],
    [
        'eventname'   => \core\event\cohort_member_added::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::cohort_member_added',
    ],
    [
        'eventname'   => \core\event\cohort_member_removed::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::cohort_member_removed',
    ],
    [
        'eventname'   => \core\event\course_completed::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::course_completed',
    ],
    [
        'eventname'   => \core\event\group_deleted::class,
        'callback'    => \enrol_programs\local\event_observer::class . '::group_deleted',
    ],
    [
        'eventname' => \tool_certificate\event\template_deleted::class,
        'callback' => \enrol_programs\local\certificate::class . '::template_deleted'
    ],
];
