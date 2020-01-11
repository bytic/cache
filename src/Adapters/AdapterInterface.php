<?php

namespace Nip\Cache\Adapters;

/**
 * Interface DriverInterface
 * @package Nip\Cache\Drivers
 */
interface AdapterInterface
{
    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string|array  $key
     * @return mixed
     */
    public function get($key);

}