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

namespace enrol_programs\external;

use enrol_programs\local\allocation;
use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_value;
use core_external\external_multiple_structure;
use core_external\external_single_structure;

/**
 * Provides list of user preferences related to the program user interface.
 *
 * @package     enrol_programs
 * @copyright   2025 Open LMS (https://www.openlms.net/)
 * @author      Farhan Karmali
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class get_userprogram_preferences extends external_api {

    /**
     * Describes the external function arguments.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    /**
     * Returns list of user preferences related to the program user interface..
     *
     * @return array
     */
    public static function execute(): array {
        require_login();
        $blockconfig = get_config('enrol_programs', 'programsblocklayout');
        $detailconfig = get_config('enrol_programs', 'programslayout');
        $allowuserlayoutchange = get_config('enrol_programs', 'programslayoutallowuserswitch');
        if ($allowuserlayoutchange) {
            $blockviewpref =  get_user_preferences('enrol_programs_block_user_view_preference') ?? $blockconfig;
            $detailviewpref = get_user_preferences('enrol_programs_detailpage_user_view_preference') ?? $detailconfig;
        } else {
            $blockviewpref = $blockconfig;
            $detailviewpref = $detailconfig;
        }

        return ['blockview' => $blockviewpref, 'detailview' => $detailviewpref];
    }

    /**
     * Describes the external function parameters.
     *
     * @return external_single_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'blockview' => new external_value(PARAM_TEXT, 'Preference for programs block view'),
            'detailview' => new external_value(PARAM_TEXT, 'Preference for programs detail view'),
        ]);
    }
}