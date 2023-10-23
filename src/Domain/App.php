<?php

namespace App\Domain;

class App
{
    public static Facade $facade;

    public function __construct(
        Facade $facade
    )
    {
        self::$facade = $facade;
    }
}