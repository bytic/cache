<?php

namespace Nip\Cache\Adapters\Traits;

use InvalidArgumentException;
use Nip\Cache\Items\CacheItem;
use Psr\Cache\CacheItemInterface;

/**
 * Trait HasSaveTrait
 * @package Nip\Cache\Adapters\Traits
 */
trait HasSaveTrait
{

    /**
     * {@inheritdoc}
     */
    public function save(CacheItemInterface $item)
    {
        if (!$item instanceof CacheItem) {
            throw new InvalidArgumentException('Cache item MUST be an instance CacheItem.');
        }
        return $this->storeItemInCache($item);
    }

    /**
     * @param CacheItem $item
     * @return bool true if saved
     */
    abstract protected function storeItemInCache(CacheItem $item);
}
