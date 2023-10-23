<?php

namespace Tests\Components\FeeCalculator;

use App\Components\FeeCalculator\EUZoneDetector;
use App\Components\FeeCalculator\FeeCalculatorConfig;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class EUZoneDetectorTest extends TestCase
{
    private EUZoneDetector $detector;

    protected function setUp(): void
    {
        $this->detector = new EUZoneDetector(
            config: new FeeCalculatorConfig(
                eu_zone_fee: 0.01,
                non_eu_zone_fee: 0.02,
                eu_zone_countries: ['PL']
            )
        );

        parent::setUp();
    }

    public function testIsEUZone()
    {
        $result = $this->detector->isEUZone('PL');
        $this->assertTrue(
            $result
        );
    }
}
