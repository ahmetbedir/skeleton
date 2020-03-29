<?php

namespace Skeleton\Core;

use Closure;
use Exception;

class Container
{
    private static $instance = array();
    protected $bindings = array();

    public function singleton($name, \Closure $closure)
    {
        if (is_callable($closure)) {
            if (isset($this->bindings[$name])) {
                return $this->bindings[$name];
            }

            return $this->bindings[$name] = $closure();
        }
    }

    public static function instance(string $name, ?string $class = null)
    {
        if (!is_null($class) && !isset(self::$instance[$name])) {
            self::$instance[$name] = new $class();
        }

        return self::$instance[$name];
    }

    public function bound($name)
    {
        return isset($this->bindings[$name]);
    }

    public function make($name)
    {
        if (!$this->bound($name)) {
            throw new Exception("Belirtilen nesne bulunamadı!");
        }

        return $this->bindings[$name];
    }
}
