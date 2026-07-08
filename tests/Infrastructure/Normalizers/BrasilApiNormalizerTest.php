<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\BrasilApiNormalizer;
use PHPUnit\Framework\TestCase;

final class BrasilApiNormalizerTest extends TestCase
{
    public function testShouldNormalizeBrasilApiResponse(): void
    {
        $data = [
            'cep' => '01001000',
            'street' => 'Praça da Sé',
            // 'complement' => '',
            'neighborhood' => 'Sé',
            'city' => 'São Paulo',
            'state' => 'SP',
            // 'ibge' => '',
            // 'gia' => '',
            // 'ddd' => '',
            // 'siafi' => '',
            'provider' => 'BrasilAPI',
        ];

        $normalizer = new BrasilApiNormalizer();

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
            '',
            $address->ibge()
        );

        $this->assertSame(
            '',
            $address->gia()
        );

        $this->assertSame(
            '',
            $address->ddd()
        );

        $this->assertSame(
            '',
            $address->siafi()
        );

        $this->assertSame(
            'BrasilAPI',
            $address->provider()->label()
        );
    }
}



// Brasil API     : Praça da Sé, Sé - São Paulo/SP
// CEP: 01001000
// Logradouro: Praça da Sé
// Complemento:
// Bairro: Sé
// Cidade: São Paulo
// UF: SP
// IBGE:
// GIA:
// DDD:
// SIAFI:
// Provider: BrasilAPI


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/BrasilApiNormalizerTest.php
