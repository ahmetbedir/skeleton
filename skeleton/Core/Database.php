<?php

namespace Skeleton\Core;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Skeleton\Core\Config;

class Database
{
    protected $capsule;
    protected $defaultDatabase;

    public function __construct()
    {
        $this->capsule = new Capsule();

        $this->defaultDriver = config('database.default');

        $this->config = config('database.connections.' . $this->defaultDriver);

        $this->connection();
    }

    protected function connection()
    {
        $this->capsule->addConnection([
            'driver' => $this->defaultDriver, //Loader::config('database.default'),
            'host' => $this->config['host'], //Loader::config($this->defaultConfig . "host"),
            'username' => $this->config['username'], //Loader::config($this->defaultConfig . "username"),
            'password' => $this->config['password'], //Loader::config($this->defaultConfig . "password"),
            'database' => $this->config['database'], //Loader::config($this->defaultConfig . "database"),
            'charset' => $this->config['charset'], //Loader::config($this->defaultConfig . "charset"),
            'collation' => $this->config['collation'], //Loader::config($this->defaultConfig . "collation"),
            'prefix' => $this->config['prefix'], //Loader::config($this->defaultConfig . "prefix"),
        ]);

        $this->dispatch();
    }

    protected function dispatch()
    {
        $this->capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
    }
}
