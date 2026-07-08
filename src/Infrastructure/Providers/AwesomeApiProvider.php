<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\HttpMethod;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\AwesomeApiNormalizer;
use Override;

final class AwesomeApiProvider extends AbstractProvider
{
    #[Override]
    public function getName(): string
    {
        return Provider::AWESOME_API
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
            host: 'cep.awesomeapi.com.br',
            path: sprintf(
                '/json/%s',
                $cep->value()
            ),
            method: HttpMethod::GET,
            headers: [

                'Accept'
                    => 'application/json',

                'User-Agent'
                    => 'BuscaCepPhp/1.0'

            ],
            timeout: Provider::AWESOME_API
                ->timeout()
        );
    }

    #[Override]
    protected function normalizer(): NormalizerInterface
    {
        return new AwesomeApiNormalizer();
    }
}
