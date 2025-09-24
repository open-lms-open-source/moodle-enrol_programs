@enrol @enrol_programs @openlms
Feature: Program completion by managers tests with certify source

  Background:
    Given I skip tests if "tool_certificate" is not installed
    And unnecessary Admin bookmarks block gets deleted
    And the following "categories" exist:
      | name  | category | idnumber |
      | Cat 1 | 0        | CAT1     |
      | Cat 2 | 0        | CAT2     |
      | Cat 3 | CAT2     | CAT3     |
    And the following "courses" exist:
      | fullname | shortname | format | category | enablecompletion | showcompletionconditions |
      | Course 1 | C1        | topics | CAT1     | 1                | 1                        |
      | Course 2 | C2        | topics | CAT2     | 1                | 1                        |
      | Course 3 | C3        | topics | CAT3     | 1                | 1                        |
      | Course 4 | C4        | topics | CAT1     | 1                | 1                        |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | admin1   | Admin     | 1        | admin1@example.com   |
      | manager1 | Manager   | 1        | manager1@example.com |
      | viewer1  | Viewer    | 1        | viewer1@example.com  |
      | student1 | Student   | 1        | student1@example.com |
      | student2 | Student   | 2        | student2@example.com |
      | student3 | Student   | 3        | student3@example.com |
    And the following "roles" exist:
      | name            | shortname |
      | Program viewer  | pviewer   |
      | Program manager | pmanager  |
      | Program admin   | padmin    |
    And the following "permission overrides" exist:
      | capability                       | permission | role     | contextlevel | reference |
      | enrol/programs:view              | Allow      | pviewer  | System       |           |
      | enrol/programs:view              | Allow      | pmanager | System       |           |
      | enrol/programs:edit              | Allow      | pmanager | System       |           |
      | enrol/programs:delete            | Allow      | pmanager | System       |           |
      | enrol/programs:manageevidence    | Allow      | pmanager | System       |           |
      | enrol/programs:view              | Allow      | padmin   | System       |           |
      | enrol/programs:edit              | Allow      | padmin   | System       |           |
      | enrol/programs:delete            | Allow      | padmin   | System       |           |
      | enrol/programs:manageevidence    | Allow      | padmin   | System       |           |
      | enrol/programs:manageallocation  | Allow      | pmanager | System       |           |
      | enrol/programs:archive           | Allow      | pmanager | System       |           |
      | enrol/programs:admin             | Allow      | padmin   | System       |           |
      | tool/certify:view                | Allow      | padmin   | System       |           |
      | tool/certify:assign              | Allow      | padmin   | System       |           |
      | tool/certify:edit                | Allow      | padmin   | System       |           |
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | admin1    | padmin        | System       |           |
      | manager1  | pmanager      | System       |           |
      | viewer1   | pviewer       | System       |           |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber | category | public | sources |
      | Program 000 | PR0      |          | 1      | certify |
    And the following "tool_certify > certifications" exist:
      | fullname          | idnumber | category | program1 | cohorts  | public |
      | Certification 000 | CT0      |          | PR0      |          | 0      |
    And the following "enrol_programs > program_items" exist:
      | program     | parent     | course   | fullname   | sequencetype     | minprerequisites |
      | Program 000 |            |          | First set  | All in order     |                  |
      | Program 000 | First set  | Course 1 |            |                  |                  |
      | Program 000 | First set  | Course 2 |            |                  |                  |
      | Program 000 |            |          | Second set | At least X       | 1                |
      | Program 000 | Second set | Course 3 |            |                  |                  |
      | Program 000 | Second set | Course 4 |            |                  |                  |
    And the following "enrol_programs > program_allocations" exist:
      | program     | user     |
      | Program 000 | student2 |
      | Program 000 | student3 |

  @javascript
  Scenario: Program admin may mark override completion for source certify
    Given I log in as "admin1"
    And I am on all certifications management page
    And I follow "Certification 000"
    And I click on "Assignment settings" "link" in the "#region-main" "css_element"
    And I click on "Update Manual assignment" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I click on "Users" "link" in the "#region-main" "css_element"
    And I press "Assign users"
    And I set the following fields to these values:
      | Users | Student 1 |
    And I press dialog form button "Assign users"
    When I am on all programs management page
    And I follow "Program 000"
    And I follow "Users"
    And I follow "Student 1"
    And I click on "Allocation actions" "link"
    And I click on "Override program completion" "link"
    And I set the following fields to these values:
      | timecompleted[enabled] | 1        |
    And I press dialog form button "Update"
    Then I should see "Completed" in the "Program status:" definition list item
