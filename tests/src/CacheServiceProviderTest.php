<?php

namespace Nip\Cache\Tests;

use Nip\Cache\CacheManager;
use Nip\Cache\CacheServiceProvider;
use Nip\Cache\Stores\Repository;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Class FilesystemServiceProviderTest
 * @package Nip\Filesystem\Tests
 */
class CacheServiceProviderTest extends AbstractTest
{
    public function testRegister()
    {
        $provider = new CacheServiceProvider();
        $provider->initContainer();
        $provider->register();

        $filesystem = $provider->getContainer()->get('cache');
        self::assertInstanceOf(CacheManager::class, $filesystem);

        $store = $provider->getContainer()->get('cache.store');
        self::assertInstanceOf(Repository::class, $store);
    }
}
