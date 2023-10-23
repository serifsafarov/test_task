<?php

namespace App\Components\TransactionsParser;

use App\Components\TransactionsParser\Converters\RowToTransactionConverter;
use Monolog\Logger;
use Throwable;

readonly class TransactionsParser
{
    public function __construct(
        private RowToTransactionConverter $converter,
        private Logger                    $logger,
        private JsonParser                $jsonParser
    )
    {
    }

    public function parse(string $text): array
    {
        $rows = $this->jsonParser->parse($text);

        $rows = array_map(function ($row) {
            try {
                $res = $this->converter->convert($row);
            } catch (Throwable $e) {
                $this->logger->error(
                    sprintf(
                        "[%s] Row is not valid.\n%s\n%s",
                        get_class(),
                        $e->getMessage(),
                        $e->getTraceAsString()
                    )
                );
                $res = null;
            }
            return $res;
        }, $rows);
        return array_filter($rows);
    }
}