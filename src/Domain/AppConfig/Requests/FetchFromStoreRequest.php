<?php

namespace App\Domain\AppConfig\Requests;

final readonly class FetchFromStoreRequest
{
    public function __construct(
        private string $namespace,
        private array  $path
    )
    {
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getPath(): array
    {
        return $this->path;
    }
}