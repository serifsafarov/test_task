<?php

namespace Tests\Components\BinFetcher\Entities\BinResponse;

use App\Components\BinFetcher\Entities\BinResponse\BinResponseBank;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseCountry;
use PHPUnit\Framework\TestCase;

class BinResponseBankTest extends TestCase
{
    private BinResponseBank $entity;

    protected function setUp(): void
    {
        $this->entity = new BinResponseBank(
            name: 'Test name',
            url: 'Test url',
            phone: 'Test phone',
            city: 'Test city'
        );
        parent::setUp();
    }

    public function testProps()
    {
        $this->assertEquals(
            'Test name',
            $this->entity->getName()
        );

        $this->assertEquals(
            'Test url',
            $this->entity->getUrl()
        );

        $this->assertEquals(
            'Test phone',
            $this->entity->getPhone()
        );

        $this->assertEquals(
            'Test city',
            $this->entity->getCity()
        );
    }
}
