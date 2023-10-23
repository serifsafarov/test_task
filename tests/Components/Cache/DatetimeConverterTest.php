<?php

namespace Tests\Components\Cache;

use App\Components\Cache\DatetimeConverter;
use App\Domain\App;
use DateTime;
use PHPUnit\Framework\TestCase;

class DatetimeConverterTest extends TestCase
{
    private DatetimeConverter $converter;

    protected function setUp(): void
    {
        $this->converter = App::$facade->get(DatetimeConverter::class);

        parent::setUp();
    }

    public function testConvert()
    {
        $now = new DateTime();
        $future = clone $now;
        $future->modify('+623 seconds');
        $diff = $this->converter->convert($future);
        $this->assertEquals(
            623,
            $diff
        );
    }
}
