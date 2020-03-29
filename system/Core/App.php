<?php

namespace Ahmetbedir\Skeleton\Core;

/**
 * Application Manager
 */
class App
{
    public $app = array();

    public function __construct()
    {
        $this->singleton('view', function () {
            return new \Ahmetbedir\Skeleton\Core\View;
        });
    }

    public function singleton($name, \Closure $closure)
    {
        if (is_callable($closure)) {
            $this->app[$name] = $closure();
        }
    }

    public function __destruct()
    {

        Route::dispatch();
    }
}
