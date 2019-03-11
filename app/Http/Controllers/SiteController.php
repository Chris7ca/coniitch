<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','verified','hasProfiles'])->only('app');
    }
    
    public function app()
    {
        return view('app.index');
    }

    public function index()
    {
        $sponsors = Sponsor::all();

        return view('website.index', compact('sponsors'));
    }

    public function contact() 
    {
        return view('website.contact');
    }

    public function call()
    {
        return view('website.call');
    }

    public function pricing()
    {
        return view('website.pricing');
    }

    public function directory()
    {
        return view('website.directory');
    }

    public function aboutus()
    {
        return view('website.aboutus');
    }

    public function privacy() 
    {
        return view('website.privacy');
    }

    public function programme()
    {
        return view('website.programme');
    }

    public function terms()
    {
        return view('website.terms');
    }

}
