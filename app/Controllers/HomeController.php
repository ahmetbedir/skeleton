<?php

namespace App\Controllers;

use \DB;
use \View;

class HomeController {
    
    function index(){       
        // view("home.index", compact('desc'));
        
        // dd(DB::table('users')->where("name",'IN', ['ahmet','ahmetbedir'])->run());
        
        //return View::make('home.index', compact('desc'));
        
        return view('home.index');
    }
    
    function about(){
        return view('about.index');
    }
    
    function contact(){
        echo 'contact method';
    }
}