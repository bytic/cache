<?php

namespace Nip\Cache;

use Nip\Cache\Traits\HasAdaptersTrait;
use Nip\Cache\Traits\HasRepositoryTrait;

/**
 * Class CacheManager
 * @package Nip\Cache
 */
class CacheManager
{
    use HasAdaptersTrait;
    use HasRepositoryTrait;
}
