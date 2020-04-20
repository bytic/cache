<?php

namespace Nip\Cache;

use Nip\Container\ServiceProviders\Providers\AbstractServiceProvider;

/**
 * Class CacheServiceProvider
 * @package Nip\Cache
 *
 */
class CacheServiceProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->registerManager();
        $this->registerDefaultStore();
    }

    protected function registerManager()
    {
        $this->getContainer()->share('cache', function () {
            return new CacheManager();
        });
    }

    protected function registerDefaultStore()
    {
        $this->getContainer()->share('cache.store', function () {
            return $this->getContainer()->get('cache')->store();
        });
    }


    /**
     * @inheritdoc
     */
    public function provides()
    {
        return [
            'cache',
            'cache.store',
        ];
    }
}
