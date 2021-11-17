<?php

namespace Nip\Cache;

use ByTIC\PackageBase\BaseBootableServiceProvider;

/**
 * Class CacheServiceProvider
 * @package Nip\Cache
 *
 */
class CacheServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'cache';
    public const NAME_STORE = 'cache.store';

    public function register()
    {
        $this->registerManager();
        $this->registerDefaultStore();
    }

    protected function registerManager()
    {
        $this->getContainer()->share(static::NAME, function () {
            return new CacheManager();
        });
    }

    protected function registerDefaultStore()
    {
        $this->getContainer()->share(static::NAME_STORE, function () {
            return $this->getContainer()->get('cache')->store();
        });
    }


    /**
     * @inheritdoc
     */
    public function provides()
    {
        return [
            static::NAME,
            static::NAME_STORE,
        ];
    }
}
