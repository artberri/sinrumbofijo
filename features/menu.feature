@smoke
@mink:browser
Feature: Menu
    In order to get information about the blog
    As a visitor
    I need to be able to navigate through the menu

    Background:
      Given I am on the homepage
      And I click on "#top-switches .fa-align-justify"

    Scenario: ¿Quiénes somos?
        And I follow "¿Quiénes somos?"
        Then I should be on "/quienes-somos/"

    Scenario: Anunciate
        And I follow "Anunciate"
        Then I should be on "/anunciate/"

    Scenario: Contacto
        And I follow "Contacto"
        Then I should be on "/contacto/"

    Scenario: Homepage
        And I follow "Inicio"
        Then I should be on the homepage
