<?php

namespace App\Components\RatesFetcher;

use App\Components\Cache\Cache;
use Exception;

readonly class RatesFetcher
{
    public function __construct(
        private RatesFetcherAdapterInterface $defaultAdapter,
        private Cache                        $cache,
        private CacheTtlSelector             $cacheTtlSelector
    )
    {
    }

    /**
     * @throws Exception
     */
    public function fetch(RatesFetcherAdapterInterface $adapter = null)
    {
        if (empty($adapter)) {
            $adapter = $this->defaultAdapter;
        }
        return $this->cache->get(
            key: "currency_rates" . time(),
            default: function () use ($adapter) {
                return $adapter->fetch();
            },
            ttl: $this->cacheTtlSelector->getStartOfNextDay()
        );
    }
}