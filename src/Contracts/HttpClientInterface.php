<?php

// Desacopla completamente o HTTP
// Evita ficar atrelado a um método específico, possibilitando futuras modificações para:
// - cURL
// - Guzzle
// - Symfony HttpClient

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Contracts;

interface HttpClientInterface
{
    /**
     * Executa uma requisição GET
     * 
     * @throws \Engfabiodesalvi\Exceptions\HttpException
     */
    // Apenas retorna uma string.
    // json_decode() será realizado por outro componente.
    // Princípio da responsabilidade única.
    public function get(
        string $url,
        array $headers = [],
        int $timeut = 10
    ): string;
}