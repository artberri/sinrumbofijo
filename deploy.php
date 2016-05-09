<?php
require 'recipe/common.php';
require 'vendor/deployphp/recipes/recipes/configure.php';
require 'vendor/deployphp/recipes/recipes/rsync.php';
require 'recipes/qa.php';

date_default_timezone_set('UTC');

set('keep_releases', 5);
set('shared_dirs', [
    'wp-content/uploads',
    'wp-content/cache',
]);
set('shared_files', [
    'wp-config.php',
    'wp/gc-config.ini.php',
]);
set('writable_use_sudo', false);
set('http_user', 'deploy');

env('rsync_src', __DIR__ . '/src');
set('rsync', [
    'exclude' => [
        'wp-content/upgrade',
        'wp-content/cache',
        'wp-config.php',
        'wp-content/uploads',
    ],
    'exclude-file' => false,
    'include' => [],
    'include-file' => false,
    'filter' => [],
    'filter-file' => false,
    'filter-perdir' => false,
    'flags' => 'rz',
    'options' => ['delete'],
    'timeout' => 300,
]);

task('deploy', [
  'deploy:prepare',
  'deploy:release',
  'deploy:configure',
  'rsync',
  'deploy:shared',
  'deploy:symlink',
  'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');

serverList(__DIR__ . '/servers.yml');
