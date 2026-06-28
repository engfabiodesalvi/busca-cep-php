<?php

// Componente responsável por armazenar o retorno das solucitações 

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Http;

final readonly class Response
{
    public function __construct(
        private int $statusCode,
        private string $body,
        private array $headers
    ) {        
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function successful(): bool
    {
        return $this->statusCode >= 200
            && $this->statusCode < 300;
    }
}