@enrol @enrol_programs @openlms
Feature: Program allocation calendar events tests

  Background:
    Given unnecessary Admin bookmarks block gets deleted
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | manager1 | Manager   | 1        | manager1@example.com |
      | viewer1  | Viewer    | 1        | viewer1@example.com  |
      | student1 | Student   | 1        | student1@example.com |
      | student2 | Student   | 2        | student2@example.com |
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
      | enrol/programs:admin           | Allow      | pmanager | System       |           |
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | manager1  | pmanager      | System       |           |
      | viewer1   | pviewer       | System       |           |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber | category | public | description               |
      | Program 000 | PR0      |          | 1      | Fancy program description |
    And the following "enrol_programs > program_allocations" exist:
      | program     | user     |
      | Program 000 | student1 |

  @javascript
  Scenario: Student may see program events in calendar
    Given I log in as "student1"

    When I click on "Program 000 starts" "link"
    Then I should see "Fancy program description"

    When I click on "View" "link" in the ".modal-footer" "css_element"
    Then I should see "Program 000"
    And I should see "Fancy program description"
    And I should see "Manual allocation" in the "Source:" definition list item
