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
 * Program catalogue for learners.
 *
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class catalogue {
    /** @var int page number */
    protected $page = 0;
    /** @var int number of programs per page */
    protected $perpage = 10;
    /** @var ?string search text */
    protected $searchtext = null;

    /**
     * Creates catalogue instance.
     *
     * @param array $request
     */
    public function __construct(array $request) {
        // NOTE: we do not care about CSRF here, because there are no data modifications in Catalogue,
        // we DO want to allow and encourage bookmarking of catalogue URLs.
        if (isset($request['page'])) {
            $page = clean_param($request['page'], PARAM_INT);
            if ($page > 0) {
                $this->page = $page;
            }
        }
        if (isset($request['perpage'])) {
            $perpage = clean_param($request['perpage'], PARAM_INT);
            if ($perpage > 0) {
                $this->perpage = $perpage;
            }
        }
        if (isset($request['searchtext'])) {
            $searchtext = clean_param($request['searchtext'], PARAM_RAW);
            if (\core_text::strlen($searchtext) > 1) {
                $this->searchtext = $searchtext;
            }
        }
    }

    /**
     * Current catalogue URL.
     *
     * @return \moodle_url
     */
    public function get_current_url(): \moodle_url {
        $pageparams = [];
        if ($this->page != 0) {
            $pageparams['page'] = $this->page;
        }
        if ($this->perpage != 10) {
            $pageparams['perpage'] = $this->perpage;
        }
        if ($this->searchtext !== null) {
            $pageparams['searchtext'] = $this->searchtext;
        }
        return new \moodle_url('/enrol/programs/catalogue/index.php', $pageparams);
    }

    /**
     * Are we filtering results?
     *
     * @return bool
     */
    public function is_filtering(): bool {
        if ($this->searchtext !== null) {
            return true;
        }
        return false;
    }

    /**
     * Returns page number.
     *
     * @return int
     */
    public function get_page(): int {
        return $this->page;
    }

    /**
     * Returns number of programs per page.
     *
     * @return int
     */
    public function get_perpage(): int {
        return $this->perpage;
    }

    /**
     * Returns search text.
     *
     * @return string|null
     */
    public function get_searchtext(): ?string {
        return $this->searchtext;
    }

    /**
     * Returns hidden text search params.
     *
     * @return array
     */
    public function get_hidden_search_fields(): array {
        $result = [];
        if ($this->page > 0) {
            $result['page'] = $this->page;
        }
        if ($this->perpage != 10) {
            $result['perpage'] = $this->perpage;
        }
        return $result;
    }

    /**
     * Render program listing.
     *
     * @return string
     */
    public function render_programs(): string {
        global $OUTPUT, $CFG, $DB, $USER, $PAGE;

        $catalogueoutput = $PAGE->get_renderer('enrol_programs', 'catalogue');

        $totalcount = $this->count_programs();
        $programs = $this->get_programs();

        if (!$totalcount && !$this->is_filtering()) {
            return get_string('errornoprograms', 'enrol_programs');
        }

        $programicon = $OUTPUT->pix_icon('program', '', 'enrol_programs');
        $currenturl = $this->get_current_url();

        $result = '';

        $data = [
            'action' => new \moodle_url('/enrol/programs/catalogue/index.php'),
            'inputname' => 'searchtext',
            'searchstring' => get_string('search', 'cohort'),
            'query' => $this->searchtext,
            'hiddenfields' => $this->get_hidden_search_fields(),
            'extraclasses' => 'mb-3'
        ];
        $result .= $OUTPUT->render_from_template('core/search_input', $data);

        if (!$totalcount) {
            $result .= get_string('errornoprograms', 'enrol_programs');
            return $result;
        }

        $result .= $OUTPUT->paging_bar($totalcount, $this->page, $this->perpage, $currenturl);
        $result .= '<div class="programs">';
        $i = 0;
        $count = count($programs);
        foreach ($programs as $program) {
            $allocation = $DB->get_record('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $USER->id, 'archived' => 0]);
            $context = \context::instance_by_id($program->contextid);
            $classes = ['programbox', 'clearfix'];
            if ($i % 2 === 0) {
                $classes[] = 'odd';
            } else {
                $classes[] = 'even';
            }
            if ($i == 0) {
                $classes[] = 'first';
            }
            if ($i == $count - 1) {
                $classes[] = 'last';
            }
            $classes = implode(' ', $classes);
            $fullname = format_string($program->fullname);
            if ($allocation) {
                $url = new \moodle_url('/enrol/programs/my/program.php', ['id' => $program->id]);
            } else {
                $url = new \moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);
            }
            $url = $url->out(true);

            $description = file_rewrite_pluginfile_urls($program->description, 'pluginfile.php', $context->id, 'enrol_programs', 'description', $program->id);
            $description = format_text($description, $program->descriptionformat, ['context' => $context]);

            $tagsdiv = '';
            if ($CFG->usetags) {
                $tags = \core_tag_tag::get_item_tags('enrol_programs', 'program', $program->id);
                if ($tags) {
                    $tagsdiv = $OUTPUT->tag_list($tags, '', 'program-tags');
                }
            }

            $allocationinfo = '';
            if ($allocation) {
                $allocationinfo = allocation::get_completion_status_html($program, $allocation);
            }

            $programimage = '';
            $presentation = (array)json_decode($program->presentationjson);
            if (!empty($presentation['image'])) {
                $imageurl = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                    '/' . $context->id . '/enrol_programs/image/' . $program->id . '/'. $presentation['image'], false);
                $programimage = '<div class="float-right programimage">' . \html_writer::img($imageurl, '') . '</div>';
            }

            $result .= <<<EOT
<div class="$classes" data-programid="$program->id">
  $programimage
  <div class="info">
    <h3 class="programname"><a class="aalink" href="$url">{$programicon}{$fullname}<a/></h3>
  </div>$tagsdiv
  <div class="content">
    <div class="summary">$description</div>
  </div>
  <div class="allocation">$allocationinfo</div>
</div>
EOT;
            $i++;
        }

        $result .= '</div>';
        $result .= $OUTPUT->paging_bar($totalcount, $this->page, $this->perpage, $currenturl);

        return $result;
    }

    /**
     * Returns visible programs.
     *
     * @return array
     */
    public function get_programs(): array {
        global $DB;

        list($sql, $params) = $this->get_programs_sql();
        return $DB->get_records_sql($sql, $params, $this->page * $this->perpage, $this->perpage);
    }

    /**
     * Returns filtered count of programs on all pages.
     *
     * @return int
     */
    public function count_programs(): int {
        global $DB;

        list($sql, $params) = $this->get_programs_sql();

        $sql = util::convert_to_count_sql($sql);

        return $DB->count_records_sql($sql, $params);
    }

    /**
     * Returns SQL to fetch filtered programs.
     *
     * @return array
     */
    protected function get_programs_sql(): array {
        global $DB, $USER;

        $params = ['userid1' => $USER->id, 'userid2' => $USER->id];

        $searchwhere = '';
        if (isset($this->searchtext)) {
            // NOTE: We should add better search similar to get_courses_search().
            $concat = $DB->sql_concat_join("' '", ['p.fullname', 'p.description', 'p.idnumber']);
            $searchwhere = 'AND ' . $DB->sql_like("($concat)", ':searchtext', false, false);
            $params['searchtext'] = '%' . $DB->sql_like_escape($this->searchtext) . '%';
        }

        $tenantjoin = "";
        if (tenant::is_active()) {
            $tenantid = \tool_olms_tenant\tenancy::get_tenant_id();
            if ($tenantid) {
                $tenantjoin = "JOIN {context} pc ON pc.id = p.contextid AND (pc.tenantid IS NULL OR pc.tenantid = :tenantid)";
                $params['tenantid'] = $tenantid;
            }
        }

        $sql = "SELECT p.*
                  FROM {enrol_programs_programs} p
             LEFT JOIN {enrol_programs_allocations} pa ON pa.programid = p.id AND pa.userid = :userid1 AND pa.archived = 0
                  $tenantjoin
                 WHERE p.archived = 0 $searchwhere
                       AND (p.public = 1 OR pa.id IS NOT NULL OR EXISTS (
                            SELECT cm.id
                              FROM {cohort_members} cm
                              JOIN {enrol_programs_cohorts} pc ON pc.cohortid = cm.cohortid
                             WHERE cm.userid = :userid2 AND pc.programid = p.id))
              ORDER BY p.fullname ASC";

        return [$sql, $params];
    }

    /**
     * Is program visible for the user?
     *
     * @param \stdClass $program
     * @param int|null $userid
     */
    public static function is_program_visible(\stdClass $program, ?int $userid = null): bool {
        global $DB, $USER;

        if (!enrol_is_enabled('programs')) {
            return false;
        }

        if ($userid === null) {
            $userid = $USER->id;
        }

        if ($program->archived) {
            return false;
        }

        if (\enrol_programs\local\tenant::is_active()) {
            if ($userid == $USER->id) {
                $tenantid = \tool_olms_tenant\tenancy::get_tenant_id();
            } else {
                $tenantid = \tool_olms_tenant\tenant_users::get_user_tenant_id($userid);
            }
            if ($tenantid) {
                $programcontext = \context::instance_by_id($program->contextid);
                $programtenantid = \tool_olms_tenant\tenants::get_context_tenant_id($programcontext);
                if ($programtenantid && $programtenantid != $tenantid) {
                    return false;
                }
            }
        }

        if ($program->public) {
            return true;
        }
        if ($DB->record_exists('enrol_programs_allocations', ['programid' => $program->id, 'userid' => $userid, 'archived' => 0])) {
            return true;
        }
        $sql = "SELECT 1
                  FROM {enrol_programs_cohorts} c
                  JOIN {cohort_members} cm ON cm.cohortid = c.cohortid AND cm.userid = :userid
                 WHERE c.programid = :programid";
        $params = ['programid' => $program->id, 'userid' => $userid];
        if ($DB->record_exists_sql($sql, $params)) {
            return true;
        }
        return false;
    }

    /**
     * Returns link to Program catalogue.
     *
     * @return ?\moodle_url null of programs disabled or user cannot access catalogue
     */
    public static function get_catalogue_url(): ?\moodle_url {
        if (!enrol_is_enabled('programs')) {
            return null;
        }
        if (!isloggedin()) {
            return null;
        }
        if (!has_capability('enrol/programs:viewcatalogue', \context_system::instance())) {
            return null;
        }
        return new \moodle_url('/enrol/programs/catalogue/index.php');
    }

    /**
     * Returns list of all tags of programs that user may see or is allocated to.
     *
     * NOTE: not used anywhere, this was intended for tag filtering UI
     *
     * @param ?int $userid
     * @return array [tagid => tagname]
     */
    public function get_used_tags(?int $userid = null): array {
        global $USER, $DB, $CFG;

        if (!$CFG->usetags) {
            return [];
        }

        if ($userid === null) {
            $userid = $USER->id;
        }

        $sql = "SELECT DISTINCT t.id, t.name
                  FROM {tag} t
                  JOIN {tag_instance} tt ON tt.itemtype = 'program' AND tt.tagid = t.id AND tt.component = 'enrol_programs'
                  JOIN {enrol_programs_programs} p ON p.id = tt.itemid
             LEFT JOIN {enrol_programs_allocations} pa ON pa.programid = p.id AND pa.userid = :userid1 AND pa.archived = 0
                 WHERE p.archived = 0
                       AND (p.public = 1 OR pa.id IS NOT NULL OR EXISTS (
                            SELECT cm.id
                              FROM {cohort_members} cm
                              JOIN {enrol_programs_cohorts} pc ON pc.cohortid = cm.cohortid
                             WHERE cm.userid = :userid2 AND pc.programid = p.id))
              ORDER BY t.name ASC";
        $params = ['userid1' => $userid, 'userid2' => $userid];

        $menu = $DB->get_records_sql_menu($sql, $params);
        return array_map('format_string', $menu);
    }

    /**
     * Render programs with a tag that current learner can see.
     *
     * NOTE: this is using only program.public flag and cohort visibility + allocated programs
     *
     * @param int $tagid
     * @param bool $exclusive
     * @param int $limitfrom
     * @param int $limitnum
     * @return array ['content' => string, 'totalcount' => int]
     */
    public static function get_tagged_programs(int $tagid, bool $exclusive, int $limitfrom, int $limitnum): array {
        global $DB, $USER, $OUTPUT;

        // NOTE: When learners browse programs we ignore the contexts, programs have a flat structure,
        // then only complication here may be multi-tenancy.

        $sql = "SELECT p.*
                  FROM {enrol_programs_programs} p
                  JOIN {tag_instance} tt ON tt.itemid = p.id AND tt.itemtype = 'program' AND tt.tagid = :tagid AND tt.component = 'enrol_programs'
             LEFT JOIN {enrol_programs_allocations} pa ON pa.programid = p.id AND pa.userid = :userid1 AND pa.archived = 0
                 WHERE p.archived = 0
                       AND (p.public = 1 OR pa.id IS NOT NULL OR EXISTS (
                             SELECT cm.id
                               FROM {cohort_members} cm
                               JOIN {enrol_programs_cohorts} pc ON pc.cohortid = cm.cohortid
                              WHERE cm.userid = :userid2 AND pc.programid = p.id))
              ORDER BY p.fullname";
        $countsql = util::convert_to_count_sql($sql);
        $params = ['tagid' => $tagid, 'userid1' => $USER->id, 'userid2' => $USER->id];

        $totalcount = $DB->count_records_sql($countsql, $params);
        $programs = $DB->get_records_sql($sql, $params, $limitfrom, $limitnum);

        $result = [];
        foreach ($programs as $program) {
            $fullname = format_string($program->fullname);
            $url = new \moodle_url('/enrol/programs/catalogue/program.php', ['id' => $program->id]);
            $icon = $OUTPUT->pix_icon('program', '', 'enrol_programs');
            $result[] = '<div class="program-link">' . $icon . \html_writer::link($url, $fullname) . '</div>';
        }

        return ['content' => implode('', $result), 'totalcount' => $totalcount];
    }
}
