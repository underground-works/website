<?php namespace App\Console\Commands\Newsletter;

use App\Newsletter\Newsletter;

use Illuminate\Console\Command;

class ListSubscribers extends Command
{
    protected $signature = 'newsletter:list';

    protected $description = 'Lists newsletter subscribers.';

    public function handle()
    {
        $subscribers = app(Newsletter::class)->all();
        
        $subscribers->each(fn($email) => $this->line($email));
        
        $this->line('---');
        
        $this->line($subscribers->count() . ' total subscribers.');
    }
}
