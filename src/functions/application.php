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

        if (function_exists('app')) {
            $base = app('path.storage') . DIRECTORY_SEPARATOR . 'cache';
        }

        return $base . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
