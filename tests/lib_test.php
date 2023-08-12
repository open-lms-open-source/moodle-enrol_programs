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

use enrol_programs\local\source\manual;
use enrol_programs\local\calendar;

/**
 * Program lib.php tests.
 *
 * @group      openlms
 * @package    enrol_programs
 * @copyright  2022 Open LMS (https://www.openlms.net/)
 * @author     Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class lib_test extends \advanced_testcase {
    public function setUp(): void {
        $this->resetAfterTest();
    }

    /**
     * @return void
     *
     * @covers \enrol_programs_pre_course_category_delete()
     */
    public function test_enrol_programs_pre_course_category_delete() {
        global $DB;

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $category1 = $this->getDataGenerator()->create_category([]);
        $catcontext1 = \context_coursecat::instance($category1->id);
        $category2 = $this->getDataGenerator()->create_category(['parent' => $category1->id]);
        $catcontext2 = \context_coursecat::instance($category2->id);
        $this->assertSame($category1->id, $category2->parent);

        $program1 = $generator->create_program(['contextid' => $catcontext1->id]);
        $program2 = $generator->create_program(['contextid' => $catcontext2->id]);

        $this->assertSame((string)$catcontext1->id, $program1->contextid);
        $this->assertSame((string)$catcontext2->id, $program2->contextid);

        $category2->delete_full(false);
        $program2 = $DB->get_record('enrol_programs_programs', ['id' => $program2->id], '*', MUST_EXIST);
        $this->assertSame((string)$catcontext1->id, $program2->contextid);
    }

    public function test_enrol_programs_core_calendar_provide_event_action() {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/enrol/programs/lib.php');

        /** @var \enrol_programs_generator $generator */
        $generator = $this->getDataGenerator()->get_plugin_generator('enrol_programs');

        $program1 = $generator->create_program(['fullname' => 'hokus', 'sources' => ['manual' => []]]);
        $source1 = $DB->get_record('enrol_programs_sources', ['programid' => $program1->id, 'type' => 'manual'], '*', MUST_EXIST);

        $user1 = $this->getDataGenerator()->create_user();
        manual::allocate_users($program1->id, $source1->id, [$user1->id]);
        $allocation1 = $DB->get_record('enrol_programs_allocations', ['programid' => $program1->id, 'userid' => $user1->id], '*', MUST_EXIST);

        $event = $DB->get_record('event', ['component' => 'enrol_programs', 'instance' => $allocation1->id], '*', MUST_EXIST);
        $this->assertSame(calendar::EVENTTYPE_START, $event->eventtype);

        $this->setUser($user1);
        $calendarevent = \calendar_event::load($event);
        $calendarevent->instance = '0'; // Replicate core bug where instance is missing.
        $factory = new \core_calendar\action_factory();

        $result = enrol_programs_core_calendar_provide_event_action($calendarevent, $factory);
        $this->assertInstanceOf('core_calendar\local\event\value_objects\action', $result);
        $this->assertSame('View', $result->get_name());
        $this->assertSame("$CFG->wwwroot/enrol/programs/my/program.php?id=" . $program1->id, $result->get_url()->out());
        $this->assertSame(1, $result->get_item_count());
    }
}
