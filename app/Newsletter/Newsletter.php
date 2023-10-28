<?php namespace App\Newsletter;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\{DB, Validator};

class Newsletter
{
    public function all()
    {
        return DB::table('newsletter')->pluck('email')->unique();
    }
    
    public function subscribe($email)
    {
        if (Validator::make([ 'email' => $email ], [ 'email' => 'email' ])->fails()) return;
        
        DB::table('newsletter')->insert([ 'email' => Str::lower($email), 'created_at' => now() ]);
    }
    
    public function unsubscribe($email)
    {
        DB::table('newsletter')->where('email', Str::lower($email))->delete();
    }
}
