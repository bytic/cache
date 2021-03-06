<?php

if (!function_exists('cache_path')) {
    /**
     * @param null $path
     * @return string
     */
    function cache_path($path = null)
    {
        $base = '/tmp';

        if (defined('CACHE_PATH')) {
            $base = CACHE_PATH;
        }

        if (function_exists('app') && app()->has('path.storage')) {
            $base = app('path.storage') . DIRECTORY_SEPARATOR . 'cache';
        }

        return $base . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}


if (!function_exists('cache')) {
    /**
     * @return \Nip\Cache\Manager
     */
    function cache()
    {
        if (function_exists('app')) {
//            $base = app('cache') . DIRECTORY_SEPARATOR . 'cache';
        }

        return \Nip\Cache\Manager::instance();
    }
}
