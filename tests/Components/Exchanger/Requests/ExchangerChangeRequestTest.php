<?php

namespace Tests\Components\Exchanger\Requests;

use App\Components\BinFetcher\BinFetcherConfig;
use App\Components\Exchanger\Requests\ExchangerChangeRequest;
use PHPUnit\Framework\TestCase;

class ExchangerChangeRequestTest extends TestCase
{
    public function testProps()
    {
        $entity = new ExchangerChangeRequest(
            rate: 1.3,
            result_currency: 'USD',
            amount: 24.512
        );

        $this->assertEquals(
            1.3,
            $entity->getRate()
        );

        $this->assertEquals(
            'USD',
            $entity->getResultCurrency()
        );

        $this->assertEquals(
            24.512,
            $entity->getAmount()
        );
    }
}
