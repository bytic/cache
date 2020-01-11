<?php

namespace Nip\Cache\Adapters\FileAdapter;

use Nip\Cache\Adapters\AbstractAdapter;
use Nip\Cache\Items\CacheItem;

/**
 * Class FileAdapter
 * @package Nip\Cache\Adapters
 */
class FileAdapter extends AbstractAdapter
{

    /**
     * @inheritdoc
     */
    public function getItem($key)
    {
        // TODO: Implement getItem() method.
    }

    /**
     * @inheritdoc
     */
    public function hasItem($key)
    {
        // TODO: Implement hasItem() method.
    }

    /**
     * @inheritdoc
     */
    public function clear()
    {
        // TODO: Implement clear() method.
    }

    /**
     * @inheritdoc
     */
    public function deleteItem($key)
    {
        // TODO: Implement deleteItem() method.
    }

    /**
     * @inheritdoc
     */
    public function deleteItems(array $keys)
    {
        // TODO: Implement deleteItems() method.
    }


    /**
     * @inheritdoc
     */
    public function commit()
    {
        // TODO: Implement commit() method.
    }

    /**
     * @inheritDoc
     */
    protected function doFetch(array $ids)
    {
        // TODO: Implement doFetch() method.
    }

    /**
     * @inheritDoc
     */
    protected function storeItemInCache(CacheItem $item)
    {
        // TODO: Implement storeItemInCache() method.
    }
}
