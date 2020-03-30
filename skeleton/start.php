<?php

define('SKELETON_START', microtime());

error_reporting(-1);

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

Skeleton\Core\Route::dispatch();
