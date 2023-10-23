<?php

namespace Tests\Components\FeeCalculator;

use App\Components\FeeCalculator\FeeCalculatorConfig;
use PHPUnit\Framework\TestCase;

class FeeCalculatorConfigTest extends TestCase
{
    public function testProps(){
        $entity = new FeeCalculatorConfig(
            eu_zone_fee: 0.01,
            non_eu_zone_fee: 0.02,
            eu_zone_countries: ['PL']
        );

        $this->assertEquals(
            0.01,
            $entity->getEuZoneFee()
        );

        $this->assertEquals(
            0.02,
            $entity->getNonEuZoneFee()
        );

        $this->assertEquals(
            ['PL'],
            $entity->getEuZoneCountries()
        );
    }
}
