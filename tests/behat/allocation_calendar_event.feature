@enrol @enrol_programs @openlms
Feature: Program enrolment allocation calendar event tests

  Background:
    Given the following "users" exist:
      | id  | username    | firstname     | lastname      | email                     |
      | 1   | student1    | Student       | 1             | student1@example.com      |
      | 2   | student2    | Student       | 2             | student2@example.com      |
    And the following "events" exist:
      | name              | eventtype     | component         | instance   | userid  |
      | I1 start event    | programstart  | enrol_programs    | 1          | 1       |
      | I1 end event      | programend    | enrol_programs    | 1          | 1       |
      | I1 due event      | programdue    | enrol_programs    | 1          | 1       |
      | I2 start event    | programstart  | enrol_programs    | 2          | 2       |
      | I2 end event      | programend    | enrol_programs    | 2          | 2       |
      | I2 due event      | programdue    | enrol_programs    | 2          | 2       |

  @javascript
  Scenario: Users enrolled in a course can see all child and parent events in their category
    Given I log in as "student1"
    And I press "Customise this page"
    When I add the "Navigation" block if not present
    And I click on "Site pages" "list_item" in the "Navigation" "block"
    And I click on "Calendar" "link" in the "Navigation" "block"
    Then I should see "I1 start event"
    And  I should see "I1 end event"
    And  I should see "I1 due event"
    And  I should not see "I2 start event"
    And  I should not see "I2 end event"
    And  I should not see "I2 due event"
