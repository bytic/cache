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
        self::assertSame(CACHE_PATH, $manager->cachePath());
    }

    public function test_filePath()
    {
        $manager = new Manager();
        $manager->cachePath();
        self::assertSame(CACHE_PATH . DIRECTORY_SEPARATOR . 'test.php', $manager->filePath('test'));
    }

    public function test_put()
    {
        $manager = new Manager();
        $data = [1, 2];
        $manager->put('test-save', $data);
        self::assertFileExists(CACHE_PATH . DIRECTORY_SEPARATOR . 'test-save.php');

        $manager = new Manager();
        $manager->setActive(true);
        self::assertSame($data, $manager->get('test-save'));

        unlink(CACHE_PATH . DIRECTORY_SEPARATOR . 'test-save.php');
    }

    public function test_saveData()
    {
        $manager = new Manager();
        $data = [1, 2];
        $manager->saveData('test-save', $data);
        self::assertFileExists(CACHE_PATH . DIRECTORY_SEPARATOR . 'test-save.php');

        $manager = new Manager();
        $manager->setActive(true);
        self::assertSame($data, $manager->get('test-save'));

        unlink(CACHE_PATH . DIRECTORY_SEPARATOR . 'test-save.php');
    }
}
