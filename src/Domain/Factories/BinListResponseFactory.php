<?php

namespace App\Domain\Factories;

use App\Domain\FactoryInterface;
use stdClass;

class BinListResponseFactory implements FactoryInterface
{

    public static function create(): object
    {
        $object = new stdClass();
        $object->scheme = 'visa';
        $object->type = 'debit';
        $object->brand = 'Visa/Dankort';
        $object->prepaid = false;
        $object->country = new stdClass();
        $object->country->numeric = '208';
        $object->country->alpha2 = 'DK';
        $object->country->name = 'Denmark';
        $object->country->emoji = 'SF';
        $object->country->currency = 'EUR';
        $object->country->latitude = 50;
        $object->country->longitude = 10;
        $object->bank = new stdClass();
        $object->bank->name = 'Test name';
        $object->bank->city = 'Test city';
        $object->bank->phone = 'Test phone';
        $object->bank->url = 'Test url';
        return $object;
    }
}