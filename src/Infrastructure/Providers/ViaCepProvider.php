<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\HttpMethod;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\ViaCepNormalizer;
use Override;

final class ViaCepProvider extends AbstractProvider
{
    
    #[Override]
    public function getName(): string
    {
        return Provider::VIA_CEP
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
    ): Request {

        return new Request(

            host: 'viacep.com.br',

            path: sprintf(
                '/ws/%s/json/',
                $cep->value()
            ),

            method: HttpMethod::GET,

            headers: [

                'Accept'
                    =>'application/json',

                'User-Agent'
                    => 'BuscaCepPhp/1.0'
                    
            ],

            timeout: Provider::VIA_CEP
                ->timeout()
        );
    }

    #[Override]
    protected function normalizer(): NormalizerInterface
    {
        return new ViaCepNormalizer();
    }
}