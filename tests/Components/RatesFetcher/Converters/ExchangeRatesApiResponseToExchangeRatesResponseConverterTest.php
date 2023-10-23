<?php

namespace Tests\Components\RatesFetcher\Converters;

use App\Components\RatesFetcher\Converters\ExchangeRatesApiResponseToExchangeRatesResponseConverter;
use App\Domain\App;
use App\Domain\Factories\ExchangeRatesApiResponseFactory;
use PHPUnit\Framework\TestCase;
use stdClass;

class ExchangeRatesApiResponseToExchangeRatesResponseConverterTest extends TestCase
{
    private ExchangeRatesApiResponseToExchangeRatesResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = App::$facade->get(ExchangeRatesApiResponseToExchangeRatesResponseConverter::class);

        parent::setUp();
    }

    public function testConvert()
    {
        $source = ExchangeRatesApiResponseFactory::create();
        $result = $this->converter->convert($source);

        $this->assertEquals(
            $source->base,
            $result->getBase()
        );

        $this->assertEquals(
            $source->date,
            $result->getDate()
        );

        $this->assertEquals(
            $source->rates,
            $result->getRates()
        );
    }
}
