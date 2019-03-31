<?php

Route::get('/', 'HomeController@index');

Route::get('about/{par}', 'HomeController@about');
Route::get('contact', 'HomeController@contact');
Route::get('test', 'TestController@index');
