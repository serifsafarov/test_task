<?php

namespace App\Components\TransactionsParser\Entities;

readonly class Transaction
{
    public function __construct(
        private string $bin,
        private float  $amount,
        private string $currency
    )
    {
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}