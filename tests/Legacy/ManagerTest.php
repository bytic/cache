<?php

namespace Nip\Cache\Tests\Legacy;

use Nip\Cache\Manager;
use Nip\Cache\Tests\AbstractTest;

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

    public function testSet()
    {
        $manager = new Manager();
        $manager->cachePath();
        self::assertSame('/tmp\test.php', $manager->filePath('test'));
    }
}
