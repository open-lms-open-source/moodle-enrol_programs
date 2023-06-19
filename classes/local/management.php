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

use moodle_url, stdClass;

/**
 * Program management helper.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class management {
    /**
     * Guess if user can access program management UI.
     *
     * @return moodle_url|null
     */
    public static function get_management_url(): ?moodle_url {
        if (isguestuser() || !isloggedin()) {
            return null;
        }
        if (has_capability('enrol/programs:view', \context_system::instance())) {
            return new moodle_url('/enrol/programs/management/index.php');
        } else {
            // This is not very fast, but we need to let users somehow access program
            // management if they can do so in course category only.
            $categories = \core_course_category::make_categories_list('enrol/programs:view');
            // NOTE: Add some better logic here looking for categories with programs or remember which one was accessed before.
            if ($categories) {
                foreach ($categories as $cid => $unusedname) {
                    $catcontext = \context_coursecat::instance($cid, IGNORE_MISSING);
                    if ($catcontext) {
                        return new moodle_url('/enrol/programs/management/index.php', ['contextid' => $catcontext->id]);
                    }
                }
            }
        }
        return null;
    }

    /**
     * Fetch list of programs.
     *
     * @param \context|null $context null means all contexts
     * @param string $search search string
     * @param int $page
     * @param int $perpage
     * @return array ['programs' => array, 'totalcount' => int]
     */
    public static function fetch_programs(?\context $context, bool $archived, string $search, int $page, int $perpage, string $orderby = 'fullname ASC'): array {
        global $DB;

        list($select, $params) = self::get_search_query($context, $search, '');

        $select .= ' AND archived = :archived';
        $params['archived'] = (int)$archived;

        $programs = $DB->get_records_select('enrol_programs_programs', $select, $params, $orderby, '*', $page * $perpage, $perpage);
        $totalcount = $DB->count_records_select('enrol_programs_programs', $select, $params);

        return ['programs' => $programs, 'totalcount' => $totalcount];
    }

    /**
     * Fetch list contexts with programs that users may access.
     *
     * @param \context $context current management context, added if no program present yet
     * @return array
     */
    public static function get_used_contexts_menu(\context $context): array {
        global $DB;

        $syscontext = \context_system::instance();

        $result = [];

        if (has_capability('enrol/programs:view', $syscontext)) {
            $allcount = $DB->count_records('enrol_programs_programs', []);
            $result[0] = get_string('allprograms', 'enrol_programs') . ' (' . $allcount . ')';

            $syscount = $DB->count_records('enrol_programs_programs', ['contextid' => $syscontext->id]);
            $result[$syscontext->id] = $syscontext->get_context_name() . ' (' . $syscount .')';
        }

        $categories = \core_course_category::make_categories_list('enrol/programs:view');
        if (!$categories) {
            return $result;
        }

        $sql = "SELECT cat.id, COUNT(p.id)
                  FROM {course_categories} cat
                  JOIN {context} ctx ON ctx.instanceid = cat.id AND ctx.contextlevel = 40
                  JOIN {enrol_programs_programs} p ON p.contextid = ctx.id
              GROUP BY cat.id
                HAVING COUNT(p.id) > 0";
        $programcounts = $DB->get_records_sql_menu($sql);

        foreach ($categories as $catid => $categoryname) {
            $catcontext = \context_coursecat::instance($catid, IGNORE_MISSING);
            if (!$catcontext) {
                continue;
            }
            if (!isset($programcounts[$catid])) {
                if ($catcontext->id == $context->id) {
                    $result[$catcontext->id] = $categoryname;
                }
                continue;
            }
            $result[$catcontext->id] = $categoryname . ' (' . $programcounts[$catid] . ')';
        }

        if (!isset($result[$context->id])) {
            $result[$context->id] = $context->get_context_name();
        }

        return $result;
    }

    protected static function get_search_query(?\context $context, string $search, string $tablealias = ''): array {
        global $DB;

        if ($tablealias !== '' && substr($tablealias, -1) !== '.') {
            $tablealias .= '.';
        }

        $conditions = [];
        $params = [];

        if ($context) {
            $conditions[] = $tablealias . 'contextid = :prgcontextid';
            $params['prgcontextid'] = $context->id;
        }

        if (trim($search) !== '') {
            $searchparam = '%' . $DB->sql_like_escape($search) . '%';
            $conditions = [];
            $fields = ['fullname', 'idnumber', 'description'];
            $cnt = 0;
            foreach ($fields as $field) {
                $conditions[] = $DB->sql_like($tablealias . $field, ':prgsearch' . $cnt, false);
                $params['prgsearch' . $cnt] = $searchparam;
                $cnt++;
            }
        }

        if ($conditions) {
            $sql = '(' . implode(' OR ', $conditions) . ')';
            return [$sql, $params];
        } else {
            return ['1=1', $params];
        }
    }

    /**
     * Fetch cohorts that allow program visibility.
     *
     * @param int $programid
     * @return array
     */
    public static function fetch_current_cohorts_menu(int $programid): array {
        global $DB;

        $sql = "SELECT c.id, c.name
                  FROM {cohort} c
                  JOIN {enrol_programs_cohorts} pc ON c.id = pc.cohortid
                 WHERE pc.programid = :programid
              ORDER BY c.name ASC, c.id ASC";
        $params = ['programid' => $programid];

        return $DB->get_records_sql_menu($sql, $params);
    }

    /**
     * Set up $PAGE for program management UI.
     *
     * @param moodle_url $pageurl
     * @param \context $context
     * @param int $contextid
     * @return void
     */
    public static function setup_index_page(\moodle_url $pageurl, \context $context, int $contextid): void {
        global $PAGE, $CFG;

        if (!enrol_is_enabled('programs')) {
            redirect(new moodle_url('/'));
        }

        $syscontext = \context_system::instance();

        if (has_capability('enrol/programs:view', $syscontext) && has_capability('moodle/site:config', $syscontext)) {
            require_once($CFG->libdir . '/adminlib.php');
            admin_externalpage_setup('programsmanagement', '', null, $pageurl, ['pagelayout' => 'admin', 'nosearch' => true]);
            $PAGE->set_heading(get_string('management', 'enrol_programs'));
            $PAGE->set_secondary_navigation(false);
        } else {
            $PAGE->set_pagelayout('admin');
            $PAGE->set_context($context);
            $PAGE->set_url($pageurl);
            $PAGE->set_title(get_string('programs', 'enrol_programs'));
            $PAGE->set_heading(get_string('management', 'enrol_programs'));
            if ($contextid) {
                if (has_capability('enrol/programs:view', $syscontext)) {
                    $url = new moodle_url('/enrol/programs/management/index.php');
                    $PAGE->navbar->add(get_string('management', 'enrol_programs'), $url);
                } else {
                    $PAGE->navbar->add(get_string('management', 'enrol_programs'));
                }
            } else {
                $PAGE->navbar->add(get_string('management', 'enrol_programs'));
            }
        }

        $PAGE->set_docs_path("$CFG->wwwroot/enrol/programs/documentation.php/management.md");
    }

    /**
     * Set up $PAGE for program management UI.
     *
     * @param moodle_url $pageurl
     * @param \context $context
     * @param stdClass $program
     * @return void
     */
    public static function setup_program_page(\moodle_url $pageurl, \context $context, stdClass $program): void {
        global $PAGE, $CFG;

        if (!enrol_is_enabled('programs')) {
            redirect(new moodle_url('/'));
        }

        $syscontext = \context_system::instance();

        if (has_capability('enrol/programs:view', $syscontext) && has_capability('moodle/site:config', $syscontext)) {
            require_once($CFG->libdir . '/adminlib.php');
            admin_externalpage_setup('programsmanagement', '', null, $pageurl, ['pagelayout' => 'admin', 'nosearch' => true]);
            $PAGE->set_heading(format_string($program->fullname));
        } else {
            $PAGE->set_pagelayout('admin');
            $PAGE->set_context($context);
            $PAGE->set_url($pageurl);
            $PAGE->set_title(get_string('programs', 'enrol_programs'));
            $PAGE->set_heading(format_string($program->fullname));
            $url = new moodle_url('/enrol/programs/management/index.php', ['contextid' => $context->id]);
            $PAGE->navbar->add(get_string('management', 'enrol_programs'), $url);
        }
        $PAGE->set_secondary_navigation(false);
        $PAGE->navbar->add(format_string($program->fullname));

        $PAGE->set_docs_path("$CFG->wwwroot/enrol/programs/documentation.php/management.md");
    }
}
