@enrol @enrol_programs @openlms @tool_certificate
Feature: Issuing of certificates for program completion

  Background:
    Given I skip tests if "tool_certificate" is not installed
    And unnecessary Admin bookmarks block gets deleted
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | manager1 | Manager   | 1        | manager1@example.com |
      | manager2 | Manager   | 2        | manager2@example.com |
      | viewer1  | Viewer    | 1        | viewer1@example.com  |
      | student1 | Student   | 1        | student1@example.com |
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
      | enrol/programs:admin           | Allow      | pmanager | System       |           |
      | tool/certificate:manage        | Allow      | pmanager | System       |           |
      | moodle/site:configview         | Allow      | pmanager | System       |           |
      | tool/certificate:issue         | Allow      | pmanager | System       |           |
      | tool/certificate:viewallcertificates | Allow| pmanager | System       |           |
    And the following "role assigns" exist:
      | user      | role          | contextlevel | reference |
      | manager1  | pmanager      | System       |           |
      | viewer1   | pviewer       | System       |           |
    And the following "enrol_programs > programs" exist:
      | fullname    | idnumber | category |
      | Program 000 | PR0      |          |
      | Program 001 | PR1      |          |

  @javascript
  Scenario: Manager may assign certificate template to a program
    Given I log in as "manager1"
    And I navigate to "Certificates > Manage certificate templates" in site administration
    And I follow "New certificate template"
    And I set the field "Name" to "Certificate 1"
    And I click on "Save" "button" in the ".modal.show .modal-footer" "css_element"
    And I navigate to "Certificates > Manage certificate templates" in site administration
    And I follow "New certificate template"
    And I set the field "Name" to "Certificate 2"
    And I click on "Save" "button" in the ".modal.show .modal-footer" "css_element"
    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Certificate"

    When I press "Edit"
    And I set the following fields to these values:
      | Certificate template | Certificate 1 |
      | Expiry date          | Never         |
    And I press dialog form button "Update program"
    Then I should see "Certificate 1" in the "Certificate template:" definition list item
    And I should see "Never" in the "Expiry date:" definition list item

    When I press "Edit"
    And the following fields match these values:
      | Certificate template | Certificate 1 |
      | Expiry date          | Never         |
    And I set the following fields to these values:
      | Certificate template        | Certificate 2 |
      | Expiry date                 | Select date   |
      | expirydateabsolute[day]     | 5             |
      | expirydateabsolute[month]   | 11            |
      | expirydateabsolute[year]    | 2032          |
      | expirydateabsolute[hour]    | 09            |
      | expirydateabsolute[minute]  | 00            |
    And I press dialog form button "Update program"
    Then I should see "Certificate 2" in the "Certificate template:" definition list item
    And I should see "Friday, 5 November 2032, 9:00" in the "Expiry date:" definition list item

    When I press "Edit"
    And the following fields match these values:
      | Certificate template        | Certificate 2 |
      | Expiry date                 | Select date   |
      | expirydateabsolute[day]     | 5             |
      | expirydateabsolute[month]   | 11            |
      | expirydateabsolute[year]    | 2032          |
      | expirydateabsolute[hour]    | 09            |
      | expirydateabsolute[minute]  | 00            |
    And I set the following fields to these values:
      | Certificate template         | Certificate 1 |
      | Expiry date                  | After         |
      | expirydaterelative[number]   | 5             |
      | expirydaterelative[timeunit] | 86400         |
    And I press dialog form button "Update program"
    Then I should see "Certificate 1" in the "Certificate template:" definition list item
    And I should see "5 days" in the "Expiry date:" definition list item

    When I press "Delete"
    And I press dialog form button "Delete"
    Then I should see "Not set" in the "Certificate template:" definition list item

  @javascript
  Scenario: User is issued a program certificate
    Given I log in as "manager1"
    And I navigate to "Certificates > Manage certificate templates" in site administration
    And I follow "New certificate template"
    And I set the field "Name" to "Certificate 1"
    And I click on "Save" "button" in the ".modal.show .modal-footer" "css_element"
    And I am on all programs management page
    And I follow "Program 000"
    And I follow "Certificate"

    And I press "Edit"
    And I set the following fields to these values:
      | Certificate template | Certificate 1 |
      | Expiry date          | Never         |
    And I press dialog form button "Update program"
    And I should see "Certificate 1" in the "Certificate template:" definition list item
    And I should see "Never" in the "Expiry date:" definition list item

    And I follow "Allocation settings"
    And I click on "Update Manual allocation" "link"
    And I set the following fields to these values:
      | Active | Yes |
    And I press dialog form button "Update"
    And I should see "Active" in the "Manual allocation:" definition list item
    And I follow "Users"

    And I press "Allocate users"
    And I set the following fields to these values:
      | Users | Student 1 |
    And I press dialog form button "Allocate users"

    And I follow "Users"
    And I follow "Student 1"
    And I click on "Edit" "link" in the "Program 000" "table_row"
    And I set the following fields to these values:
      | evidencetimecompleted[enabled] | 1        |
      | Details                        | no need! |
    And I press dialog form button "Update"
    And I should see "Completed" in the "Program status:" definition list item

    And I log out

    When I run the "enrol_programs\task\certificate" task
    And I log in as "student1"
    And I follow "Profile" in the user menu
    And I click on "//a[contains(.,'My certificates') and contains(@href,'tool/certificate')]" "xpath_element"
    Then I should see "Certificate 1"
