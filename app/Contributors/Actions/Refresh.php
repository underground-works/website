<?php namespace App\Contributors\Actions;

use GrahamCampbell\GitHub\GitHubManager;
use Github\Exception\RuntimeException;

use App\Contributors\Contributors;

class Refresh
{
	public function handle(Contributors $contributors, array $changelogs)
	{
		$updatedContributors = collect($changelogs)
			->flatMap(fn($changelog) => $this->parseChangelog($changelog))->unique()
			->map(fn($username) => $this->fetchGithubUser($username))->filter()
			->map(fn($user) => $this->mapGithubUser($user));

		$contributors->set($updatedContributors)->save();
	}

	protected function parseChangelog($changelog)
	{
		$usernames = collect();

		$changelog = file_get_contents($changelog);

		preg_match_all('/\([^\(]*? thanks!\)/', $changelog, $matches);

		$usernames = $usernames->merge(collect($matches[0])->flatMap(function ($match) {
			preg_match_all('/(\w+)(?:,| and) /', $match, $matches);
			return $matches[1];
		}));

		preg_match_all('/\(thanks ([^\)]*?)\)/', $changelog, $matches);

		$usernames = $usernames->merge(collect($matches[1])->flatMap(function ($match) {
			preg_match_all('/(\w+)(?:, | and )?/', $match, $matches);
			return $matches[1];
		}));

		return $usernames->unique();
	}

	protected function fetchGithubUser($username)
	{
		try {
			return app(GitHubManager::class)->user()->show($username);
		} catch (RuntimeException $e) {
			return null;
		}
	}

	protected function mapGithubUser($user)
	{
		return [
			'userName'  => $user['login'],
			'fullName'  => $user['name'],
			'avatarUrl' => $user['avatar_url'],
			'url'       => $user['html_url'],
			'githubId'  => $user['id']
		];
	}
}
