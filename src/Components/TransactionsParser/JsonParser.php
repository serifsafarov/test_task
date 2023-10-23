<?php

namespace App\Components\TransactionsParser;

use Monolog\Logger;

readonly class JsonParser
{
    public function __construct(
        private Logger $logger,
    )
    {
    }

    public function parse(string $text): array
    {
        $rows = explode(PHP_EOL, $text);
        $rows = array_map(function ($row) {
            $row = trim($row);
            $parsedRow = json_decode(
                trim($row)
            );
            if (empty($parsedRow)) {
                $this->logger->warning(
                    sprintf(
                        "[%s] %s is not valid json",
                        get_class(),
                        $row
                    )
                );
            }
            return $parsedRow;
        }, $rows);
        return array_filter($rows);
    }
}