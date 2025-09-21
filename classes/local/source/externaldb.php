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

use enrol_programs\local\allocation;
use enrol_programs\local\util;
use stdClass;

/**
 * Program allocation driven by an external database table.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class externaldb extends base {
    /**
     * Type identifier used in DB.
     */
    public static function get_type(): string {
        return 'externaldb';
    }

    /**
     * Check if connection configuration is complete.
     *
     * @return bool
     */
    public static function is_configured(): bool {
        return (bool)static::get_external_config();
    }

    /**
     * Expose connection configuration for forms.
     *
     * @return stdClass|null
     */
    public static function get_connection_settings(): ?stdClass {
        return static::get_external_config();
    }

    /**
     * Decode extra source settings.
     *
     * @param stdClass $source
     * @return stdClass
     */
    public static function decode_datajson(stdClass $source): stdClass {
        $source->externaldb_programvalue = '';
        $source->externaldb_archivemissing = (int)(bool)get_config('enrol_programs', 'source_externaldb_archivemissing');

        if (isset($source->datajson)) {
            $data = json_decode($source->datajson);
            if ($data) {
                if (!empty($data->programvalue)) {
                    $source->externaldb_programvalue = $data->programvalue;
                }
                if (isset($data->archivemissing)) {
                    $source->externaldb_archivemissing = (int)(bool)$data->archivemissing;
                }
            }
        }

        return $source;
    }

    /**
     * Encode extra source settings.
     *
     * @param stdClass $formdata
     * @return string
     */
    public static function encode_datajson(stdClass $formdata): string {
        $data = [
            'programvalue' => ''
        ];
        $value = trim($formdata->externaldb_programvalue ?? '');
        if ($value !== '') {
            $data['programvalue'] = $value;
        }
        if (isset($formdata->externaldb_archivemissing)) {
            $data['archivemissing'] = (int)(bool)$formdata->externaldb_archivemissing;
        } else {
            $data['archivemissing'] = (int)(bool)get_config('enrol_programs', 'source_externaldb_archivemissing');
        }
        return util::json_encode($data);
    }

    /**
     * Can settings of this source be imported to other program?
     *
     * @param stdClass $fromprogram
     * @param stdClass $targetprogram
     * @return bool
     */
    public static function is_import_allowed(stdClass $fromprogram, stdClass $targetprogram): bool {
        global $DB;

        if (!$DB->record_exists('enrol_programs_sources', ['type' => static::get_type(), 'programid' => $fromprogram->id])) {
            return false;
        }

        if (!$DB->record_exists('enrol_programs_sources', ['type' => static::get_type(), 'programid' => $targetprogram->id])) {
            if (!static::is_new_allowed($targetprogram)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Import source data from one program to another.
     *
     * @param int $fromprogramid
     * @param int $targetprogramid
     * @return stdClass created or updated source record
     */
    public static function import_source_data(int $fromprogramid, int $targetprogramid): stdClass {
        return parent::import_source_data($fromprogramid, $targetprogramid);
    }

    /**
     * The allocations are controlled externally, editing is not supported.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_edit_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        return false;
    }

    /**
     * External database controls archiving.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_archiving_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        return false;
    }

    /**
     * Deletions are allowed for archived allocations only.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_delete_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        return (bool)$allocation->archived;
    }

    /**
     * Render status details in program management UI.
     *
     * @param stdClass $program
     * @param stdClass|null $source
     * @return string
     */
    public static function render_status_details(stdClass $program, ?stdClass $source): string {
        $result = parent::render_status_details($program, $source);

        if ($source) {
            $source = static::decode_datajson($source);
            if (!empty($source->externaldb_programvalue)) {
                $result .= ' (' . get_string('source_externaldb_status_programvalue', 'enrol_programs', format_string($source->externaldb_programvalue)) . ')';
            } else {
                $field = static::get_config_value('localprogramfield', 'idnumber');
                $result .= ' (' . get_string('source_externaldb_status_programfield', 'enrol_programs', format_string($program->$field ?? '')) . ')';
            }
            if (!empty($source->externaldb_archivemissing)) {
                $result .= ' - ' . get_string('source_externaldb_status_archiving', 'enrol_programs');
            }
        }

        return $result;
    }

    /**
     * Synchronise allocations for this source.
     *
     * @param int|null $programid
     * @param int|null $userid
     * @return bool
     */
    public static function fix_allocations(?int $programid, ?int $userid): bool {
        global $DB;

        $config = static::get_external_config();
        if (!$config) {
            return false;
        }

        $params = ['type' => static::get_type(), 'now1' => time(), 'now2' => time()];
        $programselect = '';
        if ($programid) {
            $programselect = 'AND p.id = :programid';
            $params['programid'] = $programid;
        }

        $sql = "SELECT s.*, p.id AS programid, p.idnumber, p.fullname, p.timeallocationstart, p.timeallocationend, p.contextid
                  FROM {enrol_programs_sources} s
                  JOIN {enrol_programs_programs} p ON p.id = s.programid
                 WHERE s.type = :type
                   AND p.archived = 0
                   AND (p.timeallocationstart IS NULL OR p.timeallocationstart <= :now1)
                   AND (p.timeallocationend IS NULL OR p.timeallocationend > :now2)
                   $programselect
              ORDER BY p.id";

        $sources = $DB->get_recordset_sql($sql, $params);
        if (!$sources->valid()) {
            $sources->close();
            return false;
        }

        $extdb = static::db_init($config);
        if (!$extdb) {
            $sources->close();
            return false;
        }

        $updated = false;
        $programcache = [];
        foreach ($sources as $source) {
            if (!isset($programcache[$source->programid])) {
                $programcache[$source->programid] = $DB->get_record(
                    'enrol_programs_programs',
                    ['id' => $source->programid],
                    '*',
                    MUST_EXIST
                );
            }
            $programdata = $programcache[$source->programid];

            $source = static::decode_datajson($source);

            $programvalue = static::resolve_program_value($programdata, $source, $config);
            if ($programvalue === null) {
                continue;
            }

            $conditions = [
                $config->programfield => $programvalue,
            ];

            $targetuserid = null;
            if ($userid) {
                $targetuser = static::get_local_user($userid);
                if (!$targetuser) {
                    continue;
                }
                $useridentifier = static::get_user_identifier_value($targetuser, $config->localuserfield);
                if ($useridentifier === null) {
                    continue;
                }
                $conditions[$config->userfield] = $useridentifier;
                $targetuserid = $userid;
            }

            $remotematches = static::fetch_remote_allocations($extdb, $config, $conditions);
            if ($remotematches === null) {
                // Failed to fetch data, try next source.
                continue;
            }

            $kept = [];
            foreach ($remotematches as $remotevalue) {
                $localuser = static::get_user_by_identifier($remotevalue, $config->localuserfield);
                if (!$localuser) {
                    continue;
                }

                $kept[$localuser->id] = true;

                $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $programdata->id, 'userid' => $localuser->id]);
                $sourcedata = util::json_encode([
                    'remoteuser' => $remotevalue,
                    'programvalue' => $programvalue,
                ]);

                if ($allocation) {
                    if ((int)$allocation->sourceid !== (int)$source->id) {
                        continue;
                    }
                    if ((int)$allocation->archived === 1) {
                        $DB->set_field('enrol_programs_allocations', 'archived', 0, ['id' => $allocation->id]);
                        $updated = true;
                    }
                    if ($allocation->sourcedatajson !== $sourcedata) {
                        $DB->set_field('enrol_programs_allocations', 'sourcedatajson', $sourcedata, ['id' => $allocation->id]);
                    }
                } else {
                    static::allocate_user($programdata, $source, $localuser->id, ['remoteuser' => $remotevalue, 'programvalue' => $programvalue]);
                    $updated = true;
                }
            }

            $allocationparams = ['programid' => $programdata->id, 'sourceid' => $source->id];
            if ($targetuserid) {
                $allocationparams['userid'] = $targetuserid;
            }
            if (!empty($source->externaldb_archivemissing)) {
                $allocs = $DB->get_records('enrol_programs_allocations', $allocationparams, '', 'id, userid, archived');
                foreach ($allocs as $allocation) {
                    if (isset($kept[$allocation->userid])) {
                        continue;
                    }
                    if (!(int)$allocation->archived) {
                        $DB->set_field('enrol_programs_allocations', 'archived', 1, ['id' => $allocation->id]);
                        $updated = true;
                    }
                }
            }
        }
        $sources->close();
        $extdb->Close();

        return $updated;
    }

    /**
     * Fetch allocations from external database.
     *
     * @param \ADOConnection $extdb
     * @param stdClass $config
     * @param array $conditions
     * @return array|null identifiers in UTF-8, null on failure
     */
    protected static function fetch_remote_allocations($extdb, stdClass $config, array $conditions): ?array {
        $sql = static::db_get_sql($config->remotetable, $conditions, [$config->userfield], false, '', $config);
        $rs = $extdb->Execute($sql);
        if (!$rs) {
            return null;
        }
        $result = [];
        while (!$rs->EOF) {
            $fields = array_change_key_case($rs->fields, CASE_LOWER);
            $fields = static::db_decode($fields, $config->dbencoding);
            $value = trim($fields[strtolower($config->userfield)] ?? '');
            if ($value !== '') {
                $result[$value] = $value;
            }
            $rs->MoveNext();
        }
        $rs->Close();
        return array_values($result);
    }

    /**
     * Resolve program identifier value used in remote table.
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $config
     * @return string|null
     */
    protected static function resolve_program_value(stdClass $program, stdClass $source, stdClass $config): ?string {
        if (!empty($source->externaldb_programvalue)) {
            return $source->externaldb_programvalue;
        }
        $field = $config->localprogramfield;
        if (!property_exists($program, $field)) {
            return null;
        }
        $value = trim((string)$program->$field);
        return $value === '' ? null : $value;
    }

    /**
     * Get local user record.
     *
     * @param int $userid
     * @return stdClass|null
     */
    protected static function get_local_user(int $userid): ?stdClass {
        global $DB;
        return $DB->get_record('user', ['id' => $userid, 'deleted' => 0]);
    }

    /**
     * Returns value of specified identifier for local user.
     *
     * @param stdClass $user
     * @param string $field
     * @return string|null
     */
    protected static function get_user_identifier_value(stdClass $user, string $field): ?string {
        global $CFG;

        if (!property_exists($user, $field)) {
            return null;
        }
        $value = trim((string)$user->$field);
        if ($value === '') {
            return null;
        }
        if ($field === 'username' && (int)$user->mnethostid !== (int)$CFG->mnet_localhost_id) {
            return null;
        }
        return $value;
    }

    /**
     * Locate user by identifier value.
     *
     * @param string $value
     * @param string $field
     * @return stdClass|null
     */
    protected static function get_user_by_identifier(string $value, string $field): ?stdClass {
        global $CFG, $DB;

        $value = trim($value);
        if ($value === '') {
            return null;
        }
        $params = [$field => $value, 'deleted' => 0];
        if ($field === 'username') {
            $params['mnethostid'] = $CFG->mnet_localhost_id;
        }
        $record = $DB->get_record('user', $params, '*', IGNORE_MISSING);
        return $record ?: null;
    }

    /**
     * Build list of external configuration values.
     *
     * @return stdClass|null returns null when mandatory config missing
     */
    protected static function get_external_config(): ?stdClass {
        $config = new stdClass();
        $config->dbtype = trim((string)static::get_config_value('dbtype'));
        $config->dbhost = (string)static::get_config_value('dbhost');
        $config->dbuser = (string)static::get_config_value('dbuser');
        $config->dbpass = (string)static::get_config_value('dbpass');
        $config->dbname = (string)static::get_config_value('dbname');
        $config->dbencoding = trim((string)static::get_config_value('dbencoding', 'utf-8'));
        $config->dbsetupsql = (string)static::get_config_value('dbsetupsql');
        $config->dbsybasequoting = (bool)static::get_config_value('dbsybasequoting', 0);
        $config->debugdb = (bool)static::get_config_value('debugdb', 0);
        $config->remotetable = trim((string)static::get_config_value('remotetable'));
        $config->programfield = trim((string)static::get_config_value('programfield'));
        $config->userfield = trim((string)static::get_config_value('userfield'));
        $config->localprogramfield = trim((string)static::get_config_value('localprogramfield', 'idnumber'));
        $config->localuserfield = trim((string)static::get_config_value('localuserfield', 'idnumber'));
        $config->archivemissing = (int)(bool)static::get_config_value('archivemissing', 1);

        if ($config->dbtype === '' || $config->remotetable === '' || $config->programfield === '' || $config->userfield === '') {
            return null;
        }

        return $config;
    }

    /**
     * Helper to read plugin config values.
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    protected static function get_config_value(string $name, $default = null) {
        $value = get_config('enrol_programs', 'source_externaldb_' . $name);
        if ($value === false || $value === null) {
            return $default;
        }
        return $value;
    }

    /**
     * Establish connection to external DB using ADODB.
     *
     * @param stdClass $config
     * @return \ADOConnection|null
     */
    protected static function db_init(stdClass $config) {
        global $CFG;

        require_once($CFG->libdir . '/adodb/adodb.inc.php');

        $extdb = \ADONewConnection($config->dbtype);
        if ($config->debugdb) {
            $extdb->debug = true;
            ob_start();
        }

        $connected = $extdb->Connect($config->dbhost, $config->dbuser, $config->dbpass, $config->dbname, true);
        if (!$connected) {
            return null;
        }
        $extdb->SetFetchMode(ADODB_FETCH_ASSOC);
        if (!empty($config->dbsetupsql)) {
            $extdb->Execute($config->dbsetupsql);
        }
        return $extdb;
    }

    /**
     * Construct SELECT SQL with encoded conditions.
     *
     * @param string $table
     * @param array $conditions
     * @param array $fields
     * @param bool $distinct
     * @param string $sort
     * @param stdClass $config
     * @return string
     */
    protected static function db_get_sql(string $table, array $conditions, array $fields, bool $distinct, string $sort, stdClass $config): string {
        $columns = $fields ? implode(',', $fields) : '*';
        $where = [];
        foreach ($conditions as $key => $value) {
            $encoded = static::db_encode($value, $config->dbencoding);
            $encoded = static::db_addslashes($encoded, $config->dbsybasequoting);
            $where[] = "$key = '$encoded'";
        }
        $where = $where ? 'WHERE ' . implode(' AND ', $where) : '';
        $sort = $sort ? 'ORDER BY ' . $sort : '';
        $distinctsql = $distinct ? 'DISTINCT ' : '';
        return "SELECT $distinctsql$columns FROM $table $where $sort";
    }

    /**
     * Escape values for external DB.
     *
     * @param string $text
     * @param bool $sybase
     * @return string
     */
    protected static function db_addslashes(string $text, bool $sybase): string {
        if ($sybase) {
            $text = str_replace('\\', '\\\\', $text);
            $text = str_replace(["'", '"', "\0"], ["\\'", '\\"', '\\0'], $text);
        } else {
            $text = str_replace("'", "''", $text);
        }
        return $text;
    }

    /**
     * Encode value for remote encoding.
     *
     * @param string $text
     * @param string $encoding
     * @return string
     */
    protected static function db_encode(string $text, string $encoding): string {
        if ($encoding === '' || strtolower($encoding) === 'utf-8') {
            return $text;
        }
        return \core_text::convert($text, 'utf-8', $encoding);
    }

    /**
     * Decode remote values to UTF-8.
     *
     * @param mixed $data
     * @param string $encoding
     * @return mixed
     */
    protected static function db_decode($data, string $encoding) {
        if ($encoding === '' || strtolower($encoding) === 'utf-8') {
            return $data;
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = static::db_decode($value, $encoding);
            }
            return $data;
        }
        return \core_text::convert((string)$data, $encoding, 'utf-8');
    }
}
