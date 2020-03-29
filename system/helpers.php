<?php

if (!function_exists('view')) {
    function view($path, $data = [], $cache = false)
    {
        return (Ahmetbedir\Skeleton\Core\View::make($path, $data, $cache))->render();
    }
}

if (!function_exists('config')) {
    function config($name = null)
    {
        return Ahmetbedir\Skeleton\Core\Config::get($name);
    }
}

/**
 * Boş olan dizi anahtarlarını temizler
 */
if (!function_exists('array_key_filter')) {
    function array_key_filter($array = [])
    {
        if (count($array)) {
            foreach ($array as $key => &$value) {
                if (is_null($key) && $key != '') {
                    unset($array[$key]);
                }
            }
        }

        return $array;
    }
}

if (!function_exists('config_path')) {
    function config_path($path = null)
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/config/' . ltrim($path, '/');
    }
}

if (!function_exists('view_path')) {
    function view_path($path = null)
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/app/Views/' . ltrim($path, '/');
    }
}

if (!function_exists('system_path')) {
    function system_path($path = null)
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/system/' . ltrim($path, '/');
    }
}
