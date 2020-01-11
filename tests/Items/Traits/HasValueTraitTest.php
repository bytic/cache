<?php

namespace Nip\Cache\Tests\Items\Traits;

use Nip\Cache\Items\CacheItem;
use Nip\Cache\Tests\AbstractTest;

/**
 * Class HasValueTraitTest
 * @package Nip\Cache\Tests\Items\Traits
 */
class HasValueTraitTest extends AbstractTest
{
    public function testGetValueForClosures()
    {
        $item = new CacheItem('test');
        $item->set(function () {
            return 5;
        });

        self::assertSame(5, $item->get());
    }
}
