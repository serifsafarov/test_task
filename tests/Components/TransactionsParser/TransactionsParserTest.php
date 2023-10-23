<?php

namespace Tests\Components\TransactionsParser;

use App\Components\TransactionsParser\Entities\Transaction;
use App\Components\TransactionsParser\TransactionsParser;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class TransactionsParserTest extends TestCase
{

    private TransactionsParser $parser;

    protected function setUp(): void
    {
        $this->parser = App::$facade->get(TransactionsParser::class);

        parent::setUp();
    }

    public function testParse()
    {
        $result = $this->parser->parse(
            '{"bin":"123123123","amount":"100.00","currency":"EUR"}'
        );
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        /** @var Transaction $transaction */
        $transaction = $result[0];
        $this->assertInstanceOf(
            Transaction::class,
            $transaction
        );
        $this->assertEquals(
            '123123123',
            $transaction->getBin()
        );
        $this->assertEquals(
            100.0,
            $transaction->getAmount()
        );
        $this->assertEquals(
            'EUR',
            $transaction->getCurrency()
        );
    }
}
