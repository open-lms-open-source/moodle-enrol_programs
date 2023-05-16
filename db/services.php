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
        'classname' => enrol_programs\external\form_source_manual_allocate_users::class,
        'description' => 'Return list of user candidates for program allocation.',
        'type' => 'read',
        'ajax' => true,
        'loginrequired' => true,
    ],
    'enrol_programs_get_programs' => [
        'classname' => enrol_programs\external\get_programs::class,
        'description' => 'Return list of programs that match the search parameters.',
        'type' => 'read',
    ],
    'enrol_programs_get_program_allocations' => [
        'classname' => enrol_programs\external\get_program_allocations::class,
        'description' => 'Return list of program allocations for given programid and optional userids.',
        'type' => 'read',
    ],
    'enrol_programs_source_manual_allocate_users' => [
        'classname' => enrol_programs\external\source_manual_allocate_users::class,
        'description' => 'Allocates users or cohorts to the program.',
        'type' => 'write',
    ],
    'enrol_programs_delete_program_allocations' => [
        'classname' => enrol_programs\external\delete_program_allocations::class,
        'description' => 'Deallocates users from the program.',
        'type' => 'write',
    ],
    'enrol_programs_update_program_allocation' => [
        'classname' => enrol_programs\external\update_program_allocation::class,
        'description' => 'Updates the allocation for the user and the program.',
        'type' => 'write',
    ],
    'enrol_programs_source_cohort_get_cohorts' => [
        'classname' => enrol_programs\external\source_cohort_get_cohorts::class,
        'description' => 'Gets list of cohort that are synced with the program cohort allocation.',
        'type' => 'read',
    ],
    'enrol_programs_source_cohort_add_cohort' => [
        'classname' => enrol_programs\external\source_cohort_add_cohort::class,
        'description' => 'Add cohort to the list of synchronised cohorts of one program.',
        'type' => 'write',
    ],
    'enrol_programs_source_cohort_delete_cohort' => [
        'classname' => enrol_programs\external\source_cohort_delete_cohort::class,
        'description' => 'Removes a cohort from the list of synchronised cohorts of one program.',
        'type' => 'write',
    ],
];
