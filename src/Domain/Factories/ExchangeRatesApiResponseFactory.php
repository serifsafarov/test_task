<?php

namespace App\Domain\Factories;

use App\Domain\FactoryInterface;
use stdClass;

class ExchangeRatesApiResponseFactory implements FactoryInterface
{

    public static function create(): object
    {
        $source = new stdClass();
        $source->base = 'EUR';
        $source->date = '2023-10-23';
        $source->rates = [
            'USD' => 1.04
        ];
        return $source;
    }
}