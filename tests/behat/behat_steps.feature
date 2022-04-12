@enrol @enrol_programs @olms
Feature: Programs navigation behat steps test

  Background:
    Given Unnecessary Admin bookmarks block gets deleted
    And the following "categories" exist:
      | name  | category | idnumber |
      | Cat 1 | 0        | CAT1     |
      | Cat 2 | 0        | CAT2     |
      | Cat 3 | 0        | CAT3     |
      | Cat 4 | CAT3     | CAT4     |
    And the following "courses" exist:
      | fullname | shortname | format |
      | Course 1 | C1        | topics |
      | Course 2 | C2        | topics |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | manager1 | Manager   | 1        | manager1@example.com |
      | manager2 | Manager   | 2        | manager2@example.com |
      | viewer1  | Viewer    | 1        | viewer1@example.com  |
      | viewer2  | Viewer    | 2        | viewer2@example.com  |
      | student1 | Student   | 1        | student1@example.com |
    And the following "roles" exist:
      | name           | shortname |
      | Program viewer | pviewer   |
    And the following "permission overrides" exist:
      | capability                     | permission | role    | contextlevel | reference |
      | enrol/programs:view            | Allow      | pviewer | System       |           |
#      | moodle/category:viewcourselist | Allow      | pviewer | System       |           |
#      | moodle/category:viewcourselist | Allow      | manager | System       |           |
    And the following "role assigns" exist:
      | user     | role          | contextlevel | reference |
      | manager1 | manager       | System       |           |
      | manager2 | manager       | Category     | CAT1      |
      | viewer1  | pviewer       | System       |           |
      | viewer2  | pviewer       | Category     | CAT1      |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber | category | public | archived |
      | Program 000 | PR0      |          | 0      | 0        |
      | Program 001 | PR1      | Cat 1    | 1      | 0        |
      | Program 002 | PR2      | Cat 2    | 0      | 0        |
      | Program 003 | PR3      |          | 1      | 1        |

  Scenario: Admin navigates to programs via behat step
    Given I log in as "admin"

    When I am on all programs management page
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"

    When I am on programs management page in "system"
    Then I should see "Program management"
    And I should see "Program 000"
    And I should not see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

    When I am on programs management page in "Cat 1"
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

  @javascript
  Scenario: Admin navigates to programs the normal way
    Given I log in as "admin"

    When I navigate to "Site administration > Programs > Program management" in site administration
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"

    When I select "System (2)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should see "Program 000"
    And I should not see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

    When I select "Cat 1 (1)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

    When I select "All programs (4)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"

  Scenario: Full manager navigates to programs via behat step
    Given I log in as "manager1"

    When I am on all programs management page
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"

    When I am on programs management page in "system"
    Then I should see "Program management"
    And I should see "Program 000"
    And I should not see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

    When I am on programs management page in "Cat 1"
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

  @javascript
  Scenario: Full manager navigates to programs the normal way
    Given I log in as "admin"

    When I navigate to "Site administration > Programs > Program management" in site administration
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"
    And I should not see "Program 003"

    When I select "System (2)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should see "Program 000"
    And I should not see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"
    And I should not see "Program 003"

    When I select "Cat 1 (1)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"
    And I should not see "Program 003"

    When I select "All programs (4)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"
    And I should not see "Program 003"

  Scenario: Category manager navigates to programs via behat step
    Given I log in as "manager2"

    When I am on programs management page in "Cat 1"
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

  @javascript
  Scenario: Category manager navigates to programs the normal way
    Given I log in as "manager2"

    When I select "Program catalogue" from flat navigation drawer
    And I follow "Program management"
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

  Scenario: Full viewer navigates to programs via behat step
    Given I log in as "viewer1"

    When I am on all programs management page
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"

    When I am on programs management page in "system"
    Then I should see "Program management"
    And I should see "Program 000"
    And I should not see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

    When I am on programs management page in "Cat 1"
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

  @javascript
  Scenario: Full viewer navigates to programs the normal way
    Given I log in as "viewer1"

    When I select "Program catalogue" from flat navigation drawer
    And I follow "Program management"
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"

    When I select "System (2)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should see "Program 000"
    And I should not see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

    When I select "Cat 1 (1)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

    When I select "All programs (4)" from the "Select category" singleselect
    Then I should see "Program management"
    And I should see "Program 000"
    And I should see "Program 001"
    And I should see "Program 002"
    And I should not see "Program 003"
    And I should not see "Program 003"

  Scenario: Category viewer navigates to programs via behat step
    Given I log in as "viewer2"

    When I am on programs management page in "Cat 1"
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

  @javascript
  Scenario: Category viewer navigates to programs the normal way
    Given I log in as "manager2"

    When I select "Program catalogue" from flat navigation drawer
    And I follow "Program management"
    Then I should see "Program management"
    And I should not see "Program 000"
    And I should see "Program 001"
    And I should not see "Program 002"
    And I should not see "Program 003"

  Scenario: Student navigates to Program catalogue via behat step
    Given I log in as "student1"

    When I am on Program catalogue page
      Then I should see "Program catalogue"
      And I should see "Program 001"
      And I should not see "Program 000"
      And I should not see "Program 002"
      And I should not see "Program 003"

  @javascript
  Scenario: Student navigates to Program catalogue the normal way
    Given I log in as "student1"

    When I select "Program catalogue" from flat navigation drawer
    Then I should see "Program catalogue"
    And I should see "Program 001"
    And I should not see "Program 000"
    And I should not see "Program 002"
    And I should not see "Program 003"

  Scenario: Student navigates to My programs via behat step
    Given I log in as "student1"

    When I am on My programs page
    Then I should see "My programs"
    And I should see "You are not allocated to any programs."

  @javascript
  Scenario: Student navigates to My programs the normal way
    Given I log in as "student1"

    When I select "My programs" from flat navigation drawer
    Then I should see "My programs"
    And I should see "You are not allocated to any programs."

  Scenario: List term definition assertion works
    Given I log in as "manager1"
    And I am on all programs management page
    When I follow "Program 000"
    Then I should see "Program 000" in the "Full name:" definition list item
    And I should see "Program" in the "Full name:" definition list item
    And I should see "P" in the "Full name:" definition list item
    And I should see "rog" in the "Full name:" definition list item
  # Uncomment following to test a failure.
    #And I should see "program 000" in the "Full name:" definition list item

  Scenario: List term definition negative assertion works
    Given I log in as "manager1"
    And I am on all programs management page
    When I follow "Program 000"
    Then I should not see "program" in the "Full name:" definition list item
  # Uncomment following to test a failure.
    #And I should not see "Program" in the "Full name:" definition list item
