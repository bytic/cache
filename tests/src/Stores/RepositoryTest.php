<?php

namespace Nip\Cache\Tests\Stores;

use Nip\Cache\Stores\Repository;
use Nip\Cache\Tests\AbstractTest;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Class RepositoryTest
 * @package Nip\Cache\Tests\Stores
 */
class RepositoryTest extends AbstractTest
{
    public function test_get()
    {
        $store = $this->initFileStore();

        $value = $store->get('test', 'default');
        self::assertSame('default', $value);
    }

    public function test_sey()
    {
        $store = $this->initFileStore();
        $store->set('test', 'myValue');

        $store = $this->initFileStore();

        self::assertSame('myValue', $store->get('test'));
    }

    protected function initFileStore()
    {
        $adapter = new FilesystemAdapter('', 0, CACHE_PATH);
        return new Repository($adapter);
    }
}
