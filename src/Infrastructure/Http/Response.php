<?php

// Componente responsável por armazenar o retorno das solicitações 

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http;

final readonly class Response
{
    /**
     * @param array<string,string> $headers
     */
    public function __construct(
        private int $statusCode,
        private string $body,
        private array $headers = []
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

    /**
     * @return array<string,string>
     */
    public function headers(): array
    {
        return $this->headers;
    }

    public function isSuccess(): bool
    {
        return HttpStatus::isSuccess($this->statusCode);
    }

    // public function successful(): bool
    // {
    //     return $this->statusCode >= 200
    //         && $this->statusCode < 300;
    // }

    public function isClientError(): bool
    {
        return HttpStatus::isClientError($this->statusCode);
    }

    public function isServerError(): bool
    {
        return HttpStatus::isServerError($this->statusCode);
    }

    /**
     * @return array<string,mixed>
     */
    public function json(): array
    {
        return json_decode(
            $this->body,
            true,
            flags: JSON_THROW_ON_ERROR
        );
    }
}