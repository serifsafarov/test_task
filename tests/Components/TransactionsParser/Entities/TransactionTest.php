<?php

namespace Tests\Components\TransactionsParser\Entities;

use App\Components\TransactionsParser\Entities\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    private Transaction $entity;

    protected function setUp(): void
    {
        $this->entity = new Transaction(
            bin: '123123123',
            amount: '100.00',
            currency: 'EUR'
        );
        parent::setUp();
    }

    public function testProps()
    {
        $this->assertEquals(
            'EUR',
            $this->entity->getCurrency()
        );

        $this->assertEquals(
            '123123123',
            $this->entity->getBin()
        );

        $this->assertEquals(
            '100.00',
            $this->entity->getAmount()
        );
    }
}
