@enrol @enrol_programs @openlms
Feature: Manual program allocation tests

  Background:
    Given unnecessary Admin bookmarks block gets deleted
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
      | username | firstname | lastname | email                | idnumber |
      | manager  | Site      | Manager  | manager@example.com  | m        |
      | manager1 | Manager   | 1        | manager1@example.com | m1       |
      | manager2 | Manager   | 2        | manager2@example.com | m2       |
      | viewer1  | Viewer    | 1        | viewer1@example.com  | v1       |
      | student1 | Student   | 1        | student1@example.com | s1       |
      | student2 | Student   | 2        | student2@example.com | s2       |
      | student3 | Student   | 3        | student3@example.com | s3       |
      | student4 | Student   | 4        | student4@example.com | s4       |
      | student5 | Student   | 5        | student5@example.com | s5       |
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
      | manager   | manager       | System       |           |
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

  @javascript @tool_olms_tenant
  Scenario: Tenant manager may allocate users manually
    Given tenant support was activated
    And the following "tool_olms_tenant > tenants" exist:
      | name     | idnumber | category |
      | Tenant 1 | TEN1     | CAT1     |
      | Tenant 2 | TEN2     | CAT2     |
    And the following "users" exist:
      | username | firstname | lastname | email                | tenant   |
      | tu1      | Tenant 1  | Student  | tu1@example.com      | TEN1     |
      | tu2      | Tenant 2  | Student  | tu2@example.com      | TEN2     |
    And I log in as "manager"

    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I should see "Active" in the "Manual allocation:" definition list item
    And I click on "Users" "link" in the "#region-main" "css_element"
    When I press "Allocate users"
    And I set the following fields to these values:
      | Users | Student 1 |
    And I press dialog form button "Allocate users"
    Then "Student 1" row "Source" column of "program_allocations" table should contain "Manual allocation"

    And I am on all programs management page
    And I follow "Program 001"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I should see "Active" in the "Manual allocation:" definition list item
    And I click on "Users" "link" in the "#region-main" "css_element"

    When I press "Allocate users"
    And I set the following fields to these values:
      | Users | Student 1 |
    And I press dialog form button "Allocate users"
    And "Student 1" row "Source" column of "program_allocations" table should contain "Manual allocation"

    And I click on "Select a tenant" "link"
    And I set the following fields to these values:
      | Tenant      | Tenant 1         |
    And I press dialog form button "Switch"

    And I am on all programs management page
    And I follow "Program 000"
    And I click on "Users" "link" in the "#region-main" "css_element"

    When I press "Allocate users"
    And I set the following fields to these values:
      | Users | Tenant 1 Student |
    And I press dialog form button "Allocate users"
    Then "Tenant 1 Student" row "Source" column of "program_allocations" table should contain "Manual allocation"

    And I am on all programs management page
    And I follow "Program 001"
    And I click on "Users" "link" in the "#region-main" "css_element"

    When I press "Allocate users"
    And I set the following fields to these values:
      | Users | Tenant 1 Student |
    And I press dialog form button "Allocate users"
    Then "Tenant 1 Student" row "Source" column of "program_allocations" table should contain "Manual allocation"

  @javascript @_file_upload
  Scenario: Manager may upload CSV file with manual allocations without dates
    Given I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I should see "Active" in the "Manual allocation:" definition list item
    And I click on "Users" "link" in the "#region-main" "css_element"

    When I press "Upload allocations"
    And I upload "enrol/programs/tests/fixtures/upload1.csv" file to "CSV file" filemanager
    And I set the following fields to these values:
      | CSV separator | ,     |
      | Encoding      | UTF-8 |
    And I press dialog form button "Continue"
    And the following fields match these values:
      | User identification column | username |
      | User mapping via           | Username |
      | First line is header       | 1        |
    And I press dialog form button "Upload allocations"
    Then I should see "3 users were assigned to program."
    And "Student 1" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 2" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 3" row "Source" column of "program_allocations" table should contain "Manual allocation"

    When I press "Upload allocations"
    And I upload "enrol/programs/tests/fixtures/upload2.csv" file to "CSV file" filemanager
    And I set the following fields to these values:
      | CSV separator | ,     |
      | Encoding      | UTF-8 |
    And I press dialog form button "Continue"
    And the following fields match these values:
      | User identification column | student1@example.com |
      | User mapping via           | Username             |
      | First line is header       | 0                    |
    And I set the following fields to these values:
      | User mapping via           | Email address    |
    And I press dialog form button "Upload allocations"
    Then I should see "1 users were assigned to program."
    And I should see "2 users were already assigned to program."
    And I should see "1 errors detected when assigning programs."
    And "Student 1" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 2" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 3" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 4" row "Source" column of "program_allocations" table should contain "Manual allocation"

    When I press "Upload allocations"
    And I upload "enrol/programs/tests/fixtures/upload3.csv" file to "CSV file" filemanager
    And I set the following fields to these values:
      | CSV separator | ;     |
      | Encoding      | UTF-8 |
    And I press dialog form button "Continue"
    And the following fields match these values:
      | User identification column | idnumber  |
      | User mapping via           | ID number |
      | First line is header       | 1         |
    And I press dialog form button "Upload allocations"
    Then I should see "1 users were assigned to program."
    And I should see "1 users were already assigned to program."
    And "Student 1" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 2" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 3" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 4" row "Source" column of "program_allocations" table should contain "Manual allocation"
    And "Student 5" row "Source" column of "program_allocations" table should contain "Manual allocation"

  @javascript @_file_upload
  Scenario: Manager may upload CSV file with manual allocations including program dates
    Given I log in as "manager1"
    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Allocation settings"
    And I click on "Update scheduling" "link"
    And I set the following fields to these values:
      | Program start              | At a fixed date |
      | programstart_date[year]    | 2022 |
      | programstart_date[day]     | 5    |
      | programstart_date[month]   | 11   |
      | programstart_date[hour]    | 09   |
      | programstart_date[minute]  | 00   |
      | Program due                | At a fixed date |
      | programdue_date[year]      | 2023 |
      | programdue_date[day]       | 22   |
      | programdue_date[month]     | 1    |
      | programdue_date[hour]      | 09   |
      | programdue_date[minute]    | 00   |
      | Program end                | At a fixed date |
      | programend_date[year]      | 2023 |
      | programend_date[month]     | 12   |
      | programend_date[day]       | 31   |
      | programend_date[hour]      | 09   |
      | programend_date[minute]    | 00   |
    And I press dialog form button "Update scheduling"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I should see "Active" in the "Manual allocation:" definition list item
    And I click on "Users" "link" in the "#region-main" "css_element"

    When I press "Upload allocations"
    And I upload "enrol/programs/tests/fixtures/upload4.csv" file to "CSV file" filemanager
    And I set the following fields to these values:
      | CSV separator | ,     |
      | Encoding      | UTF-8 |
    And I press dialog form button "Continue"
    And the following fields match these values:
      | User identification column | username           |
      | User mapping via           | Username           |
    And I set the following fields to these values:
      | Time start column          | startdate          |
      | Time due column            | duedate            |
      | Time end column            | enddate            |
    And I press dialog form button "Upload allocations"
    Then I should see "3 users were assigned to program."
    And I should see "3 errors detected when assigning programs."
    Then the following should exist in the "program_allocations" table:
      | First name          | Program start   | Due date        | Program end     | Source            |
      | Student 1           | 5/11/22, 09:00  | 22/01/23, 09:00 | 31/12/23, 09:00 | Manual allocation |
      | Student 2           | 11/10/22, 00:00 | 31/12/22, 00:00 | 31/01/23, 23:52 | Manual allocation |
      | Student 3           | 11/10/22, 00:00 | 22/01/23, 09:00 | 31/12/23, 09:00 | Manual allocation |
