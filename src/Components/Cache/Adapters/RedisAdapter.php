<?php

namespace App\Components\Cache\Adapters;

use App\Components\Cache\AdapterInterface;
use Predis\Client;

readonly class RedisAdapter implements AdapterInterface
{
    public function __construct(
        private Client $client
    )
    {
    }

    public function set(string $key, string $value, int $ttl): void
    {
        $this->client->setex(
            key: $key,
            seconds: $ttl,
            value: $value,
        );
    }

    public function get(string $key): ?string
    {
        return $this->client->get(
            key: $key
        );
    }
}