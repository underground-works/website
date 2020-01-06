<?php namespace App\Console\Commands;

use App\Contributors\Contributors;

use Illuminate\Console\Command;

class RefreshContributors extends Command
{
	protected $signature = 'contributors:refresh';

	protected $description = 'Refreshes contributors list from GitHub.';

	public function handle()
	{
		app(Contributors::class)->refresh();
	}
}
