<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Config\Config;
use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\HttpMethod;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\CepAbertoNormalizer;
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
    ): Request {
        $token = Config::get('cepaberto_token');

        // echo "Token: " . $token . PHP_EOL;

        return new Request(
            host: 'www.cepaberto.com',
            path: sprintf(
                '/api/v3/cep?cep=%s',
                $cep->value()
            ),
            method: HttpMethod::GET,
            headers: [

                'Accept'
                    => 'application/json',

                'User-Agent'
                    => 'BuscaCepPhp/1.0',

                'Authorization'
                    => 'Token token=' . $token

            ],
            timeout: Provider::CEP_ABERTO
                ->timeout()
        );
    }

    #[Override]
    protected function normalizer(): NormalizerInterface
    {
        return new CepAbertoNormalizer();
    }
}
