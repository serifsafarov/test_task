<?php

namespace Tests\Components\FeeCalculator;

use App\Components\FeeCalculator\FeeCalculator;
use App\Components\FeeCalculator\Requests\FeeCalculatorCalculateFeeRequest;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class FeeCalculatorTest extends TestCase
{
    private FeeCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = App::$facade->get(FeeCalculator::class);

        parent::setUp();
    }

    public function testCalculateFee()
    {
        $request = new FeeCalculatorCalculateFeeRequest(
            amount: 12.3,
            country_code: 'PL'
        );

        $result = $this->calculator->calculateFee($request);

        $this->assertEquals(
            0.25,
            $result
        );
    }
}
