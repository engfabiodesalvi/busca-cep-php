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
    ): Address
    {
       
        return new Address(
            
            cep: $data['cep'] ?? '',

            street: $data['logradouro'] ?? '',

            complement: $data['complemento'] ?? '',

            district: $data['bairro'] ?? '',

            city: $data['localidade'] ?? '',

            state: $data['uf'] ?? '',

            ibge: $data['ibge'] ?? '',

            gia: '',

            ddd: '',

            siafi: '',

            provider: Provider::OPEN_CEP
        );
    }
}