<?php

namespace Tests\Components\Exchanger;

use App\Components\Exchanger\Exchanger;
use App\Components\Exchanger\Requests\ExchangerChangeRequest;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class ExchangerTest extends TestCase
{
    private Exchanger $exchanger;

    protected function setUp(): void
    {
        $this->exchanger = App::$facade->get(Exchanger::class);

        parent::setUp();
    }

    public function testChange()
    {
        $request = new ExchangerChangeRequest(
            rate: 1.3,
            result_currency: 'USD',
            amount: 24.512
        );

        $result = $this->exchanger->change($request);
        $this->assertEquals(
            ceil(18.855384615385 * 1000000) / 1000000,
            ceil($result * 1000000) / 1000000
        );
    }
}
