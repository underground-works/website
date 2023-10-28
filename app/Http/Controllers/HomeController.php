<?php namespace App\Http\Controllers;

use App\Blog\Blog;
use App\Chat\{ Chatheads, Members };
use App\Contributors\Contributors;
use App\Sponsors\Sponsors;

class HomeController extends Controller
{
    public function index()
    {
        $chatheads = Chatheads::make(app(Members::class)->all())->generate();
        $contributors = app(Contributors::class)->all();
        $latestBlog = app(Blog::class)->latest();
        $sponsors = app(Sponsors::class)->all();

        return view('home', compact('chatheads', 'contributors', 'latestBlog', 'sponsors'));
    }
}
