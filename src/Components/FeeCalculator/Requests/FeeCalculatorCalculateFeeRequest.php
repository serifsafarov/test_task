<?php

namespace App\Components\FeeCalculator\Requests;

readonly class FeeCalculatorCalculateFeeRequest
{
    public function __construct(
        private float  $amount,
        private ?string $country_code
    )
    {
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}