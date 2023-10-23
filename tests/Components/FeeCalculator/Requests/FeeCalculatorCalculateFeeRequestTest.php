<?php

namespace Tests\Components\FeeCalculator\Requests;

use App\Components\FeeCalculator\Requests\FeeCalculatorCalculateFeeRequest;
use PHPUnit\Framework\TestCase;

class FeeCalculatorCalculateFeeRequestTest extends TestCase
{
    private FeeCalculatorCalculateFeeRequest $entity;

    protected function setUp(): void
    {
        $this->entity = new FeeCalculatorCalculateFeeRequest(
            amount: 123.21,
            country_code: 'PL'
        );

        parent::setUp();
    }

    public function testProps(){
        $this->assertEquals(
            123.21,
            $this->entity->getAmount()
        );

        $this->assertEquals(
            'PL',
            $this->entity->getCountryCode()
        );
    }
}
