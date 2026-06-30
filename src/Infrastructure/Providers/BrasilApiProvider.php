<?php

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\HttpMethod;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\BrasilApiNormalizer;
use Override;

final class BrasilApiProvider extends AbstractProvider
{
    #[Override]
    public function getName(): string
    {
        return Provider::BRASIL_API
            ->label();
    }

    #[Override]
    public function isAvailable(): bool
    {
        return true;
    }

    #[Override]
    protected function buildRequest(
        Cep $cep
    ): Request
    {
        return new Request(
            // https://brasilapi.com.br/api/cep/v2/01001000
            host: 'brasilapi.com.br',

            path: sprintf(
                '/api/cep/v2/%s',
                $cep->value()
            ),

            method: HttpMethod::GET,

            headers: [

                'Accept'
                    =>'application/json',

                'User-Agent'
                    => 'BuscaCepPhp/1.0'

            ],

            timeout: Provider::BRASIL_API
                ->timeout()
        );
    }

    #[Override]
    protected function normalizer(): NormalizerInterface
    {
        return new BrasilApiNormalizer();
    }        
}