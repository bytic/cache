<?php

namespace Nip\Cache\Cacheable;

use League\Container\Exception\NotFoundException;
use Nip\Cache\Stores\Repository;
use Nip\Container\Container;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

/**
 * Trait HasCacheStore
 * @package Nip\Cache\Cacheable
 */
trait HasCacheStore
{
    protected $cacheStore = null;

    /**
     * @return Repository
     */
    protected function cacheStore()
    {
        if ($this->cacheStore === null) {
            $this->cacheStore = $this->generateCacheStore();
        }
        return $this->cacheStore;
    }

    /**
     * @return Repository
     */
    protected function generateCacheStore()
    {
        try {
            return $this->generateCacheStoreFromContainer();
        } catch (NotFoundException $exception) {
            return $this->generateCacheStoreInMemory();
        }
    }

    /**
     * @return Repository
     */
    protected function generateCacheStoreInMemory()
    {
        $adapter = new ArrayAdapter();
        $store = new Repository($adapter);
        return $store;
    }

    /**
     * @return Repository
     * @throws NotFoundException
     */
    protected function generateCacheStoreFromContainer()
    {
        if (function_exists('app')) {
            return app('cache.store');
        }

        return Container::getInstance()->get('cache.store');
    }
}
