<?php

Route::get('/', 'HomeController@index');

Route::get('about', 'HomeController@about');
Route::get('contact', 'HomeController@contact');
Route::get('test', 'TestController@index');