<?php

namespace App\Domain;

interface FactoryInterface
{
    public static function create(): mixed;
}