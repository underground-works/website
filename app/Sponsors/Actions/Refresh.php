<?php namespace App\Sponsors\Actions;

use GrahamCampbell\GitHub\GitHubManager;
use Github\Exception\RuntimeException;

use App\Sponsors\Sponsors;

class Refresh
{
	public function handle(Sponsors $sponsors, array $maintainers)
	{
		$updatedSponsors = collect($maintainers)
			->flatMap(fn($username) => $this->fetchGithubSponsors($username))->filter()
			->map(fn($sponsorship) => $this->mapGithubSponsorship($sponsorship));

		$sponsors->set($updatedSponsors)->save();
	}

	protected function fetchGithubSponsors($username)
	{
		$query = <<< QUERY
			query {
				user(login:"{$username}") {
					sponsorshipsAsMaintainer(first:100) {
						nodes {
							createdAt, id, privacyLevel,
							sponsor {
								id, login, name, avatarUrl, url
							},
							tier {
								id, name
							}
						}
					}
				}
			}
		QUERY;

		return app(GitHubManager::class)->api('graphql')->execute($query)['data']['user']['sponsorshipsAsMaintainer']['nodes'];
	}

	protected function mapGithubSponsorship($sponsorship)
	{
		return [
			'userName'  => $sponsorship['sponsor']['login'],
			'fullName'  => $sponsorship['sponsor']['name'],
			'avatarUrl' => $sponsorship['sponsor']['avatarUrl'],
			'url'       => $sponsorship['sponsor']['url'],
			'githubId'  => $sponsorship['sponsor']['id'],
			'tier'      => $sponsorship['tier']['name'],
			'since'     => $sponsorship['createdAt']
		];
	}
}
