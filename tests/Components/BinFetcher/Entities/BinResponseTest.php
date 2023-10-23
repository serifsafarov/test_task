<?php

namespace Tests\Components\BinFetcher\Entities;

use App\Components\BinFetcher\Entities\BinResponse;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseBank;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseCountry;
use PHPUnit\Framework\TestCase;

class BinResponseTest extends TestCase
{
    private BinResponse $entity;

    protected function setUp(): void
    {
        $this->entity = new BinResponse(
            scheme: 'visa',
            type: 'debit',
            brand: 'Visa/Dankort',
            prepaid: false,
            country: new BinResponseCountry(
                numeric: '208',
                alpha2: 'DK',
                name: 'Denmark',
                emoji: 'SF',
                currency: 'EUR',
                latitude: 50,
                longitude: 10,
            ),
            bank: new BinResponseBank(
                name: 'Test name',
                url: 'Test url',
                phone: 'Test phone',
                city: 'Test city'
            )
        );
        parent::setUp();
    }

    public function testProps()
    {
        $this->assertEquals(
            'visa',
            $this->entity->getScheme()
        );

        $this->assertEquals(
            'debit',
            $this->entity->getType()
        );

        $this->assertEquals(
            'Visa/Dankort',
            $this->entity->getBrand()
        );

        $this->assertFalse(
            $this->entity->isPrepaid()
        );

        $this->assertInstanceOf(
            BinResponseCountry::class,
            $this->entity->getCountry()
        );

        $this->assertInstanceOf(
            BinResponseBank::class,
            $this->entity->getBank()
        );
    }
}
