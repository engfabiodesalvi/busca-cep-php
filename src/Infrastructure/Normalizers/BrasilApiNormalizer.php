<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Override;

final class BrasilApiNormalizer implements NormalizerInterface
{
    #[Override]
    public function normalize(
        array $data
    ): Address {
        return new Address(
            cep: (string)( $data['cep'] ?? ''),
            street: (string) ($data['street'] ?? ''),
            complement: '',
            district: (string) ($data['neighborhood'] ?? ''),
            city: (string) ($data['city'] ?? ''),
            state: (string) ($data['state'] ?? ''),
            ibge: '',
            gia: '',
            ddd: '',
            siafi: '',
            provider: Provider::BRASIL_API
        );
    }
}
