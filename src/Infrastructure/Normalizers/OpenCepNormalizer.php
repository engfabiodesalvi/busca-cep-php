<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Override;

final class OpenCepNormalizer implements NormalizerInterface
{
    #[Override]
    public function normalize(
        array $data
    ): Address {

        return new Address(
            cep: (string) ($data['cep'] ?? ''),
            street: (string) ($data['logradouro'] ?? ''),
            complement: (string) ($data['complemento'] ?? ''),
            district: (string) ($data['bairro'] ?? ''),
            city: (string) ($data['localidade'] ?? ''),
            state: (string) ($data['uf'] ?? ''),
            ibge: (string) ($data['ibge'] ?? ''),
            gia: '',
            ddd: '',
            siafi: '',
            provider: Provider::OPEN_CEP
        );
    }
}
