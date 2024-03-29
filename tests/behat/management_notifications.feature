@enrol @enrol_programs @openlms
Feature: Program notifications management tests

  Background:
    Given unnecessary Admin bookmarks block gets deleted
    And the following "categories" exist:
      | name  | category | idnumber |
      | Cat 1 | 0        | CAT1     |
      | Cat 2 | 0        | CAT2     |
      | Cat 3 | 0        | CAT3     |
      | Cat 4 | CAT3     | CAT4     |
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
      | student1 | First     | Student  | student1@example.com |
      | student2 | Second    | Student  | student2@example.com |
      | student3 | Third     | Student  | student3@example.com |
    And the following "roles" exist:
      | name            | shortname |
      | Program viewer  | pviewer   |
      | Program manager | pmanager  |
    And the following "permission overrides" exist:
      | capability                     | permission | role     | contextlevel | reference |
      | enrol/programs:view            | Allow      | pviewer  | System       |           |
      | enrol/programs:view            | Allow      | pmanager | System       |           |
      | enrol/programs:edit            | Allow      | pmanager | System       |           |
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | manager1  | pmanager      | System       |           |
      | manager2  | pmanager      | Category     | CAT2      |
      | manager2  | pmanager      | Category     | CAT3      |
      | viewer1   | pviewer       | System       |           |

  @javascript
  Scenario: Manager enables all notifications in a program
    Given I log in as "manager1"
    And I am on all programs management page

    And I press "Add program"
    And I set the following fields to these values:
      | Program name  | Program 001 |
      | ID number     | PR01        |
    And I press dialog form button "Add program"
    And I follow "Notifications"
    When I click on "Add notification" "link"
    And I set the following fields to these values:
      | Enabled                 | 1 |
      | User allocated          | 1 |
      | Program started         | 1 |
      | Program completed       | 1 |
      | Program due date soon   | 1 |
      | Program overdue         | 1 |
      | Program end date soon   | 1 |
      | Completed program ended | 1 |
      | Failed program ended    | 1 |
      | User deallocated        | 1 |
    And I press dialog form button "Add notification"
    Then the following should exist in the "enrol_programs_notifications" table:
      | Notification            | Customised | Enabled |
      | User allocated          | No         | Yes     |
      | Program started         | No         | Yes     |
      | Program completed       | No         | Yes     |
      | Program due date soon   | No         | Yes     |
      | Program overdue         | No         | Yes     |
      | Program end date soon   | No         | Yes     |
      | Completed program ended | No         | Yes     |
      | Failed program ended    | No         | Yes     |
      | User deallocated        | No         | Yes     |

    And I follow "User allocated"
    And I press "Back"
    And I follow "Program started"
    And I press "Back"
    And I follow "Program completed"
    And I press "Back"
    And I follow "Program due date soon"
    And I press "Back"
    And I follow "Program overdue"
    And I press "Back"
    And I follow "Program end date soon"
    And I press "Back"
    And I follow "Completed program ended"
    And I press "Back"
    And I follow "Failed program ended"
    And I press "Back"
    And I follow "User deallocated"
    And I press "Back"
