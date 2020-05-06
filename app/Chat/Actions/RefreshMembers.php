<?php namespace App\Chat\Actions;

use RestCord\DiscordClient;

use App\Chat\Members;

class RefreshMembers
{
	protected $roles;

	public function handle(Members $members)
	{
		$this->loadRoles();

		$updatedMembers = collect($this->fetchDiscordMembers())
			->filter(fn($member) => ! $member->user->bot)
			->map(fn($member) => $this->mapDiscordMember($member));

		$members->set($updatedMembers)->save();
	}

	protected function fetchDiscordMembers()
	{
		$discord = new DiscordClient([ 'token' => config('services.discord.token') ]);

		return $discord->guild->listGuildMembers([
			'guild.id' => (int) config('services.discord.guild-id'),
			'limit'    => 1000
		]);
	}

	protected function mapDiscordMember($member)
	{
		return [
			'userName'  => $member->user->username,
			'avatarUrl' => $member->user->avatar
				? "https://cdn.discordapp.com/avatars/{$member->user->id}/{$member->user->avatar}.jpeg" : null,
			'discordId' => $member->user->id,
			'joinedAt'  => $member->joined_at->format('c'),
			'roles'     => collect($member->roles)->map(fn($roleId) => $this->roles[$roleId])
		];
	}

	protected function loadRoles()
	{
		$discord = new DiscordClient([ 'token' => config('services.discord.token') ]);

		$roles = $discord->guild->getGuildRoles([
			'guild.id' => (int) config('services.discord.guild-id'),
			'limit'    => 1000
		]);

		$this->roles = collect($roles)->mapWithKeys(fn($role) => [ $role->id => $role->name ]);
	}
}
