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

namespace enrol_programs\navmenu;

use enrol_programs\local\navmenu\enrol_programs_catalogue;
use local_navmenu\local\itemtype\set;
use local_navmenu\local\itemtype\root;

/**
 * Advanced primary menu Program catalogue tests.
 *
 * @group      openlms
 * @package    enrol_programs
 * @author     Petr Skoda
 * @copyright  2023 Open LMS (https://www.openlms.net/)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @coversDefaultClass \enrol_programs\local\navmenu\enrol_programs_catalogue
 */
final class enrol_programs_catalogue_test extends \advanced_testcase {
    protected function setUp(): void {
        global $DB;
        parent::setUp();

        if (!get_config('local_navmenu', 'version')) {
            $this->markTestSkipped('local_navmenu not available');
        }

        $this->resetAfterTest();
        $DB->delete_records('local_navmenu_items', []);
    }

    public function test_is_parentable() {
        $this->assertFalse(enrol_programs_catalogue::is_parentable());
    }

    public function test_is_editable() {
        $this->assertTrue(enrol_programs_catalogue::is_editable());
    }

    public function test_get_type_name() {
        $this->assertSame('Program catalogue', enrol_programs_catalogue::get_type_name());
    }

    public function test_create() {
        global $DB;
        $role = $DB->get_record('role', ['shortname' => 'manager'], '*', MUST_EXIST);
        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();

        $home1 = enrol_programs_catalogue::create([]);
        $this->assertInstanceOf('stdClass', $home1);
        $this->assertSame('enrol_programs_catalogue', $home1->itemtype);
        $this->assertSame('', $home1->name);
        $this->assertSame('', $home1->tooltip);
        $this->assertSame(null, $home1->datajson);
        $this->assertSame('0', $home1->parent);
        $this->assertSame('1', $home1->sortorder);
        $this->assertSame('1', $home1->visibility);
        $this->assertSame(null, $home1->tenantid);
        $this->assertSame(null, $home1->roleid);
        $this->assertSame(null, $home1->capability);
        $this->assertSame(null, $home1->contextid);
        $this->assertEquals([], $DB->get_fieldset_select('local_navmenu_cohorts', 'cohortid', 'itemid = ?', [$home1->id]));

        $data = [
            'name' => 'Katalog',
            'tooltip' => 'Nice page',
            'parent' => '0',
            'sortorder' => '1',
            'visibility' => (string)set::VISIBILITY_COHORTS,
            'tenantid' => '-1',
            'roleid' => (string)$role->id,
            'capability' => 'moodle/site:config',
            'contextid' => (string)SYSCONTEXTID,
            'cohorts' => [$cohort1->id, $cohort2->id],
        ];
        $home2 = enrol_programs_catalogue::create($data);
        $home1 = $DB->get_record('local_navmenu_items', ['id' => $home1->id], '*', MUST_EXIST);
        $this->assertInstanceOf('stdClass', $home2);
        $this->assertSame('enrol_programs_catalogue', $home2->itemtype);
        $this->assertSame($data['name'], $home2->name);
        $this->assertSame($data['tooltip'], $home2->tooltip);
        $this->assertSame(null, $home2->datajson);
        $this->assertSame('0', $home2->parent);
        $this->assertSame('1', $home2->sortorder);
        $this->assertSame('2', $home1->sortorder);
        $this->assertSame($data['visibility'], $home2->visibility);
        $this->assertSame(null, $home2->tenantid);
        $this->assertSame($data['roleid'], $home2->roleid);
        $this->assertSame($data['capability'], $home2->capability);
        $this->assertSame($data['contextid'], $home2->contextid);
        $this->assertEquals($data['cohorts'], $DB->get_fieldset_select('local_navmenu_cohorts', 'cohortid', 'itemid = ?', [$home2->id]));

        $set = set::create(['itemtype' => 'set', 'name' => 'Menu 1']);
        $data = [
            'tooltip' => 'Another page',
            'parent' => $set->id,
            'sortorder' => '5',
        ];
        $home3 = enrol_programs_catalogue::create($data);
        $home1 = $DB->get_record('local_navmenu_items', ['id' => $home1->id], '*', MUST_EXIST);
        $home2 = $DB->get_record('local_navmenu_items', ['id' => $home2->id], '*', MUST_EXIST);
        $this->assertInstanceOf('stdClass', $home3);
        $this->assertSame('enrol_programs_catalogue', $home3->itemtype);
        $this->assertSame($data['parent'], $home3->parent);
        $this->assertSame('1', $home3->sortorder);
        $this->assertSame('1', $home2->sortorder);
        $this->assertSame('2', $home1->sortorder);

        $DB->set_field('local_navmenu_items', 'sortorder', -1, []);

        // Automatic reordering.
        $home4 = enrol_programs_catalogue::create([]);
        $home1 = $DB->get_record('local_navmenu_items', ['id' => $home1->id], '*', MUST_EXIST);
        $home2 = $DB->get_record('local_navmenu_items', ['id' => $home2->id], '*', MUST_EXIST);
        $home3 = $DB->get_record('local_navmenu_items', ['id' => $home3->id], '*', MUST_EXIST);
        $set = $DB->get_record('local_navmenu_items', ['id' => $set->id], '*', MUST_EXIST);
        $this->assertSame('1', $home1->sortorder);
        $this->assertSame('2', $home2->sortorder);
        $this->assertSame('3', $set->sortorder);
        $this->assertSame('1', $home3->sortorder);
        $this->assertSame('4', $home4->sortorder);
    }

    public function test_update() {
        global $DB;
        $role1 = $DB->get_record('role', ['shortname' => 'manager'], '*', MUST_EXIST);
        $role2 = $DB->get_record('role', ['shortname' => 'teacher'], '*', MUST_EXIST);
        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();
        $cohort3 = $this->getDataGenerator()->create_cohort();
        $course = $this->getDataGenerator()->create_course();
        $coursecontext = \context_course::instance($course->id);

        $set1 = set::create(['itemtype' => 'set', 'name' => 'Menu 1']);
        $set2 = set::create(['itemtype' => 'set', 'name' => 'Menu 1']);

        $data = [
            'name' => 'Katalog 1',
            'parent' => $set1->id,
            'sortorder' => '1',
            'visibility' => (string)set::VISIBILITY_COHORTS,
            'tenantid' => '1',
            'roleid' => (string)$role1->id,
            'capability' => 'moodle/course:edit',
            'contextid' => (string)$coursecontext->id,
            'cohorts' => [$cohort3->id],
        ];
        $home1 = enrol_programs_catalogue::create($data);

        $data = [
            'id' => $home1->id,
            'name' => 'Katalog 0',
            'tooltip' => 'Nice page',
            'parent' => '0',
            'sortorder' => '1',
            'visibility' => (string)set::VISIBILITY_COHORTS,
            'tenantid' => '-1',
            'roleid' => (string)$role2->id,
            'capability' => 'moodle/site:config',
            'contextid' => (string)SYSCONTEXTID,
            'cohorts' => [$cohort1->id, $cohort2->id],
        ];
        $home1 = enrol_programs_catalogue::update($data);
        $this->assertInstanceOf('stdClass', $home1);
        $this->assertSame('enrol_programs_catalogue', $home1->itemtype);
        $this->assertSame($data['name'], $home1->name);
        $this->assertSame($data['tooltip'], $home1->tooltip);
        $this->assertSame(null, $home1->datajson);
        $this->assertSame('0', $home1->parent);
        $this->assertSame('1', $home1->sortorder);
        $this->assertSame($data['visibility'], $home1->visibility);
        $this->assertSame(null, $home1->tenantid);
        $this->assertSame($data['roleid'], $home1->roleid);
        $this->assertSame($data['capability'], $home1->capability);
        $this->assertSame($data['contextid'], $home1->contextid);
        $this->assertEquals($data['cohorts'], $DB->get_fieldset_select('local_navmenu_cohorts', 'cohortid', 'itemid = ?', [$home1->id]));

        $data = [
            'name' => 'Katalog 2',
            'visibility' => (string)set::VISIBILITY_HIDDEN,
            'parent' => $set1->id,
        ];
        $home2 = enrol_programs_catalogue::create($data);
        $data = [
            'id' => $home2->id,
            'visibility' => (string)set::VISIBILITY_ALL,
            'parent' => '0',
            'sortorder' => '1',
        ];
        $home2 = enrol_programs_catalogue::update($data);
        $home1 = $DB->get_record('local_navmenu_items', ['id' => $home1->id], '*', MUST_EXIST);
        $this->assertSame($data['parent'], $home2->parent);
        $this->assertSame(null,
            $home2->datajson);
        $this->assertSame($data['visibility'], $home2->visibility);
        $this->assertSame($data['sortorder'], $home2->sortorder);
        $this->assertSame('2', $home1->sortorder);
    }

    public function test_delete() {
        global $DB;
        $cohort1 = $this->getDataGenerator()->create_cohort();
        $cohort2 = $this->getDataGenerator()->create_cohort();

        $data = [
            'visibility' => set::VISIBILITY_COHORTS,
            'cohorts' => [$cohort1->id],
        ];
        $home1 = enrol_programs_catalogue::create($data);

        $data = [
            'visibility' => set::VISIBILITY_COHORTS,
            'cohorts' => [$cohort1->id],
        ];
        $home2 = enrol_programs_catalogue::create($data);

        set::delete($home1->id);
        $this->assertFalse($DB->record_exists('local_navmenu_items', ['id' => $home1->id]));
        $this->assertFalse($DB->record_exists('local_navmenu_cohorts', ['itemid' => $home1->id]));

        $home2 = $DB->get_record('local_navmenu_items', ['id' => $home2->id], '*', MUST_EXIST);
        $this->assertTrue($DB->record_exists('local_navmenu_cohorts', ['itemid' => $home2->id, 'cohortid' => $cohort1->id]));
        $this->assertSame('1', $home2->sortorder);
    }

    public function test_is_visible() {
        $record = enrol_programs_catalogue::create([]);
        $user = $this->getDataGenerator()->create_user();
        $admin = get_admin();

        $this->setUser(null);
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertFalse($item->is_visible($root));

        $this->setGuestUser();
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertFalse($item->is_visible($root));

        $this->setUser($user);
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertTrue($item->is_visible($root));

        $this->setUser($admin);
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertTrue($item->is_visible($root));

        $data = ['id' => $record->id, 'visibility' => $item::VISIBILITY_HIDDEN];
        $record = enrol_programs_catalogue::update($data);

        $this->setUser(null);
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertFalse($item->is_visible($root));

        $this->setGuestUser();
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertFalse($item->is_visible($root));

        $this->setUser($user);
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertFalse($item->is_visible($root));

        $this->setUser($admin);
        $root = root::init(false);
        $item = $root->get_children()[0];
        $this->assertFalse($item->is_visible($root));
    }

    public function test_get_name() {
        $data = [
            'name' => 'Katalog 1<span>xx</span>',
        ];
        enrol_programs_catalogue::create($data);
        $root = root::init();
        $item = $root->get_children()[0];

        $this->assertSame($data['name'], $item->name);
        $this->assertSame(format_string($data['name']), $item->get_name());
    }

    public function test_get_tooltip() {
        $data = [
            'tooltip' => 'Some page<span>xx</span>',
        ];
        enrol_programs_catalogue::create($data);
        $root = root::init();
        $item = $root->get_children()[0];

        $this->assertSame($data['tooltip'], $item->tooltip);
        $this->assertSame(format_string($data['tooltip']), $item->get_tooltip());
    }

    public function test_get_url() {
        global $CFG;

        enrol_programs_catalogue::create([]);
        $root = root::init();
        $item = $root->get_children()[0];

        $this->assertSame("$CFG->wwwroot/enrol/programs/catalogue/index.php", $item->get_url());
    }

    public function test_export_for_template() {
        global $PAGE, $CFG, $DB;
        $PAGE->set_url('/test.php');
        $output = new \renderer_base($PAGE, RENDERER_TARGET_CLI);

        $data = [
            'name' => 'Katalog',
            'tooltip' => 'Some page<span>xx</span>',
        ];
        enrol_programs_catalogue::create($data);
        $root = root::init(false);
        $item = $root->get_children()[0];

        $result = $item->export_for_template($output);
        $this->assertSame([
            'text' => format_string($data['name']),
            'url' => "$CFG->wwwroot/enrol/programs/catalogue/index.php",
            'is_action_link' => true,
            'actionattributes' => [['name' => 'title', 'value' => format_string($data['tooltip'])]],
        ], $result);
    }
}
