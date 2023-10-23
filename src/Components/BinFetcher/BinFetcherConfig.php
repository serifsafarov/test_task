<?php

namespace App\Components\BinFetcher;

readonly class BinFetcherConfig
{
    public function __construct(
        private int $bin_result_cache_ttl
    )
    {
    }

    public function getBinResultCacheTtl(): int
    {
        return $this->bin_result_cache_ttl;
    }
}