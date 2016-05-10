#!/bin/bash
# DEPS
composer install --no-interaction
#QA
./vendor/bin/phpcs --config-set installed_paths vendor/wp-coding-standards/wpcs
./vendor/bin/dep qa dev
#STAGING
./vendor/bin/dep deploy staging
#TEST
./vendor/bin/behat --profile=staging
