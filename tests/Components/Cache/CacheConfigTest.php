<?php

namespace Tests\Components\Cache;

use App\Components\BinFetcher\BinFetcherConfig;
use App\Components\Cache\CacheConfig;
use PHPUnit\Framework\TestCase;

class CacheConfigTest extends TestCase
{
    public function testProps()
    {
        $entity = new CacheConfig(
            ttl: 3600
        );
        $this->assertEquals(
            3600,
            $entity->getTtl()
        );
    }
}
