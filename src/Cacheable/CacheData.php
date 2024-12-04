<?php
declare(strict_types=1);

namespace Nip\Cache\Cacheable;

/**
 *
 */
class CacheData extends \ArrayObject
{
    public const DEFAULT_KEY = '__DEFAULT__';
    public static function from($data): CacheData
    {
        return new self($data);
    }

    /**
     * @param $data
     * @param $key
     * @return $this
     */
    public function set($data, $key = self::DEFAULT_KEY): static
    {
        $this[$key] = $data;
        return $this;
    }

    /**
     * @param $key
     * @param $default
     * @return mixed|null
     */
    public function get($key = self::DEFAULT_KEY, $default = null)
    {
        return $this[$key] ?? $default;
    }
}