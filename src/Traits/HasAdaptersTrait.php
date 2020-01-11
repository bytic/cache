<?php

namespace Nip\Cache\Traits;

use InvalidArgumentException;
use Nip\Cache\Adapters\FileAdapter\FileAdapter;

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
     * @return mixed
     */
    public function createDriver($name, $config = [])
    {
        $driverMethod = 'create' . ucfirst($name) . 'Driver';
        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        } else {
            throw new InvalidArgumentException("Driver [{$config['driver']}] is not supported.");
        }
    }

    /**
     * Create an instance of the php file cache driver.
     *
     * @param  array $config
     * @return FileAdapter
     */
    protected function createPhpFileDriver(array $config)
    {
        return new FileAdapter();
    }
}
