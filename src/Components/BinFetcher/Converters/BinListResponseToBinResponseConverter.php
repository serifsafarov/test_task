<?php

namespace App\Components\BinFetcher\Converters;

use App\Components\BinFetcher\Entities\BinResponse;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseBank;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseCountry;

class BinListResponseToBinResponseConverter
{
    public function convert(object $source): BinResponse
    {

        return new BinResponse(
            scheme: $source->scheme,
            type: $source->type ?? null,
            brand: $source->brand ?? null,
            prepaid: $source->prepaid ?? null,
            country: new BinResponseCountry(
                numeric: $source->country->numeric,
                alpha2: $source->country->alpha2,
                name: $source->country->name,
                emoji: $source->country->emoji,
                currency: $source->country->currency,
                latitude: $source->country->latitude,
                longitude: $source->country->longitude,
            ),
            bank: new BinResponseBank(
                name: $source->bank->name ?? null,
                url: $source->bank->url ?? null,
                phone: $source->bank->phone ?? null,
                city: $source->bank->city ?? null
            )
        );
    }
}