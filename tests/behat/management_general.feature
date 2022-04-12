@enrol @enrol_programs @olms
Feature: General program management tests

  Background:
    Given Unnecessary Admin bookmarks block gets deleted
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

  @javascript
  Scenario: Manager may create a new program with required settings
    Given I log in as "manager1"
    And I am on all programs management page

    When I press "Add program"
    And the following fields match these values:
      | Program name  |             |
      | ID number     |             |
      | Course groups | No          |
      | Description   |             |
    And I set the following fields to these values:
      | Program name  | Program 001 |
      | ID number     | PR01        |
    And I press dialog form button "Add program"
    Then I should see "Program 001" in the "Full name:" definition list item
    And I should see "PR01" in the "ID number:" definition list item
    And I should see "System" in the "Category:" definition list item
    And I should see "No" in the "Course groups:" definition list item
    And I should see "No" in the "Archived:" definition list item
    And I am on all programs management page
    And "Program 001" row "Category" column of "management_programs" table should contain "System"
    And "Program 001" row "ID number" column of "management_programs" table should contain "PR01"
    And "Program 001" row "Public" column of "management_programs" table should contain "No"

  @javascript @_file_upload
  Scenario: Manager may create a new programs with all settings
    Given I log in as "manager1"
    And I am on all programs management page

    When I press "Add program"
    And the following fields match these values:
      | Program name  |             |
      | ID number     |             |
      | Course groups | No          |
      | Description   |             |
    And I set the following fields to these values:
      | Program name  | Program 001 |
      | ID number     | PR01        |
      | Course groups | Yes         |
      | Description   | Nice desc   |
    And I upload "enrol/programs/tests/fixtures/badge.png" file to "Program image" filemanager
    And I open the autocomplete suggestions list in the "Context" "fieldset"
    And I should see "Miscellaneous" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Cat 1" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Cat 2" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Cat 3" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Cat 3 / Cat 4" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I set the field "Context" to "Cat 2"
    And I set the field "Tags" to "Mathematics, Algebra"
    And I press dialog form button "Add program"
    Then I should see "Program 001" in the "Full name:" definition list item
    And I should see "PR01" in the "ID number:" definition list item
    And I should see "Cat 2" in the "Category:" definition list item
    And I should see "Yes" in the "Course groups:" definition list item
    And I should see "No" in the "Archived:" definition list item
    And I should see "Mathematics" in the "Tags:" definition list item
    And I should see "Algebra" in the "Tags:" definition list item
    And I am on programs management page in "Cat 2"
    And "PR01" row "Program name" column of "management_programs" table should contain "Program 001"
    And "PR01" row "Program name" column of "management_programs" table should contain "Mathematics"
    And "PR01" row "Program name" column of "management_programs" table should contain "Algebra"
    And "PR01" row "Description" column of "management_programs" table should contain "Nice desc"
    And "PR01" row "Public" column of "management_programs" table should contain "No"
    And "PR01" row "Courses" column of "management_programs" table should contain "0"
    And "PR01" row "Allocations" column of "management_programs" table should contain "0"

  @javascript
  Scenario: Manager may update basic general settings of an existing program
    Given I log in as "manager1"
    And I am on all programs management page
    And I press "Add program"
    And I set the following fields to these values:
      | Program name  | Program 001 |
      | ID number     | PR01        |
    And I press dialog form button "Add program"

    When I press "Edit"
    And I set the following fields to these values:
      | Program name  | Program 002 |
      | ID number     | PR02        |
    And I press dialog form button "Update program"
    Then I should see "Program 002" in the "Full name:" definition list item
    And I should see "PR02" in the "ID number:" definition list item
    And I should see "System" in the "Category:" definition list item
    And I should see "No" in the "Course groups:" definition list item
    And I should see "No" in the "Archived:" definition list item

  @javascript @_file_upload
  Scenario: Manager may update all general settings of an existing program
    Given I log in as "manager1"
    And I am on all programs management page
    And I press "Add program"
    And I set the following fields to these values:
      | Program name  | Program 002 |
      | ID number     | PR02        |
    And I open the autocomplete suggestions list in the "Context" "fieldset"
    And I set the field "Context" to "Cat 1"
    And I set the field "Tags" to "Logic"
    And I press dialog form button "Add program"

    When I press "Edit"
    And I set the following fields to these values:
      | Program name  | Program 001 |
      | ID number     | PR01        |
      | Course groups | Yes         |
      | Description   | Nice desc   |
    And I upload "enrol/programs/tests/fixtures/badge.png" file to "Program image" filemanager
    And I open the autocomplete suggestions list in the "Context" "fieldset"
    And I should see "System" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Miscellaneous" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should not see "Cat 1" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Cat 2" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Cat 3" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I should see "Cat 3 / Cat 4" in the "#fitem_id_contextid .form-autocomplete-suggestions" "css_element"
    And I set the field "Context" to "Cat 2"
    And I set the field "Tags" to "Mathematics, Algebra"
    And I press dialog form button "Update program"
    Then I should see "Program 001" in the "Full name:" definition list item
    And I should see "PR01" in the "ID number:" definition list item
    And I should see "Cat 2" in the "Category:" definition list item
    And I should see "Yes" in the "Course groups:" definition list item
    And I should see "No" in the "Archived:" definition list item
    And I should see "Mathematics" in the "Tags:" definition list item
    And I should see "Algebra" in the "Tags:" definition list item
