<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\RefreshChatMembers::class,
        Commands\RefreshContributors::class,
        Commands\RefreshSponsors::class,

        Commands\Newsletter\ListSubscribers::class,
        Commands\Newsletter\Unsubscribe::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->weekly('chat:members:refresh');
        $schedule->weekly('contributors:refresh');
        $schedule->weekly('sponsors:refresh');
    }
}
