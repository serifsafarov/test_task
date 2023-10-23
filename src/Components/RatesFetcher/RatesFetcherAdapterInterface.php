<?php

namespace App\Components\RatesFetcher;

use App\Components\BinFetcher\Entities\BinResponse;
use App\Components\RatesFetcher\Entities\ExchangeRatesResponse;

interface RatesFetcherAdapterInterface
{
    public function fetch(): ?ExchangeRatesResponse;
}