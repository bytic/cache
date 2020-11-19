<?php

namespace Nip\Cache\Tests\Fixtures\App\Cacheable;

use Nip\Cache\Cacheable\HasCacheStore;

/**
 * Class HasCacheStoreObject
 * @package Nip\Cache\Tests\Fixtures\App\Cacheable
 */
class HasCacheStoreObject
{
    use HasCacheStore;

    /**
     * @return \Nip\Cache\Stores\Repository
     */
    public function getCacheStore()
    {
        return $this->cacheStore();
    }
}
