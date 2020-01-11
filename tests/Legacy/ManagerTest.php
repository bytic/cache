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
    public function test_cachePath()
    {
        $manager = new Manager();
        self::assertSame('/tmp', $manager->cachePath());
    }

    public function test_filePath()
    {
        $manager = new Manager();
        $manager->cachePath();
        self::assertSame('/tmp' . DIRECTORY_SEPARATOR . 'test.php', $manager->filePath('test'));
    }
}
