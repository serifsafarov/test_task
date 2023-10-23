<?php

namespace App\Components\Cache;

interface AdapterInterface
{
    public function set(string $key, string $value, int $ttl): void;
    public function get(string $key): ?string;
}