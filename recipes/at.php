<?php

/**
 * Run Acceptance Tests
 */

task('at', function () {

  $stage = env('app.stage');
  $testCommand = './vendor/bin/behat';
  if ('dev' != $stage) {
    $testCommand .= ' --profile=' . $stage;
  }

  $seleniumPid = runLocally('nohup ./vendor/bin/selenium-server-standalone > /dev/null 2> /dev/null & echo $!');
  writeln('<info>Selenium running with pid: ' . $seleniumPid . '</info>');

  writeln('<info>Waiting until selenium is started</info>');
  $output = runLocally('sleep 7');

  $output = runLocally($testCommand);
  writeln('<info>' . $output . '</info>');

  $output = runLocally('kill ' . $seleniumPid);
  writeln('<info>Selenium stopped</info>');
})->desc('Run Acceptance Tests');
