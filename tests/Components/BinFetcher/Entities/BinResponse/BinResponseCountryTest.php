<?php

namespace Tests\Components\BinFetcher\Entities\BinResponse;

use App\Components\BinFetcher\Entities\BinResponse\BinResponseBank;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseCountry;
use PHPUnit\Framework\TestCase;

class BinResponseCountryTest extends TestCase
{
    private BinResponseCountry $entity;

    protected function setUp(): void
    {
        $this->entity = new BinResponseCountry(
            numeric: '208',
            alpha2: 'DK',
            name: 'Denmark',
            emoji: 'SF',
            currency: 'EUR',
            latitude: 50,
            longitude: 10,
        );
        parent::setUp();
    }

    public function testProps()
    {
        $this->assertEquals(
            '208',
            $this->entity->getNumeric()
        );

        $this->assertEquals(
            'DK',
            $this->entity->getAlpha2()
        );

        $this->assertEquals(
            'Denmark',
            $this->entity->getName()
        );

        $this->assertEquals(
            'SF',
            $this->entity->getEmoji()
        );

        $this->assertEquals(
            'EUR',
            $this->entity->getCurrency()
        );

        $this->assertEquals(
            50,
            $this->entity->getLatitude()
        );

        $this->assertEquals(
            10,
            $this->entity->getLongitude()
        );
    }
}
