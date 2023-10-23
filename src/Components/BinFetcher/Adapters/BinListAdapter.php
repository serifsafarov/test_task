<?php

namespace App\Components\BinFetcher\Adapters;

use App\Components\BinFetcher\BinFetcherAdapterInterface;
use App\Components\BinFetcher\Converters\BinListResponseToBinResponseConverter;
use App\Components\BinFetcher\Entities\BinResponse;
use GuzzleHttp\Client;
use Monolog\Logger;
use Throwable;

class BinListAdapter implements BinFetcherAdapterInterface
{
    public function __construct(
        private readonly Client $client,
        private readonly Logger $logger,
        private readonly BinListResponseToBinResponseConverter $converter
    )
    {
    }

    public function fetch(string $bin): ?BinResponse
    {
        try {
            $res = $this->client->get(
                "/$bin"
            );
            $res = json_decode(
                $res->getBody()->getContents()
            );
            $res = $this->converter->convert($res);
        } catch (Throwable $e) {
            $this->logger->error(
                sprintf(
                    "[%s] Could not fetch BIN data.\n%s\n%s",
                    get_class(),
                    $e->getMessage(),
                    $e->getTraceAsString()
                )
            );
            $res = null;
        }
        return $res;
    }
}