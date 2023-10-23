<?php

namespace App\Components\FeeCalculator;

class AmountNormalizer
{
    public function normalize(float $amount): float
    {
        return ceil($amount * 100) / 100;
    }
}