<?php

namespace Tests\Components\RatesFetcher\Entities;

use App\Components\RatesFetcher\Entities\ExchangeRatesResponse;
use PHPUnit\Framework\TestCase;

class ExchangeRatesResponseTest extends TestCase
{
    private ExchangeRatesResponse $entity;

    protected function setUp(): void
    {
        $this->entity = new ExchangeRatesResponse(
            base: 'EUR',
            date: '2023-10-23',
            rates: [
                'USD' => 1.04
            ]
        );
        parent::setUp();
    }

    public function testProps()
    {
        $this->assertEquals(
            'EUR',
            $this->entity->getBase()
        );

        $this->assertEquals(
            '2023-10-23',
            $this->entity->getDate()
        );

        $this->assertEquals(
            [
                'USD' => 1.04
            ],
            $this->entity->getRates()
        );
    }
}
