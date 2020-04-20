<?php

namespace Nip\Cache\Tests;

use FilesystemIterator;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{
    protected $object;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cleanupCacheDir();
    }

    protected function cleanupCacheDir()
    {
        $dir = CACHE_PATH;

        $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($ri as $file) {
            if ($file->getFilename() == '.gitignore') {
                continue;
            }
            $file->isDir() ? rmdir($file) : unlink($file);
        }
    }
}
