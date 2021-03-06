<?php

/**
 * Make code quality checks
 */

task('qa:phpunit', function () {
  $output = runLocally('./vendor/bin/phpunit');
  writeln('<info>' . $output . '</info>');
})->desc('Run PHPUnit');

task('qa:phpcs', function () {
  $output = runLocally('./vendor/bin/phpcs --config-set installed_paths vendor/wp-coding-standards/wpcs');
  writeln('<info>' . $output . '</info>');

  $output = runLocally('./vendor/bin/phpcs');
  writeln('<info>' . $output . '</info>');
})->desc('Run PHPCS');

task('qa', [
  'qa:phpcs',
  'qa:phpunit',
])->desc('Code quality checks');
