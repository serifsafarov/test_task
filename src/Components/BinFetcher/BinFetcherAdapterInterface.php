<?php

namespace App\Components\BinFetcher;

use App\Components\BinFetcher\Entities\BinResponse;

interface BinFetcherAdapterInterface
{
    public function fetch(string $bin): ?BinResponse;
}