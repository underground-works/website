<?php namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';

// Project name
set('application', 'underground.works');

// Project repository
set('repository', 'https://github.com/underground-works/website.git');

// Shared files/dirs between deploys
add('shared_files', [ 'public/clockwork' ]);
set('writable_dirs', []);

set('default_stage', 'production');

set('allow_anonymous_stats', false);

set('user', function () {
	return runLocally('git config --get user.name');
});

// Hosts

host('arizona')
	->set('labels', [ 'stage' => 'development' ])
	->set('user', 'its')
	->set('deploy_path', '/Sites/its/underground.works');

// Tasks

desc('Execute npm run production');
task('npm:run:production', function () {
	run('cd {{release_path}} && {{bin/npm}} run production');
});

/**
 * Main deploy task.
 */
desc('Deploys your project');
task('deploy', [
	'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:cache',
	'npm:install',
	'npm:run:production',
    'deploy:publish',
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
