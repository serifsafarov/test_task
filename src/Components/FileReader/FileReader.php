<?php

namespace App\Components\FileReader;

use Monolog\Logger;
use Throwable;

class FileReader
{
    public function __construct(
        private readonly Logger $logger
    )
    {
    }

    public function getFileContents(string $path): ?string
    {
        try {
            $res = file_get_contents($path);
        }catch (Throwable $e){
            $this->logger->error(
                sprintf(
                    "[%s] Could not get contents of file %s.\n%s\n%s",
                    get_class(),
                    $path,
                    $e->getMessage(),
                    $e->getTraceAsString()
                )
            );
            $res = null;
        }
        if (!is_string($res)){
            $this->logger->error(
                sprintf(
                    "[%s] Could not get contents of file %s",
                    get_class(),
                    $path
                )
            );
            $res = null;
        }
        return $res;
    }
}