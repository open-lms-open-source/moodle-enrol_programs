@enrol @enrol_programs @openlms
Feature: Myprograms block on user dashboard

  Background:
    Given unnecessary Admin bookmarks block gets deleted
    And the following "categories" exist:
      | name  | category | idnumber |
      | Cat 1 | 0        | CAT1     |
      | Cat 2 | 0        | CAT2     |
      | Cat 3 | 0        | CAT3     |
    And the following "courses" exist:
      | fullname | shortname | format | category |
      | Course 1 | C1        | topics | CAT1     |
      | Course 2 | C2        | topics | CAT2     |
      | Course 3 | C3        | topics | CAT3     |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber  | category | public |
      | Program 000 | PR00      |          | 1      |
      | Program 001 | PR01      | Cat 1    | 1      |
      | Program 002 | PR02      | Cat 1    | 1      |
      | Program 003 | PR03      | Cat 1    | 1      |
      | Program 004 | PR04      | Cat 1    | 1      |
      | Program 005 | PR05      | Cat 1    | 1      |
      | Program 006 | PR06      | Cat 1    | 1      |
      | Program 007 | PR07      | Cat 1    | 1      |
      | Program 008 | PR08      | Cat 1    | 1      |
      | Program 009 | PR09      | Cat 1    | 1      |
      | Program 010 | PR010     | Cat 1    | 1      |
      | Program 011 | PR011     | Cat 1    | 1      |
      | Program 012 | PR012     | Cat 1    | 1      |
      | Program 013 | PR013     | Cat 1    | 1      |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | student1 | Student   | 1        | student1@example.com |
      | student2 | Student   | 2        | student2@example.com |
    And the following "enrol_programs > program_allocations" exist:
      | program     | user     |
      | Program 000 | student1 |
      | Program 001 | student1 |
      | Program 002 | student1 |
      | Program 003 | student1 |
      | Program 004 | student1 |
      | Program 005 | student1 |
      | Program 006 | student1 |
      | Program 007 | student1 |
      | Program 008 | student1 |
      | Program 009 | student1 |
      | Program 010 | student1 |
      | Program 011 | student1 |
      | Program 012 | student1 |
      | Program 013 | student1 |
    And the following "blocks" exist:
      | blockname      | contextlevel | reference | pagetypepattern | defaultregion |
      | myprograms     | System       | 1         | my-index        | content       |
  @javascript
  Scenario: User can view the myprograms block on the dashboard
    Given I log in as "student1"
    And I should see "My programs"
    And I should see "Program 001"
    When I log in as "student2"
    Then I should see "You are not allocated to any programs."
