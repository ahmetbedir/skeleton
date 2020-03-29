<?php

namespace Ahmetbedir\Skeleton\Core;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class Database
{
    protected $capsule;
    protected $defaultConfig;

    public function __constructor()
    {
        $this->capsule = new Capsule();
        $this->defaultConfig = 'database.connections.' . Loader::config('database.default');

        $this->connection();
    }
    protected function connection()
    {
        $this->capsule->addConnection([
            'driver' => Loader::config('database.default'),
            'host' => Loader::config($this->defaultConfig . "host"),
            'username' => Loader::config($this->defaultConfig . "username"),
            'password' => Loader::config($this->defaultConfig . "password"),
            'database' => Loader::config($this->defaultConfig . "database"),
            'charset' => Loader::config($this->defaultConfig . "charset"),
            'collation' => Loader::config($this->defaultConfig . "collation"),
            'prefix' => Loader::config($this->defaultConfig . "prefix"),
        ]);

        $this->dispatch();
    }

    protected function dispatch()
    {
        $this->capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
    }
}
