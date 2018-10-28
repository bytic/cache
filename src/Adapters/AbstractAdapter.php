<?php

namespace Nip\Cache\Adapters;

use InvalidArgumentException;
use Nip\Cache\Adapters\Traits\FinderTrait;
use Nip\Cache\Adapters\Traits\HasDeferredTrait;
use Nip\Cache\Adapters\Traits\HasSaveTrait;
use Nip\Cache\Items\CacheItem;
use Psr\Cache\CacheItemInterface;

/**
 * Class AbstractDriver
 * @package Nip\Cache\Drivers
 */
abstract class AbstractAdapter implements AdapterInterface
{
    use HasDeferredTrait;
    use HasSaveTrait;
    use FinderTrait;

    /**
     * @param $key
     * @param $value
     * @param $isHit
     * @return CacheItem
     */
    protected function createCacheItem($key, $value, $isHit)
    {
        $item = new CacheItem($key, $value, $isHit);
        return $item;
    }

    /**
     * Validates and normalizes a key
     *
     * @param  string $key
     * @return void
     */
    protected function normalizeKey(& $key)
    {
        $key = (string)$key;

        if ($key === '') {
            throw new InvalidArgumentException(
                "An empty key isn't allowed"
            );
        }
    }
}
