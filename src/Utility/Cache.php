<?php

namespace Nip\Cache\Utility;

use ByTIC\PackageBase\Utility\AbstractFacade;
use Nip\Cache\CacheServiceProvider;
use Nip\Cache\Stores\Repository;

/**
 * Class Cache
 * @package Nip\Cache\Utility
 *
 * @method static Repository store($name = null)
 */
class Cache extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return CacheServiceProvider::NAME;
    }
}
