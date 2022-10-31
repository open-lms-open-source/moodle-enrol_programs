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

namespace enrol_programs\local;

/**
 * Tenant support for programs.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class tenant {
    /**
     * Is this recent OLMS Work code is present?
     *
     * @return bool
     */
    public static function is_available(): bool {
        if (!file_exists(__DIR__ . '/../../../../admin/tool/olms_tenant/version.php')) {
            return false;
        }
        $version = get_config('tool_olms_tenant', 'version');
        if (!$version || $version < 2022102704) {
            return false;
        }
        return true;
    }

    /**
     * Is this recent OLMS Work site with activated tenants?
     *
     * @return bool
     */
    public static function is_active(): bool {
        if (!self::is_available()) {
            return false;
        }
        return \tool_olms_tenant\tenants::is_active();
    }
}
