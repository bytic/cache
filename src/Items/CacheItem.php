<?php

namespace Nip\Cache\Items;

use Nip\Cache\Items\Traits\HasExpirationTrait;
use Nip\Cache\Items\Traits\HasValueTrait;
use Psr\Cache\CacheItemInterface;

/**
 * Class CacheItem
 * @package Nip\Cache
 */
class CacheItem implements CacheItemInterface
{
    use HasExpirationTrait;
    use HasValueTrait;


    protected $key;
    protected $isHit;

    /**
     * CacheItem constructor.
     * @param $key
     * @param null $value
     * @param bool $isHit
     */
    public function __construct($key, $value = null, bool $isHit = false)
    {
        $this->key = $key;
        $this->value = $value;
        $this->isHit = $isHit;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    public function isHit()
    {
        $this->initialize();
        return $this->isHit;
    }
}
