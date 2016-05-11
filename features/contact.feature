@smoke
@mink:browser
Feature: Contact
    In order to avoid SPAM
    As an administrator
    I need to be able to block simple mail SPAM bots

    Background:
        Given I am on the homepage
        And I follow "Contacto"

    Scenario: Invalid Contact Form
        When I fill in the following:
        | email_1 | alberto@berriart.com |
        | subject_1 | Hola que tal? |
        | message_1 | Mensaje de prueba |
        | hdcaptcha_cp_contactformtoemail_post | iLoveBats123 |
        And I submit ".cpp_form" form
        Then I should see a "#hdcaptcha_error_1" element
