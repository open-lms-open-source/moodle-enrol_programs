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

namespace enrol_programs\local\source;

/**
 * External database allocation source test.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\source\externaldb
 */
final class externaldb_test extends \advanced_testcase {
    protected function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_fix_allocations_from_external_database(): void {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $dbpath = $this->make_temp_directory('externaldb') . '/allocations.sqlite3';
        $this->initialise_external_database($dbpath);
        $this->configure_plugin($dbpath);

        $program = $generator->create_program(['sources' => ['externaldb' => []]]);
        $source = $DB->get_record('enrol_programs_sources', ['programid' => $program->id, 'type' => 'externaldb'], '*', MUST_EXIST);

        $user = $this->getDataGenerator()->create_user(['idnumber' => 'U-100']);
        $this->insert_external_record($dbpath, $program->idnumber, $user->idnumber);

        $this->assertTrue(externaldb::is_configured());

        externaldb::fix_allocations($program->id, null);
        $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id], '*', MUST_EXIST);
        $this->assertSame('0', (string)$allocation->archived);
        $data = json_decode($allocation->sourcedatajson);
        $this->assertSame($user->idnumber, $data->remoteuser);
        $this->assertSame($program->idnumber, $data->programvalue);

        // Remove the external record, user allocation should be archived.
        $this->clear_external_records($dbpath);
        externaldb::fix_allocations($program->id, null);
        $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $allocation->id], '*', MUST_EXIST);
        $this->assertSame('1', (string)$allocation->archived);

        // Add the record again and synchronise single user.
        $this->insert_external_record($dbpath, $program->idnumber, $user->idnumber);
        externaldb::fix_allocations($program->id, $user->id);
        $allocation = $DB->get_record('enrol_programs_allocations', ['id' => $allocation->id], '*', MUST_EXIST);
        $this->assertSame('0', (string)$allocation->archived);

        // Remove the source and confirm allocations persist until config changes.
        $DB->delete_records('enrol_programs_sources', ['id' => $source->id]);
        // No exception should be triggered when configuration missing.
        $this->assertFalse(externaldb::fix_allocations($program->id, null));
    }

    /**
     * Prepare sqlite database with allocation table.
     *
     * @param string $path
     * @return void
     */
    private function initialise_external_database(string $path): void {
        $db = new \SQLite3($path);
        $db->exec('CREATE TABLE allocations (programcode TEXT, usercode TEXT)');
        $db->close();
    }

    /**
     * Configure plugin level settings for external DB connection.
     *
     * @param string $path
     * @return void
     */
    private function configure_plugin(string $path): void {
        set_config('source_externaldb_allownew', 1, 'enrol_programs');
        set_config('source_externaldb_dbtype', 'sqlite3', 'enrol_programs');
        set_config('source_externaldb_dbhost', $path, 'enrol_programs');
        set_config('source_externaldb_dbuser', '', 'enrol_programs');
        set_config('source_externaldb_dbpass', '', 'enrol_programs');
        set_config('source_externaldb_dbname', '', 'enrol_programs');
        set_config('source_externaldb_dbencoding', 'utf-8', 'enrol_programs');
        set_config('source_externaldb_dbsetupsql', '', 'enrol_programs');
        set_config('source_externaldb_dbsybasequoting', 0, 'enrol_programs');
        set_config('source_externaldb_debugdb', 0, 'enrol_programs');
        set_config('source_externaldb_remotetable', 'allocations', 'enrol_programs');
        set_config('source_externaldb_programfield', 'programcode', 'enrol_programs');
        set_config('source_externaldb_userfield', 'usercode', 'enrol_programs');
        set_config('source_externaldb_localprogramfield', 'idnumber', 'enrol_programs');
        set_config('source_externaldb_localuserfield', 'idnumber', 'enrol_programs');
        set_config('source_externaldb_archivemissing', 1, 'enrol_programs');
    }

    /**
     * Insert a record into the external allocation table.
     *
     * @param string $path
     * @param string $programcode
     * @param string $usercode
     * @return void
     */
    private function insert_external_record(string $path, string $programcode, string $usercode): void {
        $db = new \SQLite3($path);
        $stmt = $db->prepare('INSERT INTO allocations (programcode, usercode) VALUES (:programcode, :usercode)');
        $stmt->bindValue(':programcode', $programcode, SQLITE3_TEXT);
        $stmt->bindValue(':usercode', $usercode, SQLITE3_TEXT);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    /**
     * Delete all records from the external allocation table.
     *
     * @param string $path
     * @return void
     */
    private function clear_external_records(string $path): void {
        $db = new \SQLite3($path);
        $db->exec('DELETE FROM allocations');
        $db->close();
    }
}
