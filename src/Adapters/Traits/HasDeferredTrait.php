<?php

namespace Nip\Cache\Adapters\Traits;

use Nip\Cache\Items\CacheItem;
use Psr\Cache\CacheItemInterface;

/**
 * Trait HasDeferredTrait
 * @package Nip\Cache\Adapters\Traits
 */
trait HasDeferredTrait
{
    /**
     * @type CacheItemInterface[]|CacheItem[] deferred
     */
    protected $deferred = [];

    /**
     * {@inheritdoc}
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        if (!$item instanceof CacheItem) {
            return false;
        }
        $this->deferred[$item->getKey()] = $item;
        return true;
    }

    /**
     * Returns true if deferred item exists for given key and has not expired
     * @param string $key
     * @return bool
     */
    protected function hasDeferredItem($key)
    {
        if (isset($this->deferred[$key])) {
            return true;
        }
        return false;
    }
}
