@mink:browser
Feature: Proper HTTP statuses
    In order to read blogs
    As a user
    I need to navigate through the blog and see posts

    Scenario: List my blog posts
        Given I am on the homepage
        Then I should see "Viajes desde un blog"
