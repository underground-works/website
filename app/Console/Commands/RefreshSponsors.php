<?php namespace App\Console\Commands;

use App\Sponsors\Sponsors;

use Illuminate\Console\Command;

class RefreshSponsors extends Command
{
	protected $signature = 'sponsors:refresh';

	protected $description = 'Refreshes sponsors list from GitHub.';

	public function handle()
	{
		app(Sponsors::class)->refresh();
	}
}
