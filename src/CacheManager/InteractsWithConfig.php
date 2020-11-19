<?php

namespace Nip\Cache\CacheManager;

/**
 * Trait InteractsWithConfig
 * @package Nip\Cache\CacheManager
 */
trait InteractsWithConfig
{
    /**
     * @param $name
     * @param null $default
     * @return array|null
     */
    protected function getConfigStore($name, $default = null)
    {
        return $this->getConfig('stores.' . $name, $default = null);
    }

    /**
     * Get the filesystem connection configuration.
     *
     * @param string $name
     * @param null $default
     * @return array
     */
    protected function getConfig($name, $default = null)
    {
        if (!function_exists('config') || !function_exists('app')) {
            return $default;
        }
        try {
            $config = config();
        } catch (\Exception $e) {
            return $default;
        }
        $configName = "cache.{$name}";
        if (!$config->has($configName)) {
            return $default;
        }

        return $config->get($configName)->toArray();
    }
}
