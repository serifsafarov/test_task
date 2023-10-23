<?php

namespace App\Components\Exchanger;

readonly class ExchangerConfig
{
    public function __construct(
        private string $base_currency
    )
    {
    }

    public function getBaseCurrency(): string
    {
        return $this->base_currency;
    }
}