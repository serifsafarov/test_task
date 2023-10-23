<?php

namespace App\Components\BinFetcher\Entities\BinResponse;

readonly class BinResponseCountry
{
    public function __construct(
        private string $numeric,
        private string $alpha2,
        private string $name,
        private string $emoji,
        private string $currency,
        private int    $latitude,
        private int    $longitude,
    )
    {
    }

    public function getNumeric(): string
    {
        return $this->numeric;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmoji(): string
    {
        return $this->emoji;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getLatitude(): int
    {
        return $this->latitude;
    }

    public function getLongitude(): int
    {
        return $this->longitude;
    }
}