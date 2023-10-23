<?php

namespace Tests\Components\TransactionsParser;

use App\Components\TransactionsParser\JsonParser;
use App\Domain\App;
use PHPUnit\Framework\TestCase;

class JsonParserTest extends TestCase
{
    private JsonParser $parser;

    protected function setUp(): void
    {
        $this->parser = App::$facade->get(JsonParser::class);

        parent::setUp();
    }

    public function testParse()
    {
        $result = $this->parser->parse(
            '{"bin":"123123123","amount":"100.00","currency":"EUR"}'
        );
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertIsObject($result[0]);
        $this->assertEquals(
            '123123123',
            $result[0]->bin
        );
        $this->assertEquals(
            100.0,
            $result[0]->amount
        );
        $this->assertEquals(
            'EUR',
            $result[0]->currency
        );
    }
}
