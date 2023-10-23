<?php

namespace Tests\Components\Exchanger;

use App\Components\BinFetcher\BinFetcherConfig;
use App\Components\Exchanger\ExchangerConfig;
use PHPUnit\Framework\TestCase;

class ExchangerConfigTest extends TestCase
{
    public function testProps(){
        $entity = new ExchangerConfig(
            base_currency: 'EUR'
        );
        $this->assertEquals(
            'EUR',
            $entity->getBaseCurrency()
        );
    }
}
