@enrol @enrol_programs @openlms
Feature: Import program allocation

  Background:
    Given unnecessary Admin bookmarks block gets deleted
    And the following "categories" exist:
      | name  | category | idnumber |
      | Cat 1 | 0        | CAT1     |
      | Cat 2 | 0        | CAT2     |
      | Cat 3 | CAT2     | CAT3     |
    And the following "courses" exist:
      | fullname | shortname | format | category |
      | Course 1 | C1        | topics | CAT1     |
      | Course 2 | C2        | topics | CAT2     |
      | Course 3 | C3        | topics | CAT3     |
      | Course 4 | C4        | topics | CAT1     |
      | Course 5 | C5        | topics | CAT1     |
      | Course 6 | C6        | topics | CAT1     |
    And the following "cohorts" exist:
      | name     | idnumber |
      | Cohort 1 | CH1      |
      | Cohort 2 | CH2      |
      | Cohort 3 | CH3      |
      | Cohort 4 | CH3      |
      | Cohort 5 | CH3      |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | manager  | Site      | Manager  | manager@example.com  |
      | manager1 | Manager   | 1        | manager1@example.com |
      | manager2 | Manager   | 2        | manager2@example.com |
      | viewer1  | Viewer    | 1        | viewer1@example.com  |
    And the following "roles" exist:
      | name            | shortname |
      | Program viewer  | pviewer   |
      | Program manager | pmanager  |
    And the following "permission overrides" exist:
      | capability                     | permission | role     | contextlevel | reference |
      | enrol/programs:view            | Allow      | pviewer  | System       |           |
      | enrol/programs:view            | Allow      | pmanager | System       |           |
      | enrol/programs:edit            | Allow      | pmanager | System       |           |
      | enrol/programs:delete          | Allow      | pmanager | System       |           |
      | enrol/programs:addcourse       | Allow      | pmanager | System       |           |
      | enrol/programs:allocate        | Allow      | pmanager | System       |           |
      | enrol/programs:clone           | Allow      | pmanager | System       |           |
      | moodle/cohort:view             | Allow      | pmanager | System       |           |
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | manager   | manager       | System       |           |
      | manager1  | pmanager      | System       |           |
      | manager2  | pmanager      | Category     | CAT2      |
      | manager2  | pmanager      | Category     | CAT3      |
      | viewer1   | pviewer       | System       |           |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber | category |
      | Program 000 | PR0      |          |
      | Program 001 | PR1      |          |
      | Program 002 | PR2      | Cat 2    |
      | Program 003 | PR3      | Cat 3    |

  @javascript
  Scenario: Manager may import allocation from another program
    Given I log in as "manager1"

    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Allocation settings"
    When I click on "Update allocations" "link"
    And I set the following fields to these values:
      | timeallocationstart[enabled] | 1    |
      | timeallocationstart[day]     | 5    |
      | timeallocationstart[month]   | 11   |
      | timeallocationstart[year]    | 2020 |
      | timeallocationstart[hour]    | 09   |
      | timeallocationstart[minute]  | 00   |
    And I press dialog form button "Update allocations"
    Then I should see "Thursday, 5 November 2020, 9:00" in the "Allocation start:" definition list item
    And I should see "Not set" in the "Allocation end:" definition list item

    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"
    And I should see "Not set" in the "Allocation start:" definition list item
    And I should see "Not set" in the "Allocation end:" definition list item
    And I click on "Import program allocation" "button"
    And I set the following fields to these values:
      | Import program allocation | Program 000 |
    And I press dialog form button "Select program"
    And I set the following fields to these values:
      | Import program allocation start setting | 1 |
    And I press dialog form button "Import program allocation"
    Then I should see "Thursday, 5 November 2020, 9:00" in the "Allocation start:" definition list item
    And I should see "Not set" in the "Allocation end:" definition list item

    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Allocation settings"
    When I click on "Update scheduling" "link"
    And I set the following fields to these values:
      | Program start             | Delay start after allocation |
      | programstart_delay[value] | 5      |
      | programstart_delay[type]  | months |
    And I press dialog form button "Update scheduling"
    Then I should see "Delay start after allocation - 5 months" in the "Program start:" definition list item
