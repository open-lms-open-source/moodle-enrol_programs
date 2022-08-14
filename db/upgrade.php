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
 * Program enrolment uninstallation.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_enrol_programs_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2022081400) {

        // Define table enrol_programs_certs to be created.
        $table = new xmldb_table('enrol_programs_certs');

        // Adding fields to table enrol_programs_certs.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('programid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('templateid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('expirydatetype', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null);
        $table->add_field('expirydateoffset', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table enrol_programs_certs.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('programid', XMLDB_KEY_FOREIGN_UNIQUE, ['programid'], 'enrol_programs_programs', ['id']);

        // Adding indexes to table enrol_programs_certs.
        $table->add_index('templateid', XMLDB_INDEX_NOTUNIQUE, ['templateid']);

        // Conditionally launch create table for enrol_programs_certs.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Define table enrol_programs_certs_issues to be created.
        $table = new xmldb_table('enrol_programs_certs_issues');

        // Adding fields to table enrol_programs_certs_issues.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('programid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('allocationid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('timecompleted', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('issueid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table enrol_programs_certs_issues.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('programid', XMLDB_KEY_FOREIGN, ['programid'], 'enrol_programs_programs', ['id']);
        $table->add_key('allocationid', XMLDB_KEY_FOREIGN, ['allocationid'], 'enrol_programs_allocations', ['id']);

        // Adding indexes to table enrol_programs_certs_issues.
        $table->add_index('issueid', XMLDB_INDEX_UNIQUE, ['issueid']);

        // Conditionally launch create table for enrol_programs_certs_issues.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2022081400, 'enrol', 'programs');
    }

    return true;
}
