<?php

namespace App\Controllers;

class PageController
{
    public function index()
    {
        $examples = [
            "Örnek 1",
            "Örnek 2",
            "Örnek 3",
            "Örnek 4",
        ];

        return view('home.index', compact('examples'));
    }

    public function about()
    {
        return view('about.index');
    }
}
