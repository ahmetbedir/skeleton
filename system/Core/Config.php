<?php

namespace Ahmetbedir\Skeleton\Core;

class Config
{
    public $configs = array();

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $configPath = config_path('/*');

        foreach (glob($configPath) as $configFile) {
            $path = pathinfo($configFile);

            $this->configs[$path['filename']] = include $configFile;

            $this->configs = array_merge($this->configs, array_dot($this->configs));
        }
    }

    public function get(string $name)
    {
        return array_get($this->configs, $name);
    }

}
