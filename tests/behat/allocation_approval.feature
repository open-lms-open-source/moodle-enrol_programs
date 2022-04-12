@enrol @enrol_programs @olms
Feature: Program approval allocations tests

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
      | username  | firstname | lastname  | email                 |
      | manager1  | Manager   | 1         | manager1@example.com  |
      | manager2  | Manager   | 2         | manager2@example.com  |
      | viewer1   | Viewer    | 1         | viewer1@example.com   |
      | student1  | Student   | 1         | student1@example.com  |
      | student2  | Student   | 2         | student2@example.com  |
      | student3  | Student   | 3         | student3@example.com  |
      | student4  | Student   | 4         | student4@example.com  |
      | student5  | Student   | 5         | student5@example.com  |
      | allocator | Program   | Allocator | allocator@example.com |
    And the following "cohort members" exist:
      | user     | cohort |
      | student1 | CH1    |
      | student2 | CH1    |
      | student3 | CH1    |
      | student2 | CH2    |
      | student4 | CH2    |
    And the following "roles" exist:
      | name              | shortname |
      | Program viewer    | pviewer   |
      | Program manager   | pmanager  |
      | Program allocator | allocator |
    And the following "permission overrides" exist:
      | capability                     | permission | role      | contextlevel | reference |
      | enrol/programs:view            | Allow      | pviewer   | System       |           |
      | enrol/programs:view            | Allow      | pmanager  | System       |           |
      | enrol/programs:edit            | Allow      | pmanager  | System       |           |
      | enrol/programs:delete          | Allow      | pmanager  | System       |           |
      | enrol/programs:addcourse       | Allow      | pmanager  | System       |           |
      | enrol/programs:allocate        | Allow      | pmanager  | System       |           |
      | moodle/cohort:view             | Allow      | pmanager  | System       |           |
      | enrol/programs:view            | Allow      | allocator | System       |           |
      | enrol/programs:allocate        | Allow      | allocator | System       |           |
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | manager1  | pmanager      | System       |           |
      | manager2  | pmanager      | Category     | CAT2      |
      | manager2  | pmanager      | Category     | CAT3      |
      | viewer1   | pviewer       | System       |           |
      | allocator | allocator     | Category     | CAT1      |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber | category | cohorts  | public |
      | Program 000 | PR0      |          | Cohort 2 |        |
      | Program 001 | PR1      | Cat 1    |          | 1      |
      | Program 002 | PR2      | Cat 2    |          |        |
      | Program 003 | PR3      | Cat 3    |          |        |

  @javascript
  Scenario: Allocator approves student allocation request for a program
    When I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"
    And I click on "Update Requests with approval" "link"
    And I set the following fields to these values:
      | Active             | Yes |
      | Allow new requests | No  |
    And I press dialog form button "Update"
    Then I should see "Active; Requests are not allowed" in the "Requests with approval:" definition list item
    And I log out

    When I log in as "student2"
    And I am on Program catalogue page
    And I follow "Program 001"
    And I should not see "Request access"
    And I log out

    When I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"
    And I click on "Update Requests with approval" "link"
    And I set the following fields to these values:
      | Allow new requests | Yes |
    And I press dialog form button "Update"
    Then I should see "Active; Requests are allowed" in the "Requests with approval:" definition list item
    And I log out

    When I log in as "student2"
    And I am on Program catalogue page
    And I follow "Program 001"
    And I press "Request access"
    And I press dialog form button "Cancel"
    And I press "Request access"
    And I press dialog form button "Request access"
    Then I should see "Access request pending"
    And I log out

    When I log in as "allocator"
    And I am on programs management page in "Cat 1"
    And I follow "Program 001"
    And I follow "Requests"
    And I click on "Approve request" "link" in the "Student 2" "table_row"
    And I press dialog form button "Approve request"
    Then I should not see "Student 2"
    And I follow "Users"
    And "Student 2" row "Source" column of "program_allocations" table should contain "Requests with approval"
    And I log out

    When I log in as "student2"
    And I am on My programs page
    And "Program 001" row "Program status" column of "my_programs" table should contain "Open"
    And I log out

    When I log in as "allocator"
    And I am on programs management page in "Cat 1"
    And I follow "Program 001"
    And I follow "Users"
    And I click on "Delete program allocation" "link" in the "Student 2" "table_row"
    And I press dialog form button "Delete program allocation"
    Then I should not see "Student 2"
    And I log out

    When I log in as "student2"
    And I am on My programs page
    And I should not see "Program 001"
    And I log out

  @javascript
  Scenario: Allocator rejects student allocation request for a program
    Given I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"

    When I click on "Update Requests with approval" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    Then I should see "Active" in the "Requests with approval:" definition list item
    And I log out

    When I log in as "student2"
    And I am on Program catalogue page
    And I follow "Program 001"
    And I press "Request access"
    And I press dialog form button "Request access"
    Then I should see "Access request pending"
    And I log out

    When I log in as "allocator"
    And I am on programs management page in "Cat 1"
    And I follow "Program 001"
    And I follow "Requests"
    And I click on "Reject request" "link" in the "Student 2" "table_row"
    And I set the following fields to these values:
      | Rejection reason | Sorry mate! |
    And I press dialog form button "Reject request"
    Then I should see "Student 2"
    And I follow "Users"
    And I should not see "Student 2"
    And I log out

    When I log in as "student2"
    And I am on Program catalogue page
    And I follow "Program 001"
    Then I should see "Access request was rejected"
    And I log out

    When I log in as "allocator"
    And I am on programs management page in "Cat 1"
    And I follow "Program 001"
    And I follow "Requests"
    And I click on "Delete request" "link" in the "Student 2" "table_row"
    And I press dialog form button "Delete request"
    Then I should not see "Student 2"
    And I log out

    When I log in as "student2"
    And I am on Program catalogue page
    And I follow "Program 001"
    And I press "Request access"
    And I press dialog form button "Request access"
    Then I should see "Access request pending"
    And I log out
