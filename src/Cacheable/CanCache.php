<?php

namespace Nip\Cache\Cacheable;

use DateInterval;
use Nip\Utility\Str;

/**
 * Trait CanCache
 * @package Nip\Cache\Cacheable
 */
trait CanCache
{
    use HasCacheStore;

    protected $needsCaching = false;

    /**
     * @param null $needCaching
     * @return bool
     */
    public function needsCaching($needCaching = null): bool
    {
        if (is_bool($needCaching)) {
            $this->needsCaching = $needCaching;
        }
        return $this->needsCaching;
    }

    protected function checkSaveCache()
    {
        if ($this->needsCaching() !== true) {
            return;
        }
        $data = $this->generateCacheData();
        $this->saveDataToCache($data);
    }

    abstract public function generateCacheData();

    /**
     * @param null $key
     * @return mixed|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function getDataFromCache($key = null)
    {
        return $this->cacheStore()->get($this->dataCacheKey($key));
    }

    /**
     * @param $data
     * @param null $key
     * @noinspection PhpDocMissingThrowsInspection
     */
    protected function saveDataToCache($data, $key = null)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->cacheStore()->set($this->dataCacheKey($key), $data, $this->dataCacheTtl($key));
    }

    /**
     * @param $key
     * @return string
     */
    protected function dataCacheKey($key= null)
    {
        if ($key !== null) {
            return $key;
        }
        return Str::slug(__CLASS__);
    }

    /**
     * @param null $key
     * @return DateInterval
     */
    protected function dataCacheTtl($key= null)
    {
        return DateInterval::createFromDateString('10 years');
    }
}
