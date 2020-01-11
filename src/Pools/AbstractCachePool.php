<?php

namespace Nip\Cache\Pools;

use \Psr\Cache\CacheItemPoolInterface;

/**
 * Class AbstractCachePool
 * @package Nip\Cache\Pools
 */
abstract class AbstractCachePool implements CacheItemPoolInterface
{
    /**
     * The constructor takes a Driver class which is used for persistent
     * storage. If no driver is provided then the Ephemeral driver is used by
     * default.
     *
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver = null)
    {
        if (isset($driver)) {
            $this->setDriver($driver);
        } else {
            $this->driver = new Ephemeral();
        }
    }
}
