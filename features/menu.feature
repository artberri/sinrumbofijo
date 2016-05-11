@smoke
@mink:browser
Feature: Menu
    In order to get information about the blog
    As a visitor
    I need to be able to navigate through the menu

    Scenario: ¿Quiénes somos?
        Given I am on the homepage
        And I click on "#menu-item-467 a"
        Then I should be on "/quienes-somos/"

    Scenario: Anunciate
        Given I am on "/quienes-somos/"
        And I click on "#menu-item-468 a"
        Then I should be on "/anunciate/"

    Scenario: Contacto
        Given I am on "/anunciate/"
        And I click on "#menu-item-469 a"
        Then I should be on "/contacto/"

    Scenario: Homepage
        Given I am on "/contacto/"
        And I click on "#menu-item-466 a"
        Then I should be on the homepage
