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

namespace enrol_programs;

use enrol_programs\local\management;
use enrol_programs\local\program;

/**
 * Program management helper test.
 *
 * @package    enrol_programs
 * @copyright  Copyright (c) 2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @covers \enrol_programs\local\management
 */
final class local_management_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    public function test_get_management_url() {
        global $DB;

        $syscontext = \context_system::instance();

        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);
        $category2 = $this->getDataGenerator()->create_category([]);
        $catcontext2 = \context_coursecat::instance($category2->id);

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program();
        $program2 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program3 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program4 = $generator->create_program(['contextid' => $catcontext2->id]);

        $admin = get_admin();
        $guest = guest_user();
        $manager = $this->getDataGenerator()->create_user();
        $managerrole = $DB->get_record('role', ['shortname' => 'manager']);
        role_assign($managerrole->id, $manager->id, $catcontext2->id);

        $viewer = $this->getDataGenerator()->create_user();
        $viewerroleid = $this->getDataGenerator()->create_role();
        assign_capability('enrol/programs:view', CAP_ALLOW, $viewerroleid, $syscontext);
        role_assign($viewerroleid, $viewer->id, $catcontext1->id);

        $this->setUser(null);
        $this->assertNull(management::get_management_url());

        $this->setUser($guest);
        $this->assertNull(management::get_management_url());

        $this->setUser($admin);
        $expected = new \moodle_url('/enrol/programs/management/index.php');
        $this->assertSame((string)$expected, (string)management::get_management_url());

        $this->setUser($manager);
        $expected = new \moodle_url('/enrol/programs/management/index.php', ['contextid' => $catcontext2->id]);
        $this->assertSame((string)$expected, (string)management::get_management_url());

        $this->setUser($viewer);
        $expected = new \moodle_url('/enrol/programs/management/index.php', ['contextid' => $catcontext1->id]);
        $this->assertSame((string)$expected, (string)management::get_management_url());
    }

    public function test_fetch_programs() {
        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);
        $category2 = $this->getDataGenerator()->create_category([]);
        $catcontext2 = \context_coursecat::instance($category2->id);

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus']);
        $program2 = $generator->create_program(['idnumber' => 'pokus']);
        $program3 = $generator->create_program();
        $program4 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program5 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program6 = $generator->create_program(['contextid' => $catcontext2->id]);

        $program3 = program::update_program_general((object)['id' => $program3->id, 'archived' => 1]);
        $program5 = program::update_program_general((object)['id' => $program5->id, 'archived' => 1]);

        $result = management::fetch_programs(null, false, '', 0, 100, 'id ASC');
        $this->assertCount(2, $result);
        $this->assertCount(4, $result['programs']);
        $this->assertSame(4, $result['totalcount']);
        $programs = $result['programs'];
        $this->assertArrayHasKey($program1->id, $programs);
        $this->assertArrayHasKey($program2->id, $programs);
        $this->assertArrayHasKey($program4->id, $programs);
        $this->assertArrayHasKey($program6->id, $programs);

        $result = management::fetch_programs(null, false, 'hokus', 0, 100, 'id ASC');
        $this->assertCount(2, $result);
        $this->assertCount(1, $result['programs']);
        $this->assertSame(1, $result['totalcount']);
        $programs = $result['programs'];
        $this->assertArrayHasKey($program1->id, $programs);

        $result = management::fetch_programs(null, false, 'okus', 0, 100, 'id ASC');
        $this->assertCount(2, $result);
        $this->assertCount(2, $result['programs']);
        $this->assertSame(2, $result['totalcount']);
        $programs = $result['programs'];
        $this->assertArrayHasKey($program1->id, $programs);
        $this->assertArrayHasKey($program2->id, $programs);

        $result = management::fetch_programs(null, true, '', 0, 100, 'id ASC');
        $this->assertCount(2, $result);
        $this->assertCount(2, $result['programs']);
        $this->assertSame(2, $result['totalcount']);
        $programs = $result['programs'];
        $this->assertArrayHasKey($program3->id, $programs);
        $this->assertArrayHasKey($program5->id, $programs);

        $result = management::fetch_programs($catcontext1, false, '', 0, 100, 'id ASC');
        $this->assertCount(2, $result);
        $this->assertCount(1, $result['programs']);
        $this->assertSame(1, $result['totalcount']);
        $programs = $result['programs'];
        $this->assertArrayHasKey($program4->id, $programs);

        $result = management::fetch_programs(null, false, '', 1, 2, 'id ASC');
        $this->assertCount(2, $result);
        $this->assertCount(2, $result['programs']);
        $this->assertSame(4, $result['totalcount']);
        $programs = $result['programs'];
        $this->assertArrayHasKey($program4->id, $programs);
        $this->assertArrayHasKey($program6->id, $programs);

        $result = management::fetch_programs(null, false, '', 3, 1, 'id ASC');
        $this->assertCount(2, $result);
        $this->assertCount(1, $result['programs']);
        $this->assertSame(4, $result['totalcount']);
        $programs = $result['programs'];
        $this->assertArrayHasKey($program6->id, $programs);
    }

    public function test_get_used_contexts_menu() {
        global $DB;

        $syscontext = \context_system::instance();
        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);
        $category2 = $this->getDataGenerator()->create_category([]);
        $catcontext2 = \context_coursecat::instance($category2->id);
        $category3 = $this->getDataGenerator()->create_category([]);
        $catcontext3 = \context_coursecat::instance($category3->id);

        $user = $this->getDataGenerator()->create_user();
        $managerrole = $DB->get_record('role', ['shortname' => 'manager'], '*', MUST_EXIST);
        role_assign($managerrole->id, $user->id, $catcontext1);
        role_assign($managerrole->id, $user->id, $catcontext3);
        // Undo work hackery.
        $userrole = $DB->get_record('role', ['shortname' => 'user'], '*', MUST_EXIST);
        assign_capability('moodle/category:viewcourselist', CAP_ALLOW, $managerrole->id, $syscontext->id);
        $coursecatcache = \cache::make('core', 'coursecat');
        $coursecatcache->purge();

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program();
        $program2 = $generator->create_program();
        $program3 = $generator->create_program();
        $program4 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program5 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program6 = $generator->create_program(['contextid' => $catcontext2->id]);

        $this->setAdminUser();
        $expected = [
            0 => 'All programs (6)',
            $syscontext->id => 'System (3)',
            $catcontext1->id => $category1->name . ' (2)',
            $catcontext2->id => $category2->name . ' (1)',
        ];
        $contexts = management::get_used_contexts_menu($syscontext);
        $this->assertSame($expected, $contexts);

        $expected = [
            0 => 'All programs (6)',
            $syscontext->id => 'System (3)',
            $catcontext1->id => $category1->name . ' (2)',
            $catcontext2->id => $category2->name . ' (1)',
            $catcontext3->id => $category3->name,
        ];
        $contexts = management::get_used_contexts_menu($catcontext3);
        $this->assertSame($expected, $contexts);

        $this->setUser($user);
        $coursecatcache->purge();

        $expected = [
            $catcontext1->id => $category1->name . ' (2)',
        ];
        $contexts = management::get_used_contexts_menu($catcontext1);
        $this->assertSame($expected, $contexts);

        $expected = [
            $catcontext1->id => $category1->name . ' (2)',
            $catcontext3->id => $category3->name,
        ];
        $contexts = management::get_used_contexts_menu($catcontext3);
        $this->assertSame($expected, $contexts);
    }

    public function test_fetch_current_cohorts_menu() {
        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $cohort1 = $this->getDataGenerator()->create_cohort(['name' => 'Cohort A']);
        $cohort2 = $this->getDataGenerator()->create_cohort(['name' => 'Cohort B']);
        $cohort3 = $this->getDataGenerator()->create_cohort(['name' => 'Cohort C']);

        $program1 = $generator->create_program();
        $program2 = $generator->create_program();
        $program3 = $generator->create_program();

        program::update_program_visibility((object)[
            'id' => $program1->id,
            'public' => 0,
            'cohorts' => [$cohort1->id, $cohort2->id]
        ]);
        program::update_program_visibility((object)[
            'id' => $program2->id,
            'public' => 1,
            'cohorts' => [$cohort3->id]
        ]);

        $expected = [
            $cohort1->id => $cohort1->name,
            $cohort2->id => $cohort2->name,
        ];
        $menu = management::fetch_current_cohorts_menu($program1->id);
        $this->assertSame($expected, $menu);

        $menu = management::fetch_current_cohorts_menu($program3->id);
        $this->assertSame([], $menu);
    }

    public function test_setup_index_page() {
        global $PAGE;

        $syscontext = \context_system::instance();

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program();
        $user = $this->getDataGenerator()->create_user();

        $PAGE = new \moodle_page();
        management::setup_index_page(
            new \moodle_url('/enrol/programs/management/index.php'),
            $syscontext,
            0
        );

        $this->setUser($user);
        $PAGE = new \moodle_page();
        management::setup_index_page(
            new \moodle_url('/enrol/programs/management/index.php'),
            $syscontext,
            $syscontext->id
        );
    }

    public function test_setup_program_page() {
        global $PAGE;

        $syscontext = \context_system::instance();

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program();
        $user = $this->getDataGenerator()->create_user();

        $PAGE = new \moodle_page();
        management::setup_program_page(
            new \moodle_url('/enrol/programs/management/new.php'),
            $syscontext,
            $program1
        );

        $this->setUser($user);
        $PAGE = new \moodle_page();
        management::setup_program_page(
            new \moodle_url('/enrol/programs/management/new.php'),
            $syscontext,
            $program1
        );
    }
}
