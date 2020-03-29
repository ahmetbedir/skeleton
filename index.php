<?php

use Skeleton\Core\Route;

define('SKELETON_START', microtime());

error_reporting(-1);

require __DIR__ . '/vendor/autoload.php';

$app = Skeleton\Core\App::instance('app', 'Skeleton\Core\App');

$app->singleton('error_handler', function () {
    return new \Skeleton\Core\ErrorHandler();
});

$app->singleton('config', function () {
    return new \Skeleton\Core\Config();
});

$app->singleton('view', function () {
    return new \Skeleton\Core\View();
});

$app->singleton('database', function () {
    return new \Skeleton\Core\Database();
});

Route::dispatch();
