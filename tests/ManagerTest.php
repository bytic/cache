<?php

namespace Nip\Cache\Tests;

use Nip\Cache\Manager;

/**
 * Class ManagerTest
 * @package Nip\Cache\Tests
 */
class ManagerTest extends AbstractTest
{
    public function testCachePath()
    {
        $manager = new Manager();
        self::assertSame('/tmp', $manager->cachePath());
    }
}