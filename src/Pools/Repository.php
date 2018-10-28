<?php

namespace Nip\Cache\Pools;

use Nip\Cache\Adapters\AbstractAdapter;

/**
 * Class Repository
 * @package Nip\Cache
 */
class Repository
{
    /**
     * @var AbstractAdapter
     */
    protected $driver;

    /**
     * Repository constructor.
     * @param AbstractAdapter $driver
     */
    public function __construct(AbstractAdapter $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = $this->driver->get($this->itemKey($key));
        // If we could not find the cache value, we will fire the missed event and get
        // the default value for this cache value. This default could be a callback
        // so we will execute the value function which will resolve it if needed.
        if (is_null($value)) {
            $this->event(new CacheMissed($key));
            $value = value($default);
        } else {
            $this->event(new CacheHit($key, $value));
        }
        return $value;
    }

    /**
     * Format the key for a cache item.
     *
     * @param  string $key
     * @return string
     */
    protected function itemKey($key)
    {
        return $key;
    }
}