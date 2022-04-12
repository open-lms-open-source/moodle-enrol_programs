@enrol @enrol_programs @olms
Feature: Program content management tests

  Background:
    Given Unnecessary Admin bookmarks block gets deleted
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
    And the following "users" exist:
      | username | firstname | lastname | email                |
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
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | manager1  | pmanager      | System       |           |
      | manager2  | pmanager      | Category     | CAT2      |
      | manager2  | pmanager      | Category     | CAT3      |
      | viewer1   | pviewer       | System       |           |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber | category |
      | Program 000 | PR0      |          |
      | Program 001 | PR1      | Cat 1    |
      | Program 002 | PR2      | Cat 2    |
      | Program 003 | PR3      | Cat 3    |

  @javascript
  Scenario: Manager may edit program content
    Given I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Content"
    And I should see "All in any order" in the "Program 000" "table_row"

    # Add courses and sets
    When I click on "Append item" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | Courses | Course 1 |
    Then I press dialog form button "Append item"

    When I click on "Append item" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | Add new set     | 1            |
      | Full name       | First set    |
      | Completion type | All in order |
    And I press dialog form button "Append item"
    Then I should see "All in order" in the "First set" "table_row"

    When I click on "Append item" "link" in the "First set" "table_row"
    And I set the following fields to these values:
      | Courses         | Course 2, Course 3, Course 4 |
      | Add new set     | 1            |
      | Full name       | Second set   |
      | Completion type | At least X   |
      | At least X      | 2            |
    And I press dialog form button "Append item"
    Then I should see "At least 2" in the "Second set" "table_row"

    When I click on "Append item" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | Courses         | Course 5         |
      | Add new set     | 1                |
      | Full name       | Third set        |
      | Completion type | All in any order |
    And I press dialog form button "Append item"
    Then I should see "All in any order" in the "Third set" "table_row"

    # Update sets

    When I click on "Update set" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | Completion type | All in order |
    And I press dialog form button "Update"
    Then I should see "All in order" in the "Program 000" "table_row"

    When I click on "Update set" "link" in the "Third set" "table_row"
    And I set the following fields to these values:
      | Full name       | Treti set        |
      | Completion type | All in any order |
    And I press dialog form button "Update set"
    Then I should see "All in any order" in the "Treti set" "table_row"

    When I click on "Update set" "link" in the "Treti set" "table_row"
    And I set the following fields to these values:
      | Full name       | Third set        |
      | Completion type | At least X       |
      | At least X      | 3                |
    And I press dialog form button "Update set"
    Then I should see "At least 3" in the "Third set" "table_row"

    # Move items

    When I click on "Move item" "link" in the "Course 1" "table_row"
    And I press "Cancel moving"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "Course 1" "table_row"
    And I click on "Move \"Course 1\" after \"Third set\"" "link"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "Course 1" "table_row"
    And I click on "Move \"Course 1\" before \"Course 3\"" "link"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "Course 1" "table_row"
    And I click on "Move \"Course 1\" before \"First set\"" "link"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "Course 5" "table_row"
    And I click on "Move \"Course 5\" before \"Course 1\"" "link"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "Course 5" "table_row"
    And I click on "Move \"Course 5\" into \"Third set\"" "link"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "First set" "table_row"
    And I click on "Move \"First set\" before \"Course 1\"" "link"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "First set" "table_row"
    And I click on "Move \"First set\" after \"Course 5\"" "link"
    Then I should see "Actions"

    When I click on "Move item" "link" in the "First set" "table_row"
    And I click on "Move \"First set\" before \"Third set\"" "link"
    Then I should see "Actions"

    # Deleting of items

    When I click on "Remove course" "link" in the "Course 5" "table_row"
    And I press dialog form button "Cancel"
    Then I should see "Course 5"

    When I click on "Remove course" "link" in the "Course 5" "table_row"
    And I press dialog form button "Remove course"
    Then I should not see "Course 5"

    When I click on "Delete set" "link" in the "Third set" "table_row"
    And I press dialog form button "Cancel"
    Then I should see "Third set"

    When I click on "Delete set" "link" in the "Third set" "table_row"
    And I press dialog form button "Delete set"
    Then I should not see "Third set"

    When I click on "Remove course" "link" in the "Course 3" "table_row"
    And I press dialog form button "Remove course"

    When I click on "Remove course" "link" in the "Course 4" "table_row"
    And I press dialog form button "Remove course"

    When I click on "Remove course" "link" in the "Course 1" "table_row"
    And I press dialog form button "Remove course"

    When I click on "Remove course" "link" in the "Course 2" "table_row"
    And I press dialog form button "Remove course"

    When I click on "Delete set" "link" in the "Second set" "table_row"
    And I press dialog form button "Delete set"

    When I click on "Delete set" "link" in the "First set" "table_row"
    And I press dialog form button "Delete set"
