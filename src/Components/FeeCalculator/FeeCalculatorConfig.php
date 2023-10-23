<?php

namespace App\Components\FeeCalculator;

readonly class FeeCalculatorConfig
{
    public function __construct(
        private float $eu_zone_fee,
        private float $non_eu_zone_fee,
        private array $eu_zone_countries
    )
    {
    }

    public function getEuZoneFee(): float
    {
        return $this->eu_zone_fee;
    }

    public function getNonEuZoneFee(): float
    {
        return $this->non_eu_zone_fee;
    }

    public function getEuZoneCountries(): array
    {
        return $this->eu_zone_countries;
    }
}