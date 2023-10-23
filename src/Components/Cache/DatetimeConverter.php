<?php

namespace App\Components\Cache;

use DateTime;

readonly class DatetimeConverter
{
    public function __construct(
        private CacheConfig $config
    )
    {
    }

    public function convert(DateTime $dateTime): ?int
    {
        $ttl = $dateTime->getTimestamp() - (new DateTime())->getTimestamp();
        if ($ttl <= 0){
            $ttl = $this->config->getTtl();
        }
        return $ttl;
    }
}