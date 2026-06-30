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
            cep: $data['cep'] ?? '',
            street: $data['address'] ?? '',
            complement: '',
            district: $data['district'] ?? '',
            city: $data['city'] ?? '',
            state: $data['state'] ?? '',
            ibge: $data['city_ibge'] ?? '',
            gia: '',
            ddd: $data['ddd'] ?? '',
            siafi: '',
            provider: Provider::AWESOME_API
        );        
    }
}

// {
// 	"cep": "01001000",
// 	"address_type": "Praça",
// 	"address_name": "da Sé",
// 	"address": "Praça da Sé",
// 	"state": "SP",
// 	"district": "Sé",
// 	"lat": "-23.5500806",
// 	"lng": "-46.6340827",
// 	"city": "São Paulo",
// 	"city_ibge": "3550308",
// 	"ddd": "11"
// }