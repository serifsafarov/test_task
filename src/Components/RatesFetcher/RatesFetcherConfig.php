<?php

namespace App\Components\RatesFetcher;

readonly class RatesFetcherConfig
{
    public function __construct(
        private string $api_key
    )
    {
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }
}