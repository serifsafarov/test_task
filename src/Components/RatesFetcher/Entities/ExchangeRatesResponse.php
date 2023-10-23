<?php

namespace App\Components\RatesFetcher\Entities;

readonly class ExchangeRatesResponse
{
    public function __construct(
        private string $base,
        private string $date,
        private array  $rates
    )
    {
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getRates(): array
    {
        return $this->rates;
    }
}