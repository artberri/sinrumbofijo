@smoke
@mink:browser
Feature: Menu
    In order to get information about the blog
    As a visitor
    I need to be able to navigate through the menu

    Scenario: ¿Quiénes somos?
        Given I am on the homepage
        And I follow "¿Quiénes somos?"
        Then I should be on "/quienes-somos/"

    Scenario: Anunciate
        Given I am on "/quienes-somos/"
        And I follow "Anunciate"
        Then I should be on "/anunciate/"

    Scenario: Contacto
        Given I am on "/anunciate/"
        And I follow "Contacto"
        Then I should be on "/contacto/"

    Scenario: Homepage
        Given I am on "/contacto/"
        And I follow "Inicio"
        Then I should be on the homepage
