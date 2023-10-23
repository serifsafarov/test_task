<?php

namespace App\Components\Cache;

readonly class CacheConfig
{
    public function __construct(
        private int $ttl
    )
    {
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }
}