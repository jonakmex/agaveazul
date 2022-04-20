Feature: Transfer Money between accounts
    As a Tesorero I want to transfer money from one account to another    

Scenario: Source account has enough money
    Given An Account A with balance of 100
    And An existing target account B with balance of 0
    When Tesorero transfers 30 from account A to account B
    Then Account A has a balance of 70
    And Account B has a balance of 30

Scenario: Source account has not enough money
    Given An account A with balance of 100
    And An existing target account B with balance of 0
    When Tesorero transfers 120 from account A to account B
    Then An error occurs saying "insufficient balance"