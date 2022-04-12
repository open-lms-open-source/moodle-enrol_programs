@enrol @enrol_programs @olms
Feature: Manual program allocation tests

  Background:
    Given Unnecessary Admin bookmarks block gets deleted
    And the following "categories" exist:
      | name  | category | idnumber |
      | Cat 1 | 0        | CAT1     |
      | Cat 2 | 0        | CAT2     |
      | Cat 3 | 0        | CAT3     |
      | Cat 4 | CAT3     | CAT4     |
    And the following "cohorts" exist:
      | name     | idnumber |
      | Cohort 1 | CH1      |
      | Cohort 2 | CH2      |
      | Cohort 3 | CH3      |
    And the following "courses" exist:
      | fullname | shortname | format | category |
      | Course 1 | C1        | topics | CAT1     |
      | Course 2 | C2        | topics | CAT2     |
      | Course 3 | C3        | topics | CAT3     |
      | Course 4 | C4        | topics | CAT4     |
      | Course 5 | C5        | topics | CAT4     |
      | Course 6 | C6        | topics | CAT4     |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | manager1 | Manager   | 1        | manager1@example.com |
      | manager2 | Manager   | 2        | manager2@example.com |
      | viewer1  | Viewer    | 1        | viewer1@example.com  |
      | student1 | Student   | 1        | student1@example.com |
      | student2 | Student   | 2        | student2@example.com |
      | student3 | Student   | 3        | student3@example.com |
      | student4 | Student   | 4        | student4@example.com |
      | student5 | Student   | 5        | student5@example.com |
    And the following "cohort members" exist:
      | user     | cohort |
      | student1 | CH1    |
      | student2 | CH1    |
      | student3 | CH1    |
      | student2 | CH2    |
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
      | moodle/cohort:view             | Allow      | pmanager | System       |           |
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
  Scenario: Manager may allocate users manually
    Given I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I should see "Active" in the "Manual allocation:" definition list item
    And I follow "Users"

    When I press "Allocate users"
    And I set the following fields to these values:
      | Users | Student 1, Student 5 |
    And I press dialog form button "Allocate users"
    Then "Student 1" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 5" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And I should not see "Student 2"
    And I should not see "Student 3"
    And I should not see "Student 4"

    When I press "Allocate users"
    And I set the following fields to these values:
      | Cohort | Cohort 2 |
    And I press dialog form button "Allocate users"
    Then "Student 1" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 2" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 5" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And I should not see "Student 3"
    And I should not see "Student 4"

    When I click on "Delete program allocation" "link" in the "Student 2" "table_row"
    And I press dialog form button "Cancel"
    Then "Student 2" row "Source" column of "program_allocations" table should contain "Manual allocation"

    When I click on "Delete program allocation" "link" in the "Student 2" "table_row"
    And I press dialog form button "Delete program allocation"
    Then I should not see "Student 2"
