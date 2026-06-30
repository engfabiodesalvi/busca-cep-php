<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\HttpMethod;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Override;

final class CepAbertoProvider extends AbstractProvider
{
    #[Override]
    public function getName(): string
    {
        return Provider::CEP_ABERTO
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

            host: 'www.cepaberto.com',

            path: sprintf(
                '/api/v3/cep?cep=%s',
                $cep->value()
            ),

            method: HttpMethod::GET,

            headers: [

                'Accept'
                    =>'application/json',

                'User-Agent'
                    => 'BuscaCepPhp/1.0',
                
                'Authorization'
                    => 'Token token=TOKEN_REMOVIDO'
                    
            ],

            timeout: Provider::CEP_ABERTO
                ->timeout()
        );        
    }
}