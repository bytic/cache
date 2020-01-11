<?php

namespace Nip\Cache\Items;

/**
 * Class CacheItemFactory
 * @package Nip\Cache\Items
 */
class CacheItemFactory
{
    /**
     * @param string $key
     * @param $param
     * @return CacheItem
     */
    public static function create($key, $param)
    {
        if ($param instanceof CacheItem) {
            return $param;
        }

        $item = new CacheItem($key, $param);
        return $item;
    }
}
