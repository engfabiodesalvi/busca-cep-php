<?php

// Objeto imutável responsável pelas requisições

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http;

use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\HttpMethod;
use Stringable;

final readonly class Request
{
    /**
     * @param array<string,string> $headers
     * @param array<string,mixed> $query
     */
    public function __construct(
        private string $scheme = 'https',
        private string $host = '',
        private string $path = '/',
        private HttpMethod $method = HttpMethod::GET,
        private array $headers = [],
        private array $query = [],
        private ?string $body = null,
        private int $timeout = 10
    ) {        
    }

    public function scheme():string
    {
        return $this->scheme;
    }

    public function host(): string
    {
        return $this->host;
    }

    public function path(): string {
        return $this->path;
    }

    public function method(): HttpMethod
    {
        return $this->method;
    }

    /**
     * @return array<string,string>
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * @return array<string,mixed>
     */
    public function query(): array
    {
        return $this->query;
    }

    public function body(): ?string
    {
        return $this->body;
    }

    public function timeout(): int
    {
        return $this->timeout;
    }

    public function url(): string
    {
        $url = sprintf(
            '%s://%s%s',
            $this->scheme,
            $this->host,
            $this->path
        );

        if ($this->query !== []) {
            $url .= '?' . http_build_query($this->query);
        }

        return $url;
    }


    // public function __construct(
    //     private string $url,
    //     private string $method = 'GET',
    //     private array $headers = [],
    //     private int $timeout = 10
    // ) {

    // }

    // public function url(): string
    // {
    //     return $this->url;
    // }

    // public function method(): string
    // {
    //     return $this->method;
    // }

    // public function headers(): array
    // {
    //     return $this->headers;
    // }

    // public function timeout(): int
    // {
    //     return $this->timeout;
    // }

}