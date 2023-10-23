<?php

namespace Tests\Components\BinFetcher;

use App\Components\BinFetcher\BinFetcherConfig;
use PHPUnit\Framework\TestCase;

class BinFetcherConfigTest extends TestCase
{
    public function testProps(){
        $entity = new BinFetcherConfig(
            bin_result_cache_ttl: 3600
        );
        $this->assertEquals(
            3600,
            $entity->getBinResultCacheTtl()
        );
    }
}
