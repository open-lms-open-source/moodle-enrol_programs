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

    if ($oldversion < 2022121600) {

        // Define field sourceinstanceid to be added to enrol_programs_allocations.
        $table = new xmldb_table('enrol_programs_allocations');
        $field = new xmldb_field('sourceinstanceid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'sourcedatajson');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define index sourceinstanceid (not unique) to be added to enrol_programs_allocations.
        $table = new xmldb_table('enrol_programs_allocations');
        $index = new xmldb_index('sourceinstanceid', XMLDB_INDEX_NOTUNIQUE, ['sourceinstanceid']);
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Define field sourceinstanceid to be added to enrol_programs_usr_snapshots.
        $table = new xmldb_table('enrol_programs_usr_snapshots');
        $field = new xmldb_field('sourceinstanceid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'sourcedatajson');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2022121600, 'enrol', 'programs');
    }

    if ($oldversion < 2022121700) {

        // Define table enrol_programs_frameworks to be created.
        $table = new xmldb_table('enrol_programs_frameworks');

        // Adding fields to table enrol_programs_frameworks.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('sourceid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('frameworkid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('requirecap', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table enrol_programs_frameworks.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('sourceid', XMLDB_KEY_FOREIGN, ['sourceid'], 'enrol_programs_sources', ['id']);

        // Adding indexes to table enrol_programs_frameworks.
        $table->add_index('frameworkid-sourceid', XMLDB_INDEX_UNIQUE, ['frameworkid', 'sourceid']);

        // Conditionally launch create table for enrol_programs_frameworks.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2022121700, 'enrol', 'programs');
    }

    if ($oldversion < 2023031500) {

        // Define field auxint1 to be added to enrol_programs_sources.
        $table = new xmldb_table('enrol_programs_sources');
        $field = new xmldb_field('auxint1', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'notifyallocation');

        // Conditionally launch add field auxint1.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('auxint2', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'auxint1');

        // Conditionally launch add field auxint2.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('auxint3', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'auxint2');

        // Conditionally launch add field auxint3.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023031500, 'enrol', 'programs');
    }

    if ($oldversion < 2023031502) {

        // Define table enrol_programs_src_cohorts to be created.
        $table = new xmldb_table('enrol_programs_src_cohorts');

        // Adding fields to table enrol_programs_src_cohorts.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('sourceid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('cohortid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table enrol_programs_src_cohorts.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('cohortid', XMLDB_KEY_FOREIGN, ['cohortid'], 'cohort', ['id']);
        $table->add_key('sourceid', XMLDB_KEY_FOREIGN, ['sourceid'], 'enrol_programs_sources', ['id']);

        // Adding indexes to table enrol_programs_src_cohorts.
        $table->add_index('sourceid-cohortid', XMLDB_INDEX_UNIQUE, ['sourceid', 'cohortid']);

        // Conditionally launch create table for enrol_programs_src_cohorts.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        $DB->set_field('enrol_programs_sources', 'auxint1', '1', ['type' => 'cohort']);

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023031502, 'enrol', 'programs');
    }

    if ($oldversion < 2023051400) {
        // Always use separate cohorts table for cohort sync.
        $sources = $DB->get_records('enrol_programs_sources', ['type' => 'cohort', 'auxint1' => 1]);
        foreach ($sources as $source) {
            $visible = $DB->get_records('enrol_programs_cohorts', ['programid' => $source->programid], '', 'cohortid');
            $current = $DB->get_records('enrol_programs_src_cohorts', ['sourceid' => $source->id], '', 'cohortid');
            foreach (array_keys($visible) as $cohortid) {
                if (isset($current[$cohortid])) {
                    unset($current[$cohortid]);
                    continue;
                }
                $DB->insert_record('enrol_programs_src_cohorts', ['sourceid' => $source->id, 'cohortid' => $cohortid]);
            }
            foreach (array_keys($current) as $cohortid) {
                $DB->delete_records('enrol_programs_src_cohorts', ['sourceid' => $source->id, 'cohortid' => $cohortid]);
            }
        }
        $DB->set_field('enrol_programs_sources', 'auxint1', null, ['type' => 'cohort']);

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023051400, 'enrol', 'programs');
    }

    if ($oldversion < 2023080900) {
        // Changing nullability of field minprerequisites on table enrol_programs_items to null.
        $table = new xmldb_table('enrol_programs_items');
        $field = new xmldb_field('minprerequisites', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'sequencejson');
        $dbman->change_field_notnull($table, $field);

        // Migrade course items.
        $sql = "UPDATE {enrol_programs_items}
                   SET minprerequisites = NULL
                 WHERE courseid IS NOT NULL";
        $DB->execute($sql);

        // Define field points to be added to enrol_programs_items.
        $table = new xmldb_table('enrol_programs_items');
        $field = new xmldb_field('points', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '1', 'minprerequisites');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define field minpoints to be added to enrol_programs_items.
        $table = new xmldb_table('enrol_programs_items');
        $field = new xmldb_field('minpoints', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'points');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define index minprerequisites (not unique) to be added to enrol_programs_items.
        $table = new xmldb_table('enrol_programs_items');
        $index = new xmldb_index('minprerequisites', XMLDB_INDEX_NOTUNIQUE, ['minprerequisites']);
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Define index points (not unique) to be added to enrol_programs_items.
        $table = new xmldb_table('enrol_programs_items');
        $index = new xmldb_index('points', XMLDB_INDEX_NOTUNIQUE, ['points']);
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Define index minpoints (not unique) to be added to enrol_programs_items.
        $table = new xmldb_table('enrol_programs_items');
        $index = new xmldb_index('minpoints', XMLDB_INDEX_NOTUNIQUE, ['minpoints']);
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }
        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023080900, 'enrol', 'programs');
    }

    if ($oldversion < 2023081100) {
        // Define field completiondelay to be added to enrol_programs_items.
        $table = new xmldb_table('enrol_programs_items');
        $field = new xmldb_field('completiondelay', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'minpoints');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define index timecompleted (not unique) to be added to enrol_programs_completions.
        $table = new xmldb_table('enrol_programs_completions');
        $index = new xmldb_index('timecompleted', XMLDB_INDEX_NOTUNIQUE, ['timecompleted']);
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023081100, 'enrol', 'programs');
    }

    if ($oldversion < 2023081200) {
        // Do not use calendar API here, calendar events will be fixed during next cron run.
        $DB->delete_records('event', ['component' => 'enrol_programs']);

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023081200, 'enrol', 'programs');
    }

    if ($oldversion < 2023100700) {
        $table = new xmldb_table('enrol_programs_programs');
        $index = new xmldb_index('archived', XMLDB_INDEX_NOTUNIQUE, ['archived']);
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        $table = new xmldb_table('enrol_programs_items');
        $index = new xmldb_index('programid-courseid', XMLDB_INDEX_NOTUNIQUE, ['programid', 'courseid']);
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023100700, 'enrol', 'programs');
    }

    if ($oldversion < 2023112500) {
        // Define table enrol_programs_src_commholds to be created.
        $table = new xmldb_table('enrol_programs_src_commholds');

        // Adding fields to table enrol_programs_src_commholds.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('quantity', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('holdkey', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('programid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table enrol_programs_src_commholds.
        $table->add_key('id', XMLDB_KEY_PRIMARY, ['id']);
        $table->add_key('userid', XMLDB_KEY_FOREIGN, ['userid'], 'user', ['id']);
        $table->add_key('programid', XMLDB_KEY_FOREIGN, ['programid'], 'enrol_programs_programs', ['id']);

        // Adding indexes to table enrol_programs_src_commholds.
        $table->add_index('holdkey', XMLDB_INDEX_NOTUNIQUE, ['holdkey']);

        // Conditionally launch create table for enrol_programs_src_commholds.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2023112500, 'enrol', 'programs');
    }

    if ($oldversion < 2024032500) {
        $table = new xmldb_table('enrol_programs_items');
        $field = new xmldb_field('frameworkid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'courseid');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $table = new xmldb_table('enrol_programs_items');
        $key = new xmldb_key('frameworkid', XMLDB_KEY_FOREIGN, ['frameworkid'], 'customfield_training_frameworks', ['id']);
        $dbman->add_key($table, $key);

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2024032500, 'enrol', 'programs');
    }

    if ($oldversion < 2024071100) {
        // There was a foreign key and index on groupid in install.xml which was incorrect.

        // Define key groupid (foreign) to be dropped form enrol_programs_groups - pre 3.1.0 sites.
        $table = new xmldb_table('enrol_programs_groups');
        $key = new xmldb_key('groupid', XMLDB_KEY_FOREIGN, ['groupid'], 'groups', ['id']);

        // Launch drop key groupid.
        $dbman->drop_key($table, $key);

        // Define key groupid (foreign unique) to be added to enrol_programs_groups  - 3.1.0 sites.
        $table = new xmldb_table('enrol_programs_groups');
        $key = new xmldb_key('groupid', XMLDB_KEY_FOREIGN_UNIQUE, ['groupid'], 'groups', ['id']);

        // Launch drop key groupid.
        $dbman->drop_key($table, $key);

        // Define index groupid (unique) to be dropped form enrol_programs_groups.
        $table = new xmldb_table('enrol_programs_groups');
        $index = new xmldb_index('groupid', XMLDB_INDEX_UNIQUE, ['groupid']);

        // Conditionally launch drop index groupid.
        if ($dbman->index_exists($table, $index)) {
            $dbman->drop_index($table, $index);
        }

        // Define key groupid (foreign unique) to be added to enrol_programs_groups.
        $table = new xmldb_table('enrol_programs_groups');
        $key = new xmldb_key('groupid', XMLDB_KEY_FOREIGN_UNIQUE, ['groupid'], 'groups', ['id']);

        // Launch add key groupid.
        $dbman->add_key($table, $key);

        // Programs savepoint reached.
        upgrade_plugin_savepoint(true, 2024071100, 'enrol', 'programs');
    }

<<<<<<< HEAD
=======
    if ($oldversion < 2024112400) {
        if (get_config('enrol_programs', 'source_externaldb_allownew') === false) {
            set_config('source_externaldb_allownew', 0, 'enrol_programs');
        }
        if (get_config('enrol_programs', 'source_externaldb_archivemissing') === false) {
            set_config('source_externaldb_archivemissing', 1, 'enrol_programs');
        }

        upgrade_plugin_savepoint(true, 2024112400, 'enrol', 'programs');
    }

>>>>>>> e3f9c16 (Add privacy provider tests and cron task tests for enrol_programs plugin)
    return true;
}
