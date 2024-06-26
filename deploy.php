<?php

namespace Deployer;

require __DIR__.'/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

require 'recipe/laravel.php';

// Project name
set('application', 'world-cup-pool');

// Project repository
set('repository', 'https://github.com/tylermarien/world-cup-pool.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);
set('writable_mode', 'chmod');
set('writable_chmod_mode', '0775');
set('allow_anonymous_stats', false);

// Hosts
host($_ENV['DEPLOY_HOST'])
    ->set('remote_user', $_ENV['DEPLOY_USER'])
    ->set('deploy_path', $_ENV['DEPLOY_PATH']);

// Tasks

task('yarn', function () {
    run('cd {{release_path}} && yarn install --frozen-lockfile');
});

task('build', function () {
    run('cd {{release_path}} && NODE_OPTIONS=--openssl-legacy-provider npx mix');
});

task('permissions', function () {
    run ('chgrp -R www-data {{release_path}}');
    run ('chmod -R g+w {{release_path}}');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

after('deploy:update_code', 'yarn');
after('deploy:update_code', 'build');
after('deploy:update_code', 'permissions');
before('deploy:symlink', 'artisan:migrate');

