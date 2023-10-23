<?php

namespace Tests\Components\BinFetcher\Converters;

use App\Components\BinFetcher\Converters\BinListResponseToBinResponseConverter;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseBank;
use App\Components\BinFetcher\Entities\BinResponse\BinResponseCountry;
use App\Domain\App;
use App\Domain\Factories\BinListResponseFactory;
use PHPUnit\Framework\TestCase;
use stdClass;

class BinListResponseToBinResponseConverterTest extends TestCase
{
    private BinListResponseToBinResponseConverter $converter;
    private object $sourceObject;

    protected function setUp(): void
    {
        $this->converter = App::$facade->get(BinListResponseToBinResponseConverter::class);

        $this->sourceObject = BinListResponseFactory::create();

        parent::setUp();
    }

    public function testConvert()
    {
        $result = $this->converter->convert($this->sourceObject);

        $this->assertEquals(
            $this->sourceObject->scheme,
            $result->getScheme()
        );

        $this->assertEquals(
            $this->sourceObject->type,
            $result->getType()
        );

        $this->assertEquals(
            $this->sourceObject->brand,
            $result->getBrand()
        );

        $this->assertEquals(
            $this->sourceObject->prepaid,
            $result->isPrepaid()
        );

        $this->assertInstanceOf(
            BinResponseCountry::class,
            $result->getCountry()
        );

        $this->assertEquals(
            $this->sourceObject->country->numeric,
            $result->getCountry()->getNumeric()
        );

        $this->assertEquals(
            $this->sourceObject->country->alpha2,
            $result->getCountry()->getAlpha2()
        );

        $this->assertEquals(
            $this->sourceObject->country->name,
            $result->getCountry()->getName()
        );

        $this->assertEquals(
            $this->sourceObject->country->emoji,
            $result->getCountry()->getEmoji()
        );

        $this->assertEquals(
            $this->sourceObject->country->currency,
            $result->getCountry()->getCurrency()
        );

        $this->assertEquals(
            $this->sourceObject->country->latitude,
            $result->getCountry()->getLatitude()
        );

        $this->assertEquals(
            $this->sourceObject->country->longitude,
            $result->getCountry()->getLongitude()
        );

        $this->assertInstanceOf(
            BinResponseBank::class,
            $result->getBank()
        );

        $this->assertEquals(
            $this->sourceObject->bank->name,
            $result->getBank()->getName()
        );

        $this->assertEquals(
            $this->sourceObject->bank->url,
            $result->getBank()->getUrl()
        );

        $this->assertEquals(
            $this->sourceObject->bank->phone,
            $result->getBank()->getPhone()
        );

        $this->assertEquals(
            $this->sourceObject->bank->city,
            $result->getBank()->getCity()
        );
    }
}
