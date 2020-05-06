<?php namespace App\Console\Commands;

use App\Chat\Members;

use Illuminate\Console\Command;

class RefreshChatMembers extends Command
{
	protected $signature = 'chat:members:refresh';

	protected $description = 'Refreshes chat members list from Discord.';

	public function handle()
	{
		app(Members::class)->refresh();
	}
}
