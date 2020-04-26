<?php namespace App\Http\Controllers;

use App\Contributors\Contributors;
use App\Sponsors\Sponsors;

use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index()
    {
        $clockworkScreenshotsPath = (new Agent)->isFirefox() ? 'images/clockwork/firefox' : 'images/clockwork/chrome';

        $contributors = app(Contributors::class)->all();
        $sponsors = app(Sponsors::class)->all();

        return view('home', compact('clockworkScreenshotsPath', 'contributors', 'sponsors'));
    }
}
