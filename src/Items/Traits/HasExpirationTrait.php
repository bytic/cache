<?php

namespace Nip\Cache\Items\Traits;

use InvalidArgumentException;

/**
 * Trait HasExpirationTrait
 * @package Nip\Cache\Items\Traits
 */
trait HasExpirationTrait
{
    protected $expiry;
    protected $defaultLifetime;

    /**
     * {@inheritdoc}
     */
    public function expiresAt($expiration)
    {
        if (null === $expiration) {
            $this->expiry = $this->defaultLifetime > 0 ? microtime(true) + $this->defaultLifetime : null;
        } elseif ($expiration instanceof \DateTimeInterface) {
            $this->expiry = (float)$expiration->format('U.u');
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'Expiration date must implement DateTimeInterface or be null, "%s" given',
                    \is_object($expiration) ? \get_class($expiration) : \gettype($expiration)
                )
            );
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function expiresAfter($time)
    {
        if (null === $time) {
            $this->expiry = $this->defaultLifetime > 0 ? microtime(true) + $this->defaultLifetime : null;
        } elseif ($time instanceof \DateInterval) {
            /** @noinspection PhpWrongStringConcatenationInspection */
            $this->expiry = microtime(true)
                + \DateTime::createFromFormat('U', 0)->add($time)->format('U.u');
        } elseif (\is_int($time)) {
            $this->expiry = $time + microtime(true);
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'Expiration date must be an integer, a DateInterval or null, "%s" given',
                    (\is_object($time) ? \get_class($time) : \gettype($time))
                )
            );
        }
        return $this;
    }
}
