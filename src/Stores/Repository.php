<?php

namespace Nip\Cache\Stores;

use Closure;
use Symfony\Component\Cache\Psr16Cache;

/**
 * Class Repository
 * @package Nip\Cache\Stores
 */
class Repository extends Psr16Cache
{

    /**
     * Get an item from the cache, or execute the given Closure and store the result.
     *
     * @param  string  $key
     * @param  \DateTimeInterface|\DateInterval|int|null  $ttl
     * @param  \Closure  $callback
     * @return mixed
     */
    public function remember($key, $ttl, Closure $callback)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        $this->set($key, $value = $callback(), $ttl);

        return $value;
    }
}
