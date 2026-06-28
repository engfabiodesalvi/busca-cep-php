<?php

// Objeto imutável responsável pelas requisições

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Http;

final readonly class Request
{
    public function __construct(
        private string $url,
        private string $method = 'GET',
        private array $headers = [],
        private int $timeout = 10
    ) {

    }

    public function url(): string
    {
        return $this->url;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function timeout(): int
    {
        return $this->timeout;
    }

}