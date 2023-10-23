<?php

namespace App\Domain\AppConfig;

use App\Domain\AppConfig\Requests\FetchFromStoreRequest;

class AppConfigStore
{
    private array $namespaces;

    public function remember(string $namespace, array $config): void
    {
        $this->namespaces[$namespace] = $config;
    }

    public function fetchData(FetchFromStoreRequest $request): mixed
    {
        $result = null;
        if (
            !empty($this->namespaces[$request->getNamespace()])
        ) {
            $data = $this->namespaces[$request->getNamespace()];
            foreach ($request->getPath() as $item) {
                if (
                    empty($data[$item])
                ) {
                    $data = null;
                    break;
                }
                $data = $data[$item];
            }
            $result = $data;
        }
        return $result;
    }
}