<?php
use Deployer\Deployer;

require 'recipe/common.php';
require 'vendor/deployphp/recipes/recipes/configure.php';
require 'vendor/deployphp/recipes/recipes/rsync.php';
require 'recipes/qa.php';

date_default_timezone_set('UTC');

function deployset($key, $value)
{
    Deployer::get()->parameters->set($key, $value);
}

deployset('keep_releases', 5);
deployset('shared_dirs', [
    'wp-content/uploads',
]);
deployset('shared_files', [
    'wp-config.php',
    'wp/gc-config.ini.php',
]);
deployset('writable_use_sudo', false);
deployset('http_user', 'deploy');

env('rsync_src', __DIR__ . '/src');
deployset('rsync', [
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
