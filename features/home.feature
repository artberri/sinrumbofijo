@smoke
@mink:browser
Feature: Home Page
    In order to get a blog overview
    As a visitor
    I need to be able to see several posts and info in the homepage

    Background:
        Given I am on the homepage

    Scenario: Blog Title
        Then I should see "Sin Rumbo Fijo"

    Scenario: Slider
        Then I should see a ".smartlib-front-slider" element

    Scenario: Categorías
        Then I should see "Categorías"

    Scenario: Facebook box
        Then I should see a "#simple-facebook-widget" element

    Scenario: Blog Posts
        Then I should see 8 ".smartlib-grid-list article.post" elements
