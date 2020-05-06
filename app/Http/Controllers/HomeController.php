<?php namespace App\Http\Controllers;

use App\Chat\{ Chatheads, Members };
use App\Contributors\Contributors;
use App\Sponsors\Sponsors;

use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index()
    {
        $clockworkScreenshotsPath = (new Agent)->isFirefox() ? 'images/clockwork/firefox' : 'images/clockwork/chrome';

        $chatheads = Chatheads::make(app(Members::class)->all())->generate();
        $contributors = app(Contributors::class)->all();
        $sponsors = app(Sponsors::class)->all();

        return view('home', compact('clockworkScreenshotsPath', 'chatheads', 'contributors', 'sponsors'));
    }
}
