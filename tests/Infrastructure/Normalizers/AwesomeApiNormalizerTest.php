<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\AwesomeApiNormalizer;
use PHPUnit\Framework\TestCase;

final class AwesomeApiNormalizerTest extends TestCase
{
    public function testShouldNormalizeAwesomeApiResponse(): void
    {
        $data = [
            'cep' => '01001000',
            'address' => 'Praça da Sé',
            //'complement' => '',
            'district' => 'Sé',
            'city' => 'São Paulo',
            'state' => 'SP',
            'city_ibge' => '3550308',
            //'gia' => '',
            'ddd' => '11',
            //'siafi' => '',
            'provider' => 'AwesomeAPI',
        ];

        $normalizer = new AwesomeApiNormalizer();

        $address = $normalizer->normalize($data);

        $this->assertInstanceOf(
            Address::class,
            $address
        );

        $this->assertSame(
            '01001000',
            $address->cep()
        );

        $this->assertSame(
            'Praça da Sé',
            $address->street()
        );

        $this->assertSame(
            '',
            $address->complement()
        );

        $this->assertSame(
            'Sé',
            $address->district()
        );

        $this->assertSame(
            'São Paulo',
            $address->city()
        );

        $this->assertSame(
            'SP',
            $address->state()
        );

        $this->assertSame(
            '3550308',
            $address->ibge()
        );

        $this->assertSame(
            '',
            $address->gia()
        );

        $this->assertSame(
            '11',
            $address->ddd()
        );

        $this->assertSame(
            '',
            $address->siafi()
        );

        $this->assertSame(
            'AwesomeAPI',
            $address->provider()->label()
        );
    }
}

// Awesome API    : Praça da Sé, Sé - São Paulo/SP
// CEP: 01001000
// Logradouro: Praça da Sé
// Complemento:
// Bairro: Sé
// Cidade: São Paulo
// UF: SP
// IBGE: 3550308
// GIA:
// DDD: 11
// SIAFI:
// Provider: AwesomeAPI

// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/AwesomeApiNormalizerTest.php
