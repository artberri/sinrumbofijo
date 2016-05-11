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
        Then I should see a "#commentform" element
        And I should see a ".smartlib-related-posts" element
        And I should see a ".harmonux_widget_recent_entries" element

    Scenario: Make a comment
        When I fill in the following:
        | author |Testuser |
        | email | test@example.com |
        | url | http://example.com |
        And I fill in "comment" with 15 random words
        And I press "Publicar comentario"
        Then I should see a ".smartlib-comments-title .fa-comment" element
