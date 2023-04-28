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

/**
 * Program generator.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_programs_generator extends component_generator_base {
    /**
     * @var int keeps track of how many programs have been created.
     */
    protected $programcount = 0;

    /**
     * To be called from data reset code only,
     * do not use in tests.
     * @return void
     */
    public function reset() {
        $this->programcount = 0;
        parent::reset();
    }

    /**
     * Create a new program.
     *
     * @param $record
     * @return stdClass program record
     */
    public function create_program($record = null): stdClass {
        global $DB;

        $record = (object)(array)$record;

        $this->programcount++;

        if (!isset($record->fullname)) {
            $record->fullname = 'Program ' . $this->programcount;
        }
        if (!isset($record->idnumber)) {
            $record->idnumber = 'prg' . $this->programcount;
        }
        if (!isset($record->description)) {
            $record->description = '';
        }
        if (!isset($record->descriptionformat)) {
            $record->descriptionformat = FORMAT_HTML;
        }
        if (!isset($record->contextid)) {
            if (!empty($record->category)) {
                $category = $DB->get_record('course_categories', ['name' => $record->category], '*', MUST_EXIST);
                $context = context_coursecat::instance($category->id);
                $record->contextid = $context->id;
            } else {
                $syscontext = \context_system::instance();
                $record->contextid = $syscontext->id;
            }
        }
        unset($record->category);

        $sources = [];
        if (!empty($record->sources)) {
            $sources = $record->sources;
        }
        unset($record->sources);

        $cohorts = empty($record->cohorts) ? [] : $record->cohorts;
        unset($record->cohorts);

        $program = enrol_programs\local\program::add_program($record);

        if ($cohorts) {
            $cohortids = [];
            if (!is_array($cohorts)) {
                $cohorts = explode(',', $cohorts);
            }
            foreach ($cohorts as $cohort) {
                $cohort = trim($cohort);
                if (is_number($cohort)) {
                    $cohortids[] = $cohort;
                } else {
                    $record = $DB->get_record('cohort', ['name' => $cohort], '*', MUST_EXIST);
                    $cohortids[] = $record->id;
                }

            }
            \enrol_programs\local\program::update_program_visibility((object)['id' => $program->id, 'public' => $program->public, 'cohorts' => $cohortids]);
        }

        foreach ($sources as $source => $data) {
            $data['enable'] = 1;
            $data['programid'] = $program->id;
            $data['type'] = $source;
            $data = (object)$data;
            \enrol_programs\local\source\base::update_source($data);
        }

        return $program;
    }

    /**
     * Add program item.
     *
     * @param $record
     * @return \enrol_programs\local\content\item
     */
    public function create_program_item($record): \enrol_programs\local\content\item {
        global $DB;

        $record = (object)(array)$record;

        if (!empty($record->programid)) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $record->programid], '*', MUST_EXIST);
        } else {
            $program = $DB->get_record('enrol_programs_programs', ['fullname' => $record->program], '*', MUST_EXIST);
        }
        $top = \enrol_programs\local\program::load_content($program->id);
        if (!empty($record->parent)) {
            $parentrecord = $DB->get_record('enrol_programs_items', ['programid' => $program->id, 'fullname' => $record->parent], '*', MUST_EXIST);
            $parent = $top->find_item($parentrecord->id);
        } else {
            $parent = $top;
        }

        if (!empty($record->courseid) || !empty($record->course)) {
            if (!empty($record->courseid)) {
                $course = $DB->get_record('course', ['id' => $record->courseid], '*', MUST_EXIST);
            } else {
                $course = $DB->get_record('course', ['fullname' => $record->course], '*', MUST_EXIST);
            }
            return $top->append_course($parent, $course->id);
        } else {
            if (!empty($record->sequencetype)) {
                $types = \enrol_programs\local\content\set::get_sequencetype_types();
                if (isset($types[$record->sequencetype])) {
                    $sequencetype = $record->sequencetype;
                } else {
                    $types = array_flip($types);
                    $sequencetype = $types[$record->sequencetype];
                }
            } else {
                $sequencetype = \enrol_programs\local\content\set::SEQUENCE_TYPE_ALLINANYORDER;
            }
            if (!empty($record->minprerequisites)) {
                $minprerequisites = $record->minprerequisites;
            } else {
                $minprerequisites = 1;
            }
            return $top->append_set($parent, $record->fullname, $sequencetype, $minprerequisites);
        }
    }

    /**
     * Manually allocate user to program.
     *
     * @param $record
     * @return \stdClass allocation record
     */
    public function create_program_allocation($record): stdClass {
        global $DB;

        $record = (object)(array)$record;

        if (!empty($record->programid)) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $record->programid], '*', MUST_EXIST);
        } else {
            $program = $DB->get_record('enrol_programs_programs', ['fullname' => $record->program], '*', MUST_EXIST);
        }

        if (!empty($record->userid)) {
            $user = $DB->get_record('user', ['id' => $record->userid], '*', MUST_EXIST);
        } else {
            $user = $DB->get_record('user', ['username' => $record->user], '*', MUST_EXIST);
        }

        $source = $DB->get_record('enrol_programs_sources', ['type' => 'manual', 'programid' => $program->id]);
        if (!$source) {
            $data = [];
            $data['enable'] = 1;
            $data['programid'] = $program->id;
            $data['type'] = 'manual';
            $data = (object)$data;
            $source = \enrol_programs\local\source\manual::update_source($data);
        }
        \enrol_programs\local\source\manual::allocate_users($program->id, $source->id, [$user->id]);

        return $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $user->id], '*', MUST_EXIST);
    }

    /**
     * Manually allocate user to program.
     *
     * @param $record
     * @return \stdClass allocation record
     */
    public function create_program_notification($record): stdClass {
        global $DB;

        $record = (object)(array)$record;

        if (!empty($record->programid)) {
            $program = $DB->get_record('enrol_programs_programs', ['id' => $record->programid], '*', MUST_EXIST);
        } else {
            $program = $DB->get_record('enrol_programs_programs', ['fullname' => $record->program], '*', MUST_EXIST);
        }

        $alltypes = \enrol_programs\local\notification_manager::get_all_types();
        if (!$record->notificationtype || !isset($alltypes[$record->notificationtype])) {
            throw new coding_exception('Invalid notification type');
        }

        $data = [
            'component' => 'enrol_programs',
            'notificationtype' => $record->notificationtype,
            'instanceid' => $program->id,
            'enabled' => '1',
        ];
        return \local_openlms\notification\util::notification_create($data);
    }
}
