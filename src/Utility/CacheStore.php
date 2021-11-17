<?php

namespace Nip\Cache\Utility;

use ByTIC\PackageBase\Utility\AbstractFacade;
use Nip\Cache\CacheServiceProvider;

/**
 * Class CacheStore
 * @package Nip\Cache\Utility
 */
class CacheStore extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return CacheServiceProvider::NAME_STORE;
    }
}
