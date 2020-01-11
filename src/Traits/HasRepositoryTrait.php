<?php

namespace Nip\Cache\Traits;

use Nip\Cache\Pools;

/**
 * Trait HasRepositoryTrait
 * @package Nip\Cache\Traits
 */
trait HasRepositoryTrait
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
     * @param  string|null $name
     * @return Repository
     */
    public function store($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();
        return $this->getStore($name);
    }

    /**
     * Attempt to get the store from the local cache.
     *
     * @param  string $name
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
        $driver = $this->createDriver($name);
        $repository = new Repository($driver);
        return $repository;
    }
}