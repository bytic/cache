<?php

namespace Nip\Cache;

/**
 * Class CacheManager
 * @package Nip\Cache
 */
class CacheManager
{
    use CacheManager\HasAdaptersTrait;
    use CacheManager\HasStoresTrait;
    use CacheManager\InteractsWithConfig;
}
