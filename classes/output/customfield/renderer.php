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

namespace enrol_programs\output\customfield;

use renderable;

/**
 * Program custom field renderer.
 *
 * @package    enrol_programs
 * @copyright  2024 Open LMS (https://www.openlms.net/)
 * @author     Farhan Karmali
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {
    public function render_customfields(int $programid): string {

        $content = '';
        $handler = \enrol_programs\customfield\fields_handler::create();
        $datas = $handler->get_instance_data($programid);
        foreach ($datas as $data) {
            $value = $data->get_value();
            if (!empty($value)) {
                $content .= '<dt class="col-3">'.$data->get_field()->get('name').':</dt><dd class="col-9">'.$value.'</dd>';
            }

        }

        return $content;
    }


}
