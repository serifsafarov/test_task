<?php

namespace App\Components\TransactionsParser\Converters;

use App\Components\TransactionsParser\Entities\Transaction;
use Exception;

class RowToTransactionConverter
{
    /**
     * @throws Exception
     */
    public function convert(
        object $row
    ): Transaction
    {
        if (
            empty($row->bin) ||
            empty($row->amount) ||
            empty($row->currency)
        ){
            throw new Exception('Necessary fields are empty');
        }
        return new Transaction(
            bin: (string)$row->bin,
            amount: (float)$row->amount,
            currency: (string)$row->currency
        );
    }
}