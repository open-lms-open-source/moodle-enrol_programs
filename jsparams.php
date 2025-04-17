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
 * @package    enrol_programs
 * @author     Johnny Tsheke
 * @copyright  2025, inspired from enrol_attributes 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once(__DIR__.'/lib.php');

header('Content-type: application/javascript');

$customfieldrecords = $DB->get_records('user_info_field');
$customfields = array();
foreach ($customfieldrecords as $customfieldrecord) {
    $customfields[$customfieldrecord->shortname] = $customfieldrecord->name;
}

$customfieldsrecs = \availability_profile\condition::get_custom_profile_fields(); // array of stdclass objects
     
$customfields = array_map(function($rec){return(format_string($rec->name)?? format_string($rec->shortname));}, $customfieldsrecs);
$standardfields = \availability_profile\condition::get_standard_profile_fields();
     
$allprofilefields = array_merge($standardfields, $customfields);

$items = [];

$profilefields = explode(',', get_config('enrol_programs', 'profilefields'));

foreach ($profilefields as $profilefield) {
    if (array_key_exists($profilefield, $allprofilefields)) {
        $items[] = array(
                'value' => $profilefield,
                'label' => $allprofilefields[$profilefield]
        );
    }
}

$jsvar = json_encode($items);

$operators = ['isequalto', 'contains', 'doesnotcontain', 'startswith', 'endswith',
        'isempty', 'isnotempty'];
$operators = array_combine($operators, 
                      array_map(fn($param): string => format_string(get_string("op_$param", 'availability_profile')),
                      $operators));

$opitems = [];// comparaison operators
foreach($operators as $op => $label){
    $opitems[] = [
        'value' => $op,
        'label' => $label
    ];
}
$oplist = json_encode($opitems); // operators list

//string item 
$stritems = [];
$stritems['addcondition'] = format_string(get_string('addcondition', 'enrol_programs'));
$stritems['addgroup'] = format_string(get_string('addgroup', 'enrol_programs'));
$stritems['deletecondition'] = format_string(get_string('deletecondition', 'enrol_programs'));
$strlist = json_encode($stritems);
echo <<<EOF
M.enrol_programs = M.enrol_programs || {};
M.enrol_programs.paramList = {$jsvar};
M.enrol_programs.operatorList = {$oplist};
M.str = M.str || {};
M.str['enrol_programs'] = {$strlist};
EOF;

