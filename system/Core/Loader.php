<?php

namespace Ahmetbedir\Skeleton\Core;

/**
 * File Load Manager
 */
class Loader
{

    protected static $allConfig = null;

    public static function register()
    {
        self::loadConfig();
    }

    private static function loadHelper()
    {
        foreach (glob(HELPERS_PATH . "/*") as $helper) {
            require $helper;
        }
    }

    private static function loadConfig()
    {
        $allConfigs = [];

        foreach (glob(CONFIG_PATH . '/*') as $configFile) {
            $path = pathinfo($configFile);

            $configs[$path['filename']] = include $configFile;

            $allConfigs = array_merge($allConfigs, array_dot($configs));

        }

        $GLOBALS["allConfig"] = self::$allConfig = $allConfigs;
    }
    // private static function loadSystem()
    // {
    //     spl_autoload_register(function ($className) {
    //         $path = CORE_PATH . '/' . $className . '.php';
    //         if (file_exists($path)) {
    //             include $path;
    //         }
    //     });
    // }

    public static function config($config = null)
    {
        return array_get(self::$allConfig, $config);
    }
}
