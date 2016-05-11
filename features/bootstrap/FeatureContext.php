<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Testwork\Tester\Result\TestResult;
use Behat\Mink\Exception\ElementNotFoundException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
  private $failedCount = 0;

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
    $locator = $this->getSession()->getPage()->find('css', $link);

    if (null === $locator) {
        throw new ElementNotFoundException($this->getSession()->getDriver(), 'css', 'css', $link);
    }

    $locator->click();
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
    $locator = $this->getSession()->getPage()->find('css', $link);

    if (null === $locator) {
        throw new ElementNotFoundException($this->getSession()->getDriver(), 'css', 'css', $link);
    }

    $locator->submit();
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

  /**
  * Take screenshot when step fails.
  * Works only with Selenium2Driver.
  *
  * @AfterStep
  */
  public function takeScreenshotAfterFailedStep($scope)
  {
    if (TestResult::FAILED === $scope->getTestResult()->getResultCode()) {
      $driver = $this->getSession()->getDriver();
      if ($driver instanceof Selenium2Driver) {
        if ( !file_exists('reports/html/behat') ) {
            mkdir('reports/html/behat', 0777, true);
        }
        file_put_contents('reports/html/behat/test_' . md5(time()) . '.png', $this->getSession()->getDriver()->getScreenshot());
        ++$this->failedCount;
      }
    }
  }

}
