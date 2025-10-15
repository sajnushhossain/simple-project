<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
