Feature: Proper HTTP statuses
    In order to read blogs
    As a user
    I need to navigate through the blog and see posts

    Scenario: See the homepage
        Given I am on the homepage
        Then the response status code should be 200

    Scenario: See the 404 error page
        Given I am on the homepage
        When I go to "/uhbsdfusdbhfusdhfbsdufbsdufbssf"
        Then the response status code should be 404
