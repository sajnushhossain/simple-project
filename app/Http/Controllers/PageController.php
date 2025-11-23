<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('about', ['posts' => []]);
    }

    public function contact()
    {
        return view('contact', ['posts' => []]);
    }
}
