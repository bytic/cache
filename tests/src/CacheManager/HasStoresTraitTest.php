<?php

namespace Nip\Cache\Tests\CacheManager;

use Mockery\Mock;
use Nip\Cache\CacheManager;
use Nip\Cache\Stores\Repository;
use Nip\Cache\Tests\AbstractTest;

/**
 * Class HasStoresTraitTest
 * @package Nip\Cache\Tests\CacheManager
 */
class HasStoresTraitTest extends AbstractTest
{
    public function test_store_default_no_name()
    {
        /** @var Mock|CacheManager $manager */
        $manager = \Mockery::mock(CacheManager::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $manager->shouldReceive('getDefaultStore')->andReturn('default_value');
        $manager->shouldReceive('getStore')->with('default_value')->andReturn(true);

        self::assertTrue($manager->store(null));
        self::assertTrue($manager->store(0));
        self::assertTrue($manager->store(''));
    }

    public function test_store_file_no_config()
    {
        /** @var Mock|CacheManager $manager */
        $manager = \Mockery::mock(CacheManager::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $manager->shouldReceive('getConfig')->andReturnUsing(function ($name, $default) {
            return $default;
        });

        $store = $manager->store();
        self::assertInstanceOf(Repository::class, $store);
    }
}
