<?php

namespace App\Components\BinFetcher;

use Monolog\Logger;

class BinNormalizer
{
    public function normalize(string $bin): string
    {
        return trim($bin);
    }
}