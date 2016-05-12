@smoke
@mink:browser
Feature: Search
    In order to find articles
    As a user
    I need to be able to search by text

    Background:
        Given I am on the homepage
        And I click on "#top-switches .fa-search"

    Scenario: Search for Viajes
        When  I fill in "s" with "Viajes"
        And I press "Buscar"
        Then I should see "Resultados de la búsqueda para: Viajes"
        And I should see 8 "#page article.post" elements

    Scenario: Search for something that doesn't exist and show search form
        When  I fill in "s" with "kjsdhfksdjfsdlkfj"
        And I press "Buscar"
        Then I should see "No se ha encontrado nada"
        And I should see a "#searchform-content" element
