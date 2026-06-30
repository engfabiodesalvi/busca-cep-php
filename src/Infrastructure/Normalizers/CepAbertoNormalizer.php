<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Override;

final class CepAbertoNormalizer implements NormalizerInterface
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
            city: $data['cidade']['nome'] ?? '',
            state: $data['estado']['sigla'] ?? '',
            ibge: $data['cidade']['ibge'] ?? '',
            gia: '',
            ddd: $data['cidade ']['ddd'] ?? '',
            siafi: '',
            provider: Provider::CEP_ABERTO
        );
    }
}

// {
// 	"altitude": 760.0,
// 	"cep": "01001000",
// 	"latitude": "-23.5479099981",
// 	"longitude": "-46.636",
// 	"logradouro": "Praça da Sé",
// 	"bairro": "Sé",
// 	"complemento": "- lado ímpar",
// 	"cidade": {
// 		"ddd": 11,
// 		"ibge": "3550308",
// 		"nome": "São Paulo"
// 	},
// 	"estado": {
// 		"sigla": "SP"
// 	}
// }