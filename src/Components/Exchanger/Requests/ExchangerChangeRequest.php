<?php

namespace App\Components\Exchanger\Requests;

readonly class ExchangerChangeRequest
{
    public function __construct(
        private float  $rate,
        private string $result_currency,
        private float  $amount
    )
    {
    }

    public function getResultCurrency(): string
    {
        return $this->result_currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}