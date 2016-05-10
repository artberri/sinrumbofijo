@mink:browser
Feature: Article
    In order to interact with the author
    As a user
    I need to be able to read and comment articles or navigate to related info

    Background:
        Given I am on the homepage
        And I click on "article.post"

    @smoke
    Scenario: See sections
        Then I should see "Deja un comentario"
        And I should see "Entradas relacionadas"
        And I should see "Entradas recientes"

    Scenario: Make a comment
        Then I should see "Entradas recientes"
        When I fill in the following:
        | author |Testuser |
        | email | test@example.com |
        | url | http://example.com |
        And I fill in "comment" with 15 random words
        And I press "Publicar comentario"
        Then I should see "Testuser"
