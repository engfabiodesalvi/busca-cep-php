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
    ): Address
    {
        return new Address(
            cep: $data['cep'] ?? '',
            street: $data['street'] ?? '',
            complement: '',
            district: $data['neighborhood'] ?? '',
            city: $data['city'] ?? '',
            state: $data['state'] ?? '',
            ibge: '',
            gia: '',
            ddd: '',
            siafi: '',
            provider: Provider::BRASIL_API
        );
    }
}