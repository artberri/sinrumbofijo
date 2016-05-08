<?php

/**
 * Make code quality checks
 */
task('qa', function () {
  $output = runLocally('./vendor/bin/phpcs');
  writeln('<info>' . $output . '</info>');
})->desc('Code quality checks');
