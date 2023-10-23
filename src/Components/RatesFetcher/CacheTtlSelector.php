<?php

namespace App\Components\RatesFetcher;

use DateTime;

class CacheTtlSelector
{
    public function getStartOfNextDay(): DateTime
    {
        $time = new DateTime();
        $time->modify('tomorrow');
        $time->setTime(0, 0, 0);
        return $time;
    }
}