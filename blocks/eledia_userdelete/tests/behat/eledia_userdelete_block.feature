@block @block_eledia_userdelete
Feature: block_eledia_userdelete

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | student1 | Student   | First    | student1@example.com |

  @javascript
  Scenario: block_eledia_userdelete add block
    Given I log in as "admin"
    And I am on site homepage
    And I turn editing mode on
    And I add the "Delete User by Maillist" block
    Then I should see "Delete User by Maillist" in the "Delete User by Maillist" "block"
    Then I should see "Start Delete User" in the "Delete User by Maillist" "block"
    Then I follow "Start Delete User"
    And I set the following fields to these values:
      | id_user_mails | student1@example.com |
    And I press "Check user"
    And I press "Delete user"
    And I navigate to "Users > Accounts > Browse list of users" in site administration
    Then I should not see "student1"