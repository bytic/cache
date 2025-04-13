<?php
declare(strict_types=1);

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

    protected ?CacheData $data = null;
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
    public function getData(): ?CacheData
    {
        $this->checkInitData();
        return $this->data;
    }

    protected function checkInitData()
    {
        if ($this->data !== null) {
            return;
        }
        $cacheStore = $this->cacheStore();
        if ($cacheStore->has($this->cacheName())) {
            $this->data = $cacheStore->get($this->cacheName());
        } else {
            $this->data = new CacheData();
            if (method_exists($this, 'generateCacheData')) {
                $data = $this->generateCacheData();
                $this->setDataToCache($data);
            }
            $this->saveDataToCache();
        }
    }

    protected function checkSaveCache()
    {
        if ($this->needsCaching() !== true) {
            return;
        }
        $data = $this->getData();
        $this->saveDataToCache($data);
    }

    /**
     * @param null $key
     * @return mixed|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function getDataFromCache($key = null, $default = null)
    {
        $key = $this->dataCacheKey($key);
        if ($this->getData()->offsetExists($key)) {
            return $this->getData()->get($key);
        }
        $value = $this->generateCacheDataKey($key, $default);
        $this->setDataToCache($value, $key);
        return $value;
    }

    /**
     * @param $data
     * @param $key
     * @return $this
     */
    protected function setDataToCache($data, $key = null)
    {
        $key = $this->dataCacheKey($key);
        $this->getData()->set($data, $key);
        $this->needsCaching(true);
        return $this;
    }

    /**
     * @param $data
     * @param null $key
     * @noinspection PhpDocMissingThrowsInspection
     */
    protected function saveDataToCache($data = null, $key = null)
    {
        if ($data) {
            $this->setDataToCache($data, $key);
        }
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->cacheStore()->set($this->cacheName(), $this->getData(), $this->dataCacheTtl($key));
        $this->needsCaching(false);
    }

    /**
     * @param $key
     * @return string
     */
    protected function dataCacheKey($key = null): string
    {
        if ($key !== null) {
            return $key;
        }
        return CacheData::DEFAULT_KEY;
    }

    protected function cacheName(): string
    {
        return Str::slug(__CLASS__);
    }

    /**
     * @param null $key
     * @return DateInterval
     */
    protected function dataCacheTtl($key = null)
    {
        return DateInterval::createFromDateString('10 years');
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed|null
     */
    protected function generateCacheDataKey(string $key, mixed $default = null)
    {
        return $default;
    }

    public function __destruct()
    {
        $this->checkSaveCache();
    }
}
