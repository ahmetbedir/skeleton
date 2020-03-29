<?php

use Ahmetbedir\Skeleton\Core\Route;

Route::get('/', 'PageController@index');

Route::get('about', 'PageController@about');

Route::get('contact', 'PageController@contact');
