Feature: Create Units
  Scenario Outline: Create Unit
    Given I want to Register a Unit
    When I provide the <description> and <reference>
    And I confirm
    Then I should see <result> message
    Examples:
    |description|reference|result|
    |"Casa 10"    |"5108"     |"success"|
    |""           |"5108"     |"fail"   |
    |"Casa 10"    |""         |"fail"   |
