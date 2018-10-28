<?php

namespace Nip\Cache\Adapters\Traits;

use Nip\Cache\Items\CacheItem;
use Nip\Cache\Items\CacheItemFactory;

/**
 * Trait FinderTrait
 * @package Nip\Cache\Adapters\Traits
 */
trait FinderTrait
{
    /**
     * {@inheritdoc}
     */
    public function getItem($key)
    {
        $this->normalizeKey($key);
        if (isset($this->deferred[$key])) {
            /** @type CacheItem $item */
            $item = clone $this->deferred[$key];
            return $item;
        }

        $return = $this->fetchObjectFromCache($key);
        return CacheItemFactory::create($key, $return);
    }

    /**
     * Fetches several cache items.
     *
     * @param array $ids The cache identifiers to fetch
     *
     * @return array|\Traversable The corresponding values found in the cache
     */
    abstract protected function doFetch(array $ids);

    /**
     * @inheritdoc
     */
    public function getItems(array $keys = [])
    {
        $items = [];
        foreach ($keys as $key) {
            $items[$key] = $this->getItem($key);
        }
        return $items;
    }
}
