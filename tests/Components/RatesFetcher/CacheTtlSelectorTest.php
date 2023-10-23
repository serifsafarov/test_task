<?php

namespace Tests\Components\RatesFetcher;

use App\Components\RatesFetcher\CacheTtlSelector;
use App\Domain\App;
use DateTime;
use PHPUnit\Framework\TestCase;

class CacheTtlSelectorTest extends TestCase
{
    private CacheTtlSelector $selector;

    protected function setUp(): void
    {
        $this->selector = App::$facade->get(CacheTtlSelector::class);

        parent::setUp();
    }

    public function testGetStartOfNextDay()
    {
        $now = new DateTime();
        $result = $this->selector->getStartOfNextDay();
        $this->assertTrue(
            $result->getTimestamp() > $now->getTimestamp()
        );
    }
}
