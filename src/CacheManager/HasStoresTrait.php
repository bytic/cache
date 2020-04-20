<?php

namespace Nip\Cache\CacheManager;

use InvalidArgumentException;
use Nip\Cache\Stores\Repository;

/**
 * Trait HasRepositoryTrait
 * @package Nip\Cache\Traits
 */
trait HasStoresTrait
{
    /**
     * The array of resolved cache stores.
     *
     * @var array
     */
    protected $stores = [];

    /**
     * Get a cache store instance by name.
     *
     * @param string|null $name
     * @return Repository
     */
    public function store($name = null)
    {
        $name = $name ?: $this->getDefaultStore();
        return $this->getStore($name);
    }

    /**
     * Get the default cache driver name.
     *
     * @return string
     */
    public function getDefaultStore()
    {
        return $this->getConfig('default', 'file');
    }

    /**
     * Attempt to get the store from the local cache.
     *
     * @param string $name
     * @return Repository
     */
    protected function getStore($name)
    {
        $this->stores[$name] = $this->stores[$name] ?? $this->resolve($name);
        return $this->stores[$name];
    }

    /**
     * @param $name
     * @return Repository
     */
    protected function resolve($name)
    {
        $config = $this->getConfigStore($name);

        if (is_null($config)) {
            if ($name == 'file') {
                $config = ['driver' => 'file'];
            } else {
                throw new InvalidArgumentException("Cache store [{$name}] is not defined.");
            }
        }

        return $this->repository(
            $this->createDriver($config['driver'], $config)
        );
    }

    /**
     * @param $driver
     * @return Repository
     */
    protected function repository($driver)
    {
        return new Repository($driver);
    }
}
