<?php

namespace Skeleton\Core;

use Illuminate\Support\Arr;

class Config
{
    public $configs = array();

    public function __construct()
    {
        $configPath = config_path('/*');

        foreach (glob($configPath) as $configFile) {
            $path = pathinfo($configFile);

            $this->configs[$path['filename']] = include $configFile;

            $this->configs = array_merge($this->configs, Arr::dot($this->configs));
        }
    }

    public function get(string $name)
    {
        return Arr::get($this->configs, $name);
    }

}
