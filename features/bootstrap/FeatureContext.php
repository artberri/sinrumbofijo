<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
  /**
    * Initializes context.
    *
    * Every scenario gets its own context instance.
    * You can also pass arbitrary arguments to the
    * context constructor through behat.yml.
    */
  public function __construct()
  {
  }

  /**
    * Clicks link with specified id|title|alt|text
    * Example: When I follow "Log In"
    * Example: And I follow "Log In"
    *
    * @When /^(?:|I )click on "(?P<link>(?:[^"]|\\")*)"$/
    */
  public function clickElement($link)
  {
    $link = $this->fixStepArgument($link);
    $this->getSession()->getPage()->find('css', $link)->click();
  }

  /**
    * Clicks link with specified id|title|alt|text
    * Example: When I follow "Log In"
    * Example: And I follow "Log In"
    *
    * @When /^(?:|I )submit "(?P<link>(?:[^"]|\\")*)" form$/
    */
  public function submitForm($link)
  {
    $link = $this->fixStepArgument($link);
    $this->getSession()->getPage()->find('css', $link)->submit();
  }

  /**
    * Fills in form field with specified id|name|label|value
    * Example: When I fill in "username" with 5 random words
    *
    * @When /^(?:|I )fill in "(?P<field>(?:[^"]|\\")*)" with (?P<num>\d+) random words?$/
    */
  public function fillFieldWithRandomValue($field, $num)
  {
    $field = $this->fixStepArgument($field);

    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $words = [];

    for ($i = 0; $i < $num; $i++) {
        $word = substr(str_shuffle($str), 0, 8);
        $words[] = $word;
    }

    $value = implode(' ', $words);

    $this->getSession()->getPage()->fillField($field, $value);
  }

}
