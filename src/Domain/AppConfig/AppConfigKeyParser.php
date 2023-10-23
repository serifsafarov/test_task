<?php

namespace App\Domain\AppConfig;

use App\Domain\AppConfig\Requests\FetchFromStoreRequest;

class AppConfigKeyParser
{
    public function parse(string $key): ?FetchFromStoreRequest
    {
        preg_match(
            '/^(?P<namespace>[^.]+)\.(?P<path>.+)$/',
            $key,
            $matches
        );
        if (empty($matches['namespace']) || empty($matches['path'])){
            $result = null;
        }else{
            $result = new FetchFromStoreRequest(
                namespace: $matches['namespace'],
                path: explode('.', $matches['path'])
            );
        }
        return $result;
    }
}