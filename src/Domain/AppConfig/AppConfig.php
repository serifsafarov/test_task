<?php

namespace App\Domain\AppConfig;

final readonly class AppConfig
{
    public function __construct(
        private AppConfigStore $store,
        private AppConfigKeyParser $parser
    )
    {
    }

    public function get(string $key)
    {
        $request = $this->parser->parse($key);
        return $this->store->fetchData($request);
    }
}