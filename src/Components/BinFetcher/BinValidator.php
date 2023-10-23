<?php

namespace App\Components\BinFetcher;

class BinValidator
{
    public function validate(string $bin): bool
    {
        return !empty($bin);
    }
}