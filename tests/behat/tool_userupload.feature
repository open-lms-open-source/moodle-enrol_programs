@enrol @enrol_programs @openlms @tool @tool_uploaduser
Feature: Program allocation via tool_userupload

  Background:
    Given I skip tests if "local_olms_work" is not installed
    And unnecessary Admin bookmarks block gets deleted
    And the following "categories" exist:
      | name  | category | idnumber |
      | Cat 1 | 0        | CAT1     |
      | Cat 2 | 0        | CAT2     |
      | Cat 3 | 0        | CAT3     |
      | Cat 4 | CAT3     | CAT4     |
    And the following "users" exist:
      | username | firstname | lastname | email                | idnumber |
      | manager1 | Manager   | 1        | manager1@example.com | m1       |
      | manager2 | Manager   | 2        | manager2@example.com | m2       |
      | viewer1  | Viewer    | 1        | viewer1@example.com  | v1       |
      | student1 | Student   | 1        | student1@example.com | s1       |
      | student2 | Student   | 2        | student2@example.com | s2       |
      | student3 | Student   | 3        | student3@example.com | s3       |
      | student4 | Student   | 4        | student4@example.com | s4       |
      | student5 | Student   | 5        | student5@example.com | s5       |
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
      | enrol/programs:manageevidence  | Allow      | pmanager | System       |           |
      | moodle/cohort:view             | Allow      | pmanager | System       |           |
      | moodle/site:uploadusers        | Allow      | pmanager | System       |           |
      | moodle/site:configview         | Allow      | pmanager | System       |           |
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

  @javascript @_file_upload
  Scenario: Manager may allocate programs via tool_uploaduser
    Given I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I am on all programs management page
    And I follow "Program 002"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I navigate to "Users > Accounts > Upload users" in site administration

    When I upload "enrol/programs/tests/fixtures/userupload.csv" file to "File" filemanager
    And I press "Upload users"
    And I set the following fields to these values:
      | Upload type | Update existing users only |
    And I press "Upload users"
    Then I should see "Allocated to 'Program 001'" in the "student1" "table_row"
    And I should see "Allocated to 'Program 002'" in the "student2" "table_row"
    And I should see "Cannot allocate to 'Program 003'" in the "student2" "table_row"
    And I should see "Cannot allocate to 'XX1'" in the "student3" "table_row"
    And I should see "Cannot allocate to '-10'" in the "student3" "table_row"
    And I should see "Allocated to 'Program 001'" in the "student4" "table_row"
    And I should see "Already allocated to 'Program 001'" in the "student4" "table_row"

    And I am on all programs management page
    And I follow "Program 001"
    And I click on "Users" "link" in the "#region-main" "css_element"
    And I should see "Student 1"
    And I should not see "Student 2"
    And I should not see "Student 3"
    And I should see "Student 4"

    And I am on all programs management page
    And I follow "Program 002"
    And I click on "Users" "link" in the "#region-main" "css_element"
    And I should not see "Student 1"
    And I should see "Student 2"

  @javascript @_file_upload
  Scenario: Manager may complete programs via tool_uploaduser
    Given I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I am on all programs management page
    And I follow "Program 002"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I click on "Users" "link" in the "#region-main" "css_element"
    And I press "Allocate users"
    And I set the following fields to these values:
      | Users | Student 2 |
    And I press dialog form button "Allocate users"
    And I navigate to "Users > Accounts > Upload users" in site administration

    When I upload "enrol/programs/tests/fixtures/useruploadcompletion.csv" file to "File" filemanager
    And I press "Upload users"
    And I set the following fields to these values:
      | Upload type | Update existing users only |
    And I press "Upload users"
    Then I should see "Allocated to 'Program 001'" in the "student1" "table_row"
    And I should see "Program completion was updated" in the "student1" "table_row"
    And I should see "Program completion was updated" in the "student2" "table_row"
    And I should see "Allocated to 'Program 001'" in the "student3" "table_row"
    And I should see "Invalid program completion date" in the "student3" "table_row"
    And I should see "Cannot allocate to 'XXX'" in the "student4" "table_row"

    When I am on all programs management page
    And I follow "Program 001"
    And I click on "Users" "link" in the "#region-main" "css_element"
    And I follow "Student 1"
    Then I should see "20 October 2023, 12:00" in the "Completion date:" definition list item

    When I am on all programs management page
    And I follow "Program 002"
    And I click on "Users" "link" in the "#region-main" "css_element"
    And I follow "Student 2"
    Then I should see "21 November 2023, 12:00" in the "Completion date:" definition list item

  @javascript @_file_upload
  Scenario: Set program allocation dates via tool_uploaduser
    Given I log in as "admin"
    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I am on all programs management page
    And I follow "Program 002"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I should see "Active" in the "Manual allocation:" definition list item
    And I click on "Users" "link" in the "#region-main" "css_element"
    When I press "Allocate users"
    And I set the following fields to these values:
      | Users | Student 4 |
    And I press dialog form button "Allocate users"
    And I navigate to "Users > Accounts > Upload users" in site administration

    When I upload "enrol/programs/tests/fixtures/useruploadprogdates.csv" file to "File" filemanager
    And I press "Upload users"
    And I set the following fields to these values:
      | Upload type | Update existing users only |
    And I press "Upload users"
    Then I should see "Allocated to 'Program 001'" in the "student1" "table_row"
    And I am on all programs management page
    And I follow "Program 001"
    And I click on "Users" "link" in the "#region-main" "css_element"
    And I should see "Student 1"
    And I follow "Update allocation"
    And I should see "Program start date" in the "[data-groupname='timestart']" "css_element"
    And I should see "2022" in the "[name='timestart[year]']" "css_element"
    And I should see "November" in the "[name='timestart[month]']" "css_element"
    And I should see "11" in the "[name='timestart[day]']" "css_element"
    And I should see "Program end date" in the "[data-groupname='timeend']" "css_element"
    And I should see "2023" in the "[name='timeend[year]']" "css_element"
    And I should see "January" in the "[name='timeend[month]']" "css_element"
    And I should see "2" in the "[name='timeend[day]']" "css_element"
