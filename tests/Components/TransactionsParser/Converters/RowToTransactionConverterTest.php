<?php

namespace Tests\Components\TransactionsParser\Converters;

use App\Components\TransactionsParser\Converters\RowToTransactionConverter;
use App\Domain\App;
use App\Domain\Factories\ExchangeRatesApiResponseFactory;
use App\Domain\Factories\TransactionRowFactory;
use Exception;
use PHPUnit\Framework\TestCase;
use stdClass;

class RowToTransactionConverterTest extends TestCase
{

    private RowToTransactionConverter $converter;
    private object $sourceObject;

    protected function setUp(): void
    {
        $this->converter = App::$facade->get(RowToTransactionConverter::class);

        $this->sourceObject = TransactionRowFactory::create();

        parent::setUp();
    }

    /**
     * @throws Exception
     */
    public function testConvert()
    {
        $result = $this->converter->convert($this->sourceObject);

        $this->assertEquals(
            $this->sourceObject->currency,
            $result->getCurrency()
        );

        $this->assertEquals(
            $this->sourceObject->bin,
            $result->getBin()
        );

        $this->assertEquals(
            $this->sourceObject->amount,
            $result->getAmount()
        );
    }
}
