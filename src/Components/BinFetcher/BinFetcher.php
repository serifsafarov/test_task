<?php

namespace App\Components\BinFetcher;

use App\Components\Cache\Cache;
use Monolog\Logger;

readonly class BinFetcher
{
    public function __construct(
        private Logger                     $logger,
        private BinNormalizer              $normalizer,
        private BinValidator               $validator,
        private BinFetcherAdapterInterface $defaultAdapter,
        private Cache                      $cache,
        private BinFetcherConfig           $config
    )
    {
    }

    public function fetch(string $bin, BinFetcherAdapterInterface $adapter = null): ?Entities\BinResponse
    {
        $res = null;
        if (empty($adapter)) {
            $adapter = $this->defaultAdapter;
        }
        $bin = $this->normalizer->normalize($bin);
        if ($this->validator->validate($bin)) {
            $res = $this->cache->get(
                key: "bin_data_$bin",
                default: function () use ($adapter, $bin) {
                    return $adapter->fetch($bin);
                },
                ttl: $this->config->getBinResultCacheTtl()
            );
        } else {
            $this->logger->error(sprintf(
                '[%s] BIN %s is not valid',
                get_class(),
                $bin
            ));
        }
        return $res;
    }
}