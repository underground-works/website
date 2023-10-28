<?php namespace App\Console\Commands\Newsletter;

use App\Newsletter\Newsletter;

use Illuminate\Console\Command;

class Unsubscribe extends Command
{
    protected $signature = 'newsletter:unsubscribe {email}';

    protected $description = 'Lists newsletter subscribers.';

    public function handle()
    {
        app(Newsletter::class)->unsubscribe($this->argument('email'));
    }
}
