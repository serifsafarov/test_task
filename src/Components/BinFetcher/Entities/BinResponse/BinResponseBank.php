<?php

namespace App\Components\BinFetcher\Entities\BinResponse;

readonly class BinResponseBank
{
    public function __construct(
        private ?string $name,
        private ?string $url,
        private ?string $phone,
        private ?string $city,
    )
    {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
}