<?php namespace App\Http\Controllers;

use App\Newsletter\Newsletter;

use Illuminate\Http\Request; 

class NewsletterController extends Controller
{
    public function store(Newsletter $newsletter, Request $request)
    {
        $newsletter->subscribe($request->email);
        
        return response()->noContent();
    }
}
