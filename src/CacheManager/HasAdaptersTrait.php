<?php

namespace Nip\Cache\CacheManager;

use InvalidArgumentException;
use Nip\Cache\Adapters\FileAdapter\FileAdapter;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Trait HasDriversTrait
 * @package Nip\Cache\Traits
 */
trait HasAdaptersTrait
{
    /**
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'file';
    }

    /**
     * @param $name
     * @param $config
     * @return AbstractAdapter
     */
    public function createDriver($name, $config = [])
    {
        $driverMethod = 'create' . ucfirst($name) . 'Driver';
        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        } else {
            throw new InvalidArgumentException("Driver [{$name}] is not supported.");
        }
    }

    /**
     * Create an instance of the php file cache driver.
     *
     * @param array $config
     * @return FilesystemAdapter
     */
    protected function createFileDriver(array $config)
    {
        $namespace = '';
        $defaultLifetime = 0;
        $directory = isset($config['path']) ? $config['path'] : cache_path();

        return new FilesystemAdapter($namespace, $defaultLifetime, $directory);
    }
}
