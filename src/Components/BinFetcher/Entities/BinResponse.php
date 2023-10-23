<?php

namespace App\Components\BinFetcher\Entities;

use App\Components\BinFetcher\Entities\BinResponse\BinResponseBank;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseCountry;

readonly class BinResponse
{
    public function __construct(
        private string             $scheme,
        private ?string            $type,
        private ?string            $brand,
        private ?bool              $prepaid,
        private BinResponseCountry $country,
        private BinResponseBank    $bank,
    )
    {
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function isPrepaid(): ?bool
    {
        return $this->prepaid;
    }

    public function getCountry(): BinResponseCountry
    {
        return $this->country;
    }

    public function getBank(): BinResponseBank
    {
        return $this->bank;
    }
}