<?php namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index()
    {
        $clockworkScreenshotsPath = (new Agent)->isFirefox() ? 'images/clockwork/firefox' : 'images/clockwork/chrome';

        return view('home')->with(compact('clockworkScreenshotsPath'));
    }
}
