<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/yarn.php';

// Project name
set('application', 'world-cup-pool');

// Project repository
set('repository', 'git@github.com:tylermarien/world-cup-pool.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['sport.db']);
add('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);
set('writable_mode', 'chmod');
set('writable_chmod_mode', '0775');
set('allow_anonymous_stats', false);

// Hosts

host('worldcupdraft.xyz', 'worldcuppool.xyz')
    ->set('deploy_path', '/var/www/{{ hostname }}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && yarn run prod');
});

task('bundle', function () {
    run('cd {{release_path}} && bundle install --path vendor/bundle');
});

task('permissions', function () {
    run ('chgrp -R www-data {{release_path}}');
    run ('chmod -R g+w {{release_path}}');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

after('deploy:update_code', 'bundle');
after('deploy:update_code', 'yarn:install');
after('deploy:update_code', 'build');
after('deploy:update_code', 'permissions');
before('deploy:symlink', 'artisan:migrate');

