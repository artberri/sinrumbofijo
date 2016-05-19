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
    * @BeforeScenario
    *
    * @param BeforeScenarioScope $scope
    *
    */
  public function setUpTestEnvironment($scope)
  {
      $this->currentScenario = $scope->getScenario();
  }

  /**
    * @BeforeStep
    */
  public function beforeStep()
  {
    $driver = $this->getSession()->getDriver();
    if ($driver instanceof Selenium2Driver) {
      // $driver->maximizeWindow();
      $driver->resizeWindow(944, 900, 'current');
    }
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
   * @When /^I hover over the element "(?P<locator>(?:[^"]|\\")*)"$/
   */
  public function iHoverOverTheElement($locator)
  {
    $element = $this->getSession()->getPage()->find('css', $locator);

    // errors must not pass silently
    if (null === $element) {
        throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $locator));
    }

    // ok, let's hover it
    $element->mouseOver();
  }

  /**
    * @AfterStep
    *
    * @param AfterStepScope $scope
    */
  public function afterStep($scope)
  {
    //if test has failed, and is not an api test, get screenshot
    if (TestResult::FAILED === $scope->getTestResult()->getResultCode()) {
      $driver = $this->getSession()->getDriver();

      if ($driver instanceof Selenium2Driver) {
        //create filename string
        $featureFolder = str_replace(' ', '', $scope->getFeature()->getTitle());

        $scenarioName = $this->currentScenario->getTitle();
        $fileName = str_replace(' ', '', $scenarioName) . '.png';

        //create screenshots directory if it doesn't exist
        if (!file_exists('reports/html/behat/assets/screenshots/' . $featureFolder)) {
            mkdir('reports/html/behat/assets/screenshots/' . $featureFolder, 0777, true);
        }

        //take screenshot and save as the previously defined filename
        file_put_contents('reports/html/behat/assets/screenshots/' . $featureFolder . '/' . $fileName, $this->getSession()->getDriver()->getScreenshot());
      }
    }
  }

}
