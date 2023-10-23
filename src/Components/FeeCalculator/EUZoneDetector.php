<?php

namespace App\Components\FeeCalculator;

readonly class EUZoneDetector
{
    public function __construct(
        private FeeCalculatorConfig $config
    )
    {
    }

    public function isEUZone(?string $country_code): bool
    {
        return in_array(
            $country_code,
            $this->config->getEuZoneCountries()
        );
    }
}