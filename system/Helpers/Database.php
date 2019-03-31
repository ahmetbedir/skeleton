<?php 

// return;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$defaultConfig = 'database.connections.'. Loader::config('database.default');

$capsule->addConnection([
    'driver'    => Loader::config('database.default'),
    'host'      => Loader::config($defaultConfig."host"),
    'username'  => Loader::config($defaultConfig."username"),
    'password'  => Loader::config($defaultConfig."password"),
    'database'  => Loader::config($defaultConfig."database"),
    'charset'   => Loader::config($defaultConfig."charset"), 
    'collation' => Loader::config($defaultConfig."collation"),
    'prefix'    => Loader::config($defaultConfig."prefix"),
]);

/*$capsule->addConnection([
    'driver'    => config('database.default'),
    'host'      => "127.0.0.1",
    'username'  => "ahmetbedir",
    'password'  => "",
    'database'  => "yemeksepeti",
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);*/

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();