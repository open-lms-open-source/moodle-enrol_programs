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

defined('MOODLE_INTERNAL') || die();

/*
 * Program enrolment external functions.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = [
    'enrol_programs_form_source_manual_allocate_users' => [
        'classname' => 'enrol_programs\external\form_source_manual_allocate_users',
        'description' => 'Return list of user candidates for program allocation.',
        'type' => 'read',
        'ajax' => true,
        'loginrequired' => true,
    ],
    'enrol_programs_allocate_user' => [
        'classname' => 'enrol_programs\external\allocate_user',
        'description' => 'Allocates user to the program',
        'type' => 'write',
        'ajax' => false,
        'loginrequired' => true,
    ],
    'enrol_programs_get_program_status' => [
        'classname' => '\enrol_programs\external\get_program_status',
        'description' => 'Gets program status for user and program',
        'type' => 'read',
        'ajax' => false,
        'loginrequired' => true,
    ],
    'enrol_programs_get_allocation_source' => [
        'classname' => '\enrol_programs\external\get_allocation_source',
        'description' => 'Gets allocation source for user and program',
        'type' => 'read',
        'ajax' => false,
        'loginrequired' => true,
    ],
    'enrol_programs_create_cohort_allocation' => [
        'classname' => '\enrol_programs\external\create_cohort_allocation',
        'description' => 'Create new cohort allocation for existing cohort',
        'type' => 'write',
        'ajax' => false,
        'loginrequired' => true,
    ],
];
