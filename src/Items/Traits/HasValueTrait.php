<?php

namespace Nip\Cache\Items\Traits;

use Closure;

/**
 * Trait HasValueTrait
 * @package Nip\Cache\Items\Traits
 */
trait HasValueTrait
{
    protected $value = null;

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $this->initialize();
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function set($value)
    {
        $this->value = $value;
        return $this;
    }

    protected function initialize()
    {
        if ($this->value instanceof Closure) {
            $func = $this->value;
            $this->value = $func();
        }
    }
}
