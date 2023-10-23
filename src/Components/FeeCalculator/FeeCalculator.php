<?php

namespace App\Components\FeeCalculator;

use App\Components\FeeCalculator\Requests\FeeCalculatorCalculateFeeRequest;

readonly class FeeCalculator
{
    public function __construct(
        private EUZoneDetector $detector,
        private FeeCalculatorConfig $config,
        private AmountNormalizer $normalizer
    )
    {
    }

    public function calculateFee(FeeCalculatorCalculateFeeRequest $request): float
    {
        $result = $request->getAmount() * (
            $this->detector->isEUZone($request->getCountryCode()) ?
                $this->config->getEuZoneFee() :
                $this->config->getNonEuZoneFee()
            );
        return $this->normalizer->normalize($result);
    }
}