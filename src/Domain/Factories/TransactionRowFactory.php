<?php

namespace App\Domain\Factories;

use App\Domain\FactoryInterface;
use stdClass;

class TransactionRowFactory implements FactoryInterface
{

    public static function create(): object
    {
        $source = new stdClass();
        $source->bin = '123123123';
        $source->currency = 'EUR';
        $source->amount = '100.00';
        return $source;
    }
}