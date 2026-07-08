<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Override;

final class AwesomeApiNormalizer implements NormalizerInterface
{
    #[Override]
    public function normalize(
        array $data
    ): Address {

        return new Address(
            cep: (string) ($data['cep'] ?? ''),
            street: (string) ($data['address'] ?? ''),
            complement: '',
            district: (string) ($data['district'] ?? ''),
            city: (string) ($data['city'] ?? ''),
            state: (string) ($data['state'] ?? ''),
            ibge: (string) ($data['city_ibge'] ?? ''),
            gia: '',
            ddd: (string) ($data['ddd'] ?? ''),
            siafi: '',
            provider: Provider::AWESOME_API
        );
    }
}

// {
//  "cep": "01001000",
//  "address_type": "Praça",
//  "address_name": "da Sé",
//  "address": "Praça da Sé",
//  "state": "SP",
//  "district": "Sé",
//  "lat": "-23.5500806",
//  "lng": "-46.6340827",
//  "city": "São Paulo",
//  "city_ibge": "3550308",
//  "ddd": "11"
// }
