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
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('worldcupdraft.xyz')
    ->set('deploy_path', '/var/www/world-cup-pool');

// Tasks

task('build', function () {
    run('cd {{release_path}} && yarn run prod');
});


// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

after('deploy:update_code', 'yarn:install');
after('deploy:update_code', 'build');
before('deploy:symlink', 'artisan:migrate');

