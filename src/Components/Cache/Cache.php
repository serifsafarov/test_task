<?php

namespace App\Components\Cache;

use DateTime;

readonly class Cache
{
    public function __construct(
        private AdapterInterface  $adapter,
        private CacheConfig       $config,
        private DatetimeConverter $converter
    )
    {
    }

    public function set(string $key, mixed $value, int|DateTime $ttl = null): void
    {
        if (empty($ttl)) {
            $ttl = $this->config->getTtl();
        } elseif ($ttl instanceof DateTime) {
            $ttl = $this->converter->convert($ttl);
        }
        $value = serialize($value);
        $this->adapter->set(
            key: $key,
            value: $value,
            ttl: $ttl
        );
    }

    public function get(string $key, callable $default = null, int|DateTime $ttl = null)
    {
        $value = $this->adapter->get(
            key: $key
        );
        if (
            is_null($value) && !is_null($default)
        ) {
            $value = $default();
            $this->set($key, $value, $ttl);
        } else {
            $value = unserialize($value);
        }
        return $value;
    }
}