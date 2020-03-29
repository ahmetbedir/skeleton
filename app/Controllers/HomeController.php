<?php

namespace App\Controllers;

class HomeController
{

    public function index()
    {
        return view('home.index');
    }

    public function about()
    {
        return view('about.index');
    }

    public function contact()
    {
        echo 'contact method';
    }
}
