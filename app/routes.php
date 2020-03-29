<?php

use Skeleton\Core\Route;

Route::get('/', 'PageController@index');

Route::get('about', 'PageController@about');

Route::get('contact', 'PageController@contact');

Route::get('test', function () {
    return 'test echo';
});
