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

use stdClass;

/**
 * Program allocation for all visible cohort members.
 *
 * @package    enrol_programs
 * @copyright  2025 
 * @author     Johnny Tsheke
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class profile extends base {
    /**
     * Return short type name of source, it is used in database to identify this source.
     *
     * NOTE: this must be unique and ite cannot be changed later
     *
     * @return string
     */
    public static function get_type(): string {
        return 'profile';
    }

    /**
     * Can settings of this source be imported to other program?
     *
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
        global $DB;

        $targetsource = parent::import_source_data($fromprogramid, $targetprogramid);

        $sql = "SELECT fc.*
                  FROM {enrol_programs_src_cohorts} fc
                  JOIN {enrol_programs_sources} fs ON fs.id = fc.sourceid AND fs.programid = :fromprogramid AND fs.type = 'cohort'
             LEFT JOIN {enrol_programs_src_cohorts} tc ON tc.cohortid = fc.cohortid AND tc.sourceid = :targetsourceid
                 WHERE tc.id IS NULL
              ORDER BY fc.id ASC";
        $params = ['fromprogramid' => $fromprogramid, 'targetsourceid' => $targetsource->id];
        $records = $DB->get_records_sql($sql, $params);
        foreach ($records as $record) {
            unset($record->id);
            $record->sourceid = $targetsource->id;
            $DB->insert_record('enrol_programs_src_cohorts', $record);
        }

        return $targetsource;
    }

    /**
     * Render details about this enabled source in a program management ui.
     *
     * @param stdClass $program
     * @param stdClass|null $source
     * @return string
     */
    public static function render_status_details(stdClass $program, ?stdClass $source): string {
        $result = parent::render_status_details($program, $source);

        if ($source) {
            /*$profiles = cohort::fetch_allocation_profiles_menu($source->id);
            \core_collator::asort($profiles);
            if ($profiles) {
                $profiles = array_map('format_string', $profiles);
                $result .= ' (' . implode(', ', $profiles) .')';
            }*/
        }

        return $result;
    }

    /**
     * Is it possible to manually edit user allocation?
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_edit_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        return true;
    }

    /**
     * Is it possible to manually delete user allocation?
     *
     * @param stdClass $program
     * @param stdClass $source
     * @param stdClass $allocation
     * @return bool
     */
    public static function allocation_delete_supported(stdClass $program, stdClass $source, stdClass $allocation): bool {
        if ($allocation->archived) {
            return true;
        }
        return false;
    }

    /**
     * Callback method for source updates.
     *
     * @param stdClass|null $oldsource
     * @param stdClass $data
     * @param stdClass|null $source
     * @return void
     */
    public static function after_update(?stdClass $oldsource, stdClass $data, ?stdClass $source): void {
        global $DB;

        if (!$source) {
            // Just deleted or not enabled at all.
            return;
        }
        return;
        //$oldcohorts = profile::fetch_allocation_profiles_menu($source->id);
        //$sourceid = $DB->get_field('enrol_programs_sources', 'id', ['programid' => $data->programid, 'type' => 'profile']);
        $record = $DB->get_record('enrol_programs_sources', ['programid' => $data->programid, 'type' => 'profile']);
        if($record) {
            $arraysyntax = self::attrsyntax_toarray($record->datajson);
            $arraysql = self::arraysyntax_tosql($arraysyntax);
            $select = 'SELECT DISTINCT u.id FROM {user} u';
            $where = ' WHERE u.id=' . $user_enrolment->userid . ' AND u.deleted=0 AND ';
        }
        //continuer ici
        /*
        $data->cohorts = $data->cohorts ?? [];
        foreach ($data->cohorts as $cid) {
            if (isset($oldcohorts[$cid])) {
                unset($oldcohorts[$cid]);
                continue;
            }
            $record = (object)['sourceid' => $sourceid, 'cohortid' => $cid];
            $DB->insert_record('enrol_programs_src_cohorts', $record);
        }
        foreach ($oldcohorts as $cid => $unused) {
            $DB->delete_records('enrol_programs_src_cohorts', ['sourceid' => $sourceid, 'cohortid' => $cid]);
        }*/
    }

    /**
     * Fetch cohorts that allow program allocation automatically.
     *
     * @param int $sourceid
     * @return array
     */
    public static function fetch_allocation_cohorts_menu(int $sourceid): array {
        global $DB;
        return [];
        $sql = "SELECT c.id, c.name
                  FROM {cohort} c
                  JOIN {enrol_programs_src_cohorts} pc ON c.id = pc.cohortid                                    
                 WHERE pc.sourceid = :sourceid
              ORDER BY c.name ASC, c.id ASC";
        $params = ['sourceid' => $sourceid];

        return $DB->get_records_sql_menu($sql, $params);
    }

    /**
     * Make sure users are allocated properly.
     *
     * This is expected to be called from cron and when
     * program allocation settings are updated.
     *
     * @param int|null $programid
     * @param int|null $userid
     * @return bool true if anything updated
     */
    public static function fix_allocations(?int $programid, ?int $userid): bool {
        global $DB, $CFG;

        $updated = false;
      
        // Allocate all missing users and revert archived allocations.
        $params = [];
        $programselect = '';
        $condselect = '';
        $condwhere = '';
        $params = [];
        if ($programid) { // specific program
            $psrecord = $DB->get_record('enrol_programs_sources', ['programid' => $programid, 'type' => 'profile']);
            
            if($psrecord) {
                $psrecord = self::decode_datajson($psrecord);
                $arraysyntax = self::attrsyntax_toarray($psrecord->datajson); 
                $arraysql = self::arraysyntax_tosql($arraysyntax);
                $condselect = $arraysql['select'] ?? '';
                $condwhere = trim($arraysql['where']) ? ' AND '.$arraysql['where'] : '' ;
                $params = array_merge($params, $arraysql['params']) ;
            }
              
            $programselect = ' AND ( p.id = :programid )';
            $params['programid'] = $programid;
        } else { // if no program specified, fix allocation for all programs not archived

          $rsps = $DB->get_recordset('enrol_programs_sources', ['type' => 'profile']);
        
          foreach ($rsps as $srecord) {
                 if (self::fix_allocations($srecord->programid, $userid)) {
                    $updated = true;   
                 }
          }
          $rsps->close();
          return ($updated);
        }
        $userselect = '';
        if ($userid) {
            // $condwhere = " AND (u.id = :userid) $condwhere";
            $userselect = ' AND ( u.id = :userid )';
            $params['userid'] = $userid;
        }
        $now = time();
        $params['now1'] = $now;
        $params['now2'] = $now;
        
        $sql = "SELECT DISTINCT p.id programid, u.id userid, s.id AS sourceid, pa.id AS allocationid, pa.archived allocationarchived 
                  FROM {user} u
                      $condselect
                  JOIN {enrol_programs_sources} s ON s.type = 'profile'
                  JOIN {enrol_programs_programs} p ON p.id = s.programid
             LEFT JOIN {enrol_programs_allocations} pa ON pa.programid = p.id AND pa.userid = u.id
                 WHERE (pa.id IS NULL OR (pa.archived = 1 AND pa.sourceid = s.id))
                       AND (p.archived = 0)
                       AND (p.timeallocationstart IS NULL OR p.timeallocationstart <= :now1)
                       AND (p.timeallocationend IS NULL OR p.timeallocationend > :now2)
                       $condwhere
                       $programselect $userselect
              ORDER BY  p.id ASC, u.id ASC, s.id ASC";
      
        $rs = $DB->get_recordset_sql($sql, $params);
        $lastprogram = null;
        $lastsource = null;
        $program = null;
        $source = null;
        
        foreach ($rs as $record) {
            
            if ($record->allocationid) {
                if ($record->allocationarchived !== 0 ){
                    $DB->set_field('enrol_programs_allocations', 'archived', 0, ['id' => $record->allocationid]);
                }
                
            } else {
                if ($lastprogram && $lastprogram->id == $record->programid) {
                    $program = $lastprogram;
                } else {
                    $program = $DB->get_record('enrol_programs_programs', ['id' => $record->programid], '*', MUST_EXIST);
                    $lastprogram = $program;
                }
                if ($lastsource && $lastsource->id == $record->sourceid) {
                    $source = $lastsource;
                } else {
                    $source = $DB->get_record('enrol_programs_sources', ['id' => $record->sourceid], '*', MUST_EXIST);
                    $lastsource = $source;
                }
                self::allocate_user($program, $source, $record->userid, []);
                $updated = true;
            }
        }
        $rs->close();
        
        // Archive allocations if user not member.
        //$params = [];
        $programselect = '';
        if ($programid) {
            $programselect = 'AND p.id = :programid';
            $params['programid'] = $programid;
        }
        $userselect = '';
        if ($userid) {
            $userselect = ' AND pa.userid = :userid';
            $params['userid'] = $userid;
        }
        $now = time();
        $params['now1'] = $now;
        $params['now2'] = $now;
        
      $sql = "SELECT pa.id as allocationid, pa.userid as allocationuserid
      FROM {enrol_programs_allocations} pa
      JOIN {enrol_programs_programs} p ON p.id = pa.programid
      JOIN {enrol_programs_sources} s ON s.programid = pa.programid AND s.type = 'profile' AND s.id = pa.sourceid
      WHERE (p.archived = 0) AND (pa.archived = 0)
            AND NOT EXISTS (
                SELECT 1
                   FROM {user} u
                        $condselect
                   WHERE (u.id = pa.userid)
                   $condwhere 
            ) 
            AND (p.timeallocationstart IS NULL OR p.timeallocationstart <= :now1)
            AND (p.timeallocationend IS NULL OR p.timeallocationend > :now2)
            $programselect $userselect
      ORDER BY pa.id ASC";
        
        $rspa = $DB->get_recordset_sql($sql, $params);
        foreach ($rspa as $pa) {
            // NOTE: it is expected that enrolment fixing is executed right after this method.
            $DB->set_field('enrol_programs_allocations', 'archived', 1, ['id' => $pa->allocationid]);
            $updated = true;
        }
        $rspa->close();

        return $updated;
    }

    /**
     * Decode extra source settings.
     *
     * @param stdClass $source
     * @return stdClass
     */
    public static function decode_datajson(stdClass $source): stdClass {
        if(is_object($source) and property_exists($source,'datajson')) {
            $source->datajson = json_decode($source->datajson, true, 512, JSON_THROW_ON_ERROR);
        }
        return $source;
    }

    /**
     * Encode extra source settings.
     * @param stdClass $formdata
     * @return string
     */
    public static function encode_datajson(stdClass $formdata): string {
        
        if(is_object($formdata) and property_exists($formdata,'datajson')){    
            return json_encode($formdata->datajson, JSON_THROW_ON_ERROR);

        }
        return \enrol_programs\local\util::json_encode([]);
    }

   /**
    * inspired from enrol_attributes
    * return an array
    */

    public static function attrsyntax_toarray($attrsyntax) { // TODO : protected
        global $DB;
       
        $attrsyntax_object = $attrsyntax ?? json_decode('{}');
        $returnval = [];
        $rules = []; 
        if(is_string($attrsyntax)) { 
            $attrsyntax_object = json_decode($attrsyntax);
            
        }
        
        $rules = $attrsyntax_object->rules ?? [];
        
        $standardfields = \availability_profile\condition::get_standard_profile_fields();
        $customuserfields = [];
        foreach ($DB->get_records('user_info_field') as $customfieldrecord) {
           // $customuserfields[$customfieldrecord->id] = $customfieldrecord->shortname;
           $customuserfields[$customfieldrecord->shortname] = $customfieldrecord->id;
        }

        $returnval['rules'] = $rules; 
        $returnval['customuserfields'] = $customuserfields;
        $returnval['standardfields'] = $standardfields;
        
        return ($returnval); 
    }

    /*
    * initial version from enrol_attributes
    * @param arraysyntax an array containing kys: 
    *    'customuserfields', 'standardfields' and 'rules'
    * return an array
    */

    public static function arraysyntax_tosql($arraysyntax, &$join_id = 0) {
        global $DB;
        $select = '';
        $where = '1=1';
        $params = [];
        $customuserfields = $arraysyntax['customuserfields'];
        $standardfields = $arraysyntax['standardfields'];
        foreach ($arraysyntax['rules'] as $rule) {
            if (isset($rule->cond_op)) {
                $where .= ' ' . strtoupper($rule->cond_op) . ' ';
            }
            else {
                $where .= ' AND ';
            }
            // first just check if we have a value 'ANY' to enroll all people :
            if (isset($rule->value) && $rule->value === 'ANY') {
                $where .= '1=1';
                continue;
            }
            if (isset($rule->rules)) {
                $sub_arraysyntax = array(
                        'customuserfields' => $customuserfields,
                        'standardfields' => $standardfields,
                        'rules'            => $rule->rules
                );
                $sub_sql = self::arraysyntax_tosql($sub_arraysyntax, $join_id);
                $select .= ' ' . $sub_sql['select'] . ' ';
                $where .= ' ( ' . $sub_sql['where'] . ' ) ';
                $params = array_merge($params, $sub_sql['params']);
            } elseif ($customkey = array_search($rule->param, array_flip($customuserfields), true)) {
                // custom user field actually exists
                $join_id++;
                $data = 'd' . $join_id . '.data';
                $select .= ' INNER JOIN {user_info_data} d' . $join_id . ' ON d' . $join_id . '.userid = u.id AND d' . $join_id . '.fieldid = ' . $customkey;

                if (isset($rule->comp_op) && $rule->comp_op === 'contains') {
                    $where .= ' (' . $DB->sql_like($DB->sql_compare_text($data), ':contains'.$join_id.'0') . ')';
                    $params['contains'.$join_id.'0'] = '%' . $rule->value . '%';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'doesnotcontain') {
                    $where .= ' (' . $DB->sql_compare_text($data) . ' NOT lIKE ' . $DB->sql_compare_text(':doesnotcontain'.$join_id.'0') . ')';
                    $params['doesnotcontain'.$join_id.'0'] = '%' . $rule->value . '%';
                }elseif (isset($rule->comp_op) && $rule->comp_op === 'isequalto') {
                    $where .= ' (' . $DB->sql_compare_text($data) . ' = ' . $DB->sql_compare_text(':isequalto'.$join_id.'0') . ')';
                    $params['isequalto'.$join_id.'0'] = '' . $rule->value . '';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'startswith') {
                    $where .= ' (' . $DB->sql_like( $DB->sql_compare_text($data), ':startswith'.$join_id.'0' ) . ')';
                    $params['startswith'.$join_id.'0'] = $rule->value . '%';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'endswith') {
                    $where .= ' (' . $DB->sql_like( $DB->sql_compare_text($data), ':endswith'.$join_id.'0' ) . ')';
                    $params['endswith'.$join_id.'0'] = '%' . $rule->value . '';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'isempty') {
                    $where .= ' (' . 'TRIM( COALESCE('. $DB->sql_compare_text($data). ', :isempty'.$join_id.'0'.') )' . ' = '. ' :isempty'.$join_id.'1'.' )';
                    $params['isempty'.$join_id.'0'] = $DB->sql_like_escape('');
                    $params['isempty'.$join_id.'1'] = $DB->sql_like_escape('');
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'isnotempty') {
                    $where .= ' (' . 'NOT TRIM( COALESCE('. $DB->sql_compare_text($data). ', :isnotempty'.$join_id.'0'.') )' . ' = '. ' :isnotempty'.$join_id.'1'.' )';
                    $params['isnotempty'.$join_id.'0'] =  $DB->sql_like_escape('');
                    $params['isnotempty'.$join_id.'1'] =  $DB->sql_like_escape('');
                } elseif (isset($rule->comp_op) && $rule->comp_op !== 'listitem') {
                        $where .= ' (' . $DB->sql_compare_text($data) . ' ' . strtoupper($rule->comp_op) . ' ' . $DB->sql_compare_text(':listitem'.$join_id.'0') . ')';
                        $params['listitem'.$join_id.'0'] = $rule->value;
                    
                } else {
                    $where .= ' (' . $DB->sql_compare_text($data) . ' = ' . $DB->sql_compare_text(
                            ':other'.$join_id.'0'
                        ) . ' OR ' . $DB->sql_like(
                            $DB->sql_compare_text($data),
                            ':other'.$join_id.'1'
                        ) . ' OR ' . $DB->sql_like(
                            $DB->sql_compare_text($data),
                            ':other'.$join_id.'2'
                        ) . ' OR ' . $DB->sql_like(
                            $DB->sql_compare_text($data),
                            ':other'.$join_id.'3')
                        . ')';
                    
                    $params['other'.$join_id.'0'] = $rule->value;
                    $params['other'.$join_id.'1'] = '%' . $rule->value;
                    $params['other'.$join_id.'2'] = $rule->value . '%';
                    $params['other'.$join_id.'3'] = '%' . $rule->value . '%';
                    
                }
            } elseif ($standardfield = array_search($rule->param, array_combine(array_keys($standardfields), array_keys($standardfields)), true)) {
                // standard field actually exists
                $join_id++;
                $data = 'u.' . $standardfield . ''; // user tables field
                if (isset($rule->comp_op) && $rule->comp_op === 'contains') {
                    $where .= ' (' . $DB->sql_like($DB->sql_compare_text($data), ':contains'.$join_id.'0') . ')';
                    $params['contains'.$join_id.'0'] = '%' . $rule->value . '%';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'doesnotcontain') {
                    $where .= ' (' . $DB->sql_compare_text($data) . ' NOT lIKE ' . $DB->sql_compare_text(':doesnotcontain'.$join_id.'0') . ')';
                    $params['doesnotcontain'.$join_id.'0'] = '%' . $rule->value . '%';
                }elseif (isset($rule->comp_op) && $rule->comp_op === 'isequalto') {
                    $where .= ' (' . $DB->sql_compare_text($data) . ' = ' . $DB->sql_compare_text(':isequalto'.$join_id.'0') . ' )';
                    $params['isequalto'.$join_id.'0'] = '' . $rule->value . '';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'startswith') {
                    $where .= ' (' . $DB->sql_like( $DB->sql_compare_text($data), ':startswith'.$join_id.'0' ) . ')';
                    $params['startswith'.$join_id.'0'] = $rule->value . '%';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'endswith') {
                    $where .= ' (' . $DB->sql_like( $DB->sql_compare_text($data), ':endswith'.$join_id.'0' ) . ')';
                    $params['endswith'.$join_id.'0'] = '%' . $rule->value . '';
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'isempty') {
                    $where .= ' (' . 'TRIM( COALESCE('. $DB->sql_compare_text($data). ', :isempty'.$join_id.'0'.') )' . ' = '. ' :isempty'.$join_id.'1'.' )';
                    $params['isempty'.$join_id.'0'] = $DB->sql_like_escape('');
                    $params['isempty'.$join_id.'1'] = $DB->sql_like_escape('');
                } elseif (isset($rule->comp_op) && $rule->comp_op === 'isnotempty') {
                    $where .= ' (' . 'NOT TRIM( COALESCE('. $DB->sql_compare_text($data). ', :isnotempty'.$join_id.'0'.') )' . ' = '. ' :isnotempty'.$join_id.'0'.')';
                    $params['isnotempty'.$join_id.'0'] = $DB->sql_like_escape('');
                    $params['isnotempty'.$join_id.'1'] = $DB->sql_like_escape('');
                }

            }
        }
        $where = preg_replace('/^1=1 AND ?/', '', $where);
        $where = preg_replace('/^1=1 OR/', '', $where);
        $where = preg_replace('/^1=1/', '', $where);

        if($where === '') {
            // Must be FALSE in any database without causing syntax error
            $where = '1=0';
        } else {
            $where = " ( $where ) ";
        }

        return array(
                'select' => $select,
                'where'  => $where,
                'params' => $params
        );
    }
}
