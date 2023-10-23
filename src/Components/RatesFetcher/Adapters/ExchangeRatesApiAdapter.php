<?php

namespace App\Components\RatesFetcher\Adapters;

use App\Components\RatesFetcher\Converters\ExchangeRatesApiResponseToExchangeRatesResponseConverter;
use App\Components\RatesFetcher\Entities\ExchangeRatesResponse;
use App\Components\RatesFetcher\RatesFetcherAdapterInterface;
use App\Components\RatesFetcher\RatesFetcherConfig;
use GuzzleHttp\Client;
use Monolog\Logger;
use Throwable;

readonly class ExchangeRatesApiAdapter implements RatesFetcherAdapterInterface
{
    public function __construct(
        private Client                                                   $client,
        private Logger                                                   $logger,
        private ExchangeRatesApiResponseToExchangeRatesResponseConverter $converter,
        private RatesFetcherConfig                                       $config
    )
    {
    }

    public function fetch(): ?ExchangeRatesResponse
    {
        try {
            $res = $this->client->get(
                "/latest",
                [
                    'query' => [
                        'access_key' => $this->config->getApiKey()
                    ]
                ]
            );
            $res = json_decode(
                $res->getBody()->getContents()
            );
            if (empty($res->success)) {
                $res = null;
            } else {
                $res = $this->converter->convert($res);
            }
        } catch (Throwable $e) {
            $this->logger->error(
                sprintf(
                    "[%s] Could not fetch exchange rates.\n%s\n%s",
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