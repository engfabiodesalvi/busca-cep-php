<?php

// Desacopla completamente o HTTP
// Evita ficar atrelado a um método específico, possibilitando futuras modificações para:
// - cURL
// - Guzzle
// - Symfony HttpClient
// Compatível com PSR-18 (HTTP Client)

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Contracts;

use Engfabiodesalvi\BuscaCepPhp\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Http\Response;
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


    // Permite implementar futuramente:
    // - POST
    // - PUT
    // - DELETE
    // - PATCH
    // Sem alterar a interface
    // Semelhante ao fucninamento do Symfony HttpClient

    public function send(
        Request $request
    ): Response;
    
}