<?php

namespace Nip\Cache\Tests\CacheManager;

use FilesystemIterator;
use Nip\Cache\CacheManager;
use Nip\Cache\Tests\AbstractTest;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Class HasAdaptersTraitTest
 * @package Nip\Cache\Tests\CacheManager
 */
class HasAdaptersTraitTest extends AbstractTest
{
    public function test_createFileDriver_default_cache_path()
    {
        $manager = new CacheManager();
        $adapter = $manager->createDriver('file');
        self::assertInstanceOf(FilesystemAdapter::class, $adapter);

        $testValue = $adapter->getItem('test');
        $testValue->set(99);
        self::assertTrue($adapter->save($testValue));

        $fi = new FilesystemIterator(CACHE_PATH, FilesystemIterator::SKIP_DOTS);
        self::assertGreaterThan(1, iterator_count($fi));
    }
}
