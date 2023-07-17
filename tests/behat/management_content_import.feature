@enrol @enrol_programs @openlms
Feature: Import program content

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
  Scenario: Manager may import content from another program
    Given I log in as "manager1"

    # Add courses and sets
    And I am on all programs management page
    And I follow "Program 000"
    And I click on "Content" "link" in the ".nav-tabs" "css_element"
    And I should see "All in any order" in the "Program 000" "table_row"
    And I click on "Append item" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | Courses | Course 1 |
    And I press dialog form button "Append item"
    And I click on "Append item" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | Add new set     | 1            |
      | Full name       | First set    |
      | Completion type | All in order |
    And I press dialog form button "Append item"
    And I should see "All in order" in the "First set" "table_row"
    And I click on "Append item" "link" in the "First set" "table_row"
    And I set the following fields to these values:
      | Courses         | Course 2, Course 3, Course 4 |
      | Add new set     | 1            |
      | Full name       | Second set   |
      | Completion type | At least X   |
      | At least X      | 2            |
    And I press dialog form button "Append item"
    And I should see "At least 2" in the "Second set" "table_row"
    And I click on "Append item" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | Courses         | Course 5         |
      | Add new set     | 1                |
      | Full name       | Third set        |
      | Completion type | All in any order |
    And I press dialog form button "Append item"
    And I should see "All in any order" in the "Third set" "table_row"

    And I am on all programs management page
    And I follow "Program 002"
    And I click on "Content" "link" in the ".nav-tabs" "css_element"
    And I click on "Append item" "link" in the "Program 002" "table_row"
    And I set the following fields to these values:
      | Courses | Course 6 |
    And I press dialog form button "Append item"

    And I am on all programs management page
    And I follow "Program 001"
    And I click on "Content" "link" in the ".nav-tabs" "css_element"

    When I click on "Import program content" "link" in the "Program 001" "table_row"
    And I set the following fields to these values:
     | Import program content | Program 000 |
    And I press dialog form button "Import program content"
    Then I should see "Course 1"
    And I should see "First set"
    And I should see "Second set"

    When I click on "Import program content" "link" in the "Program 001" "table_row"
    And I set the following fields to these values:
      | Import program content | Program 002 |
    And I press dialog form button "Import program content"
    Then I should see "Course 6"
    And I should see "Course 1"
