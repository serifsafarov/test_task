<?php

namespace App\Components\RatesFetcher\Converters;

use App\Components\BinFetcher\Entities\BinResponse;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseBank;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseCountry;
use App\Components\RatesFetcher\Entities\ExchangeRatesResponse;

class ExchangeRatesApiResponseToExchangeRatesResponseConverter
{
    public function convert(object $source): ExchangeRatesResponse
    {
        return new ExchangeRatesResponse(
            base: (string)$source->base,
            date: (string)$source->date,
            rates: (array)$source->rates
        );
    }
}