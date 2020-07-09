<?php

namespace Nip\Cache\Tests\Cacheable;

use Nip\Cache\Stores\Repository;
use Nip\Cache\Tests\AbstractTest;
use Nip\Cache\Tests\Fixtures\App\Cacheable\HasCacheStoreObject;

/**
 * Class HasCacheStoreTest
 * @package Nip\Cache\Tests\Cacheable
 */
class HasCacheStoreTest extends AbstractTest
{
    public function test_cacheStore_returns_in_memory()
    {
        $object = new HasCacheStoreObject();
        $store = $object->getCacheStore();

        self::assertInstanceOf(Repository::class, $store);
    }
}
