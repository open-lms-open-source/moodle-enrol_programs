@enrol @enrol_programs @openlms @_file_upload
Feature: Users can view a list of programs where they are allocated

  Background:
    Given the following "categories" exist:
      | name       | category | idnumber |
      | Category 2 | 0        | CAT2     |
      | Category 3 | 0        | CAT3     |
    And the following "courses" exist:
      | fullname  | shortname  | category |
      | Course 01 | C01        | CAT2     |
      | Course 02 | C02        | CAT2     |
      | Course 03 | C03        | CAT3     |
      | Course 04 | C04        | CAT3     |
      | Course 05 | C05        | CAT3     |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | manager1 | Manager   | 1        | manager1@example.com |
      | student1 | Student   | 1        | student1@example.com |
      | student2 | Student   | 2        | student2@example.com |
    And the following "roles" exist:
      | name            | shortname |
      | Program manager | pmanager  |
    And the following "permission overrides" exist:
      | capability                     | permission | role     | contextlevel | reference |
      | enrol/programs:view            | Allow      | pmanager | System       |           |
      | enrol/programs:upload          | Allow      | pmanager | System       |           |
      | enrol/programs:edit            | Allow      | pmanager | System       |           |
      | enrol/programs:allocate        | Allow      | pmanager | System       |           |
      | enrol/programs:manageallocation | Allow      | pmanager | System      |           |
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | manager1  | pmanager      | System       |           |

    # Upload program from fixtures files.
    Given I log in as "manager1"
    And I am on all programs management page
    When I click on "Programs actions" "link"
    And I click on "Upload programs" "link"
    And I upload "enrol/programs/tests/fixtures/upload/programs_json.zip" file to "Files" filemanager
    And I press "Continue"
    And I press "Upload programs"
    And I follow "Program 00"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I follow "Users"
    When I click on "Users actions" "link"
    And I click on "Allocate users" "link"
    And I set the following fields to these values:
      | Users | Student 1 |
    And I press dialog form button "Allocate users"
    And I log out
#
  @javascript
  Scenario: Allocated users can see program content in table and grid layouts
    And I log in as "student1"
    And I am on My programs page
    And ".generaltable" "css_element" should exist
    And ".programs-grid" "css_element" should not exist
    And ".my-programs-filters" "css_element" should exist
    And I should see "Program name"
    And I should see "ID number"
    And I should see "Description"
    And I should see "Program start"
    And I should see "Due date"
    And I should see "Program end"
    And I should see "Source"
    And I should see "Program status"
    And I should see "Program 00"
    And I should see "Manual allocation"
    And I should see "Test program"
    And I should see "P00"
    Given I log in as "admin"
    And I navigate to "Programs > Program settings" in site administration
    And I set the following fields to these values:
      | Programs detailed page layout | Grid layout |
    And I press "Save changes"
    And I log in as "student1"
    And I am on My programs page
    And ".my-programs-filters" "css_element" should exist
    And ".programs-grid" "css_element" should exist
    And ".generaltable" "css_element" should not exist
    And I should see "ID #"
    And I should see "Program start"
    And I should see "Program due"
    And I should see "Program end"
    And I should see "Source"
    And I should see "Status"
    And I should see "Program 00"
    And I should see "Manual allocation"
    And I should see "Test program"
    And I should see "P00"
