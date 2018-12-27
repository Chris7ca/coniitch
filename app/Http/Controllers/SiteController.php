<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    
    public function index()
    {
        return view('website.index');
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
