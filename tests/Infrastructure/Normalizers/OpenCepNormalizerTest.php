<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\OpenCepNormalizer;
use PHPUnit\Framework\TestCase;

final class OpenCepNormalizerTest extends TestCase
{
    public function testShouldNormalizeOpenCepResponse(): void
    {
        $data = [
            'cep' => '01001-000',
            'logradouro' => 'Praça da Sé',
            'complemento' => 'lado ímpar',
            'bairro' => 'Sé',
            'localidade' => 'São Paulo',
            'uf' => 'SP',
            'ibge' => '3550308',
            // 'gia' => '',
            // 'ddd' => '',
            // 'siafi' => '',
            'provider' => 'OpenCEP',
        ];

        $normalizer = new OpenCepNormalizer();

        $address = $normalizer->normalize($data);

        $this->assertInstanceOf(
            Address::class,
            $address
        );

        $this->assertSame(
            '01001-000',
            $address->cep()
        );

        $this->assertSame(
            'Praça da Sé',
            $address->street()
        );

        $this->assertSame(
            'lado ímpar',
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
            '',
            $address->ddd()
        );

        $this->assertSame(
            '',
            $address->siafi()
        );

        $this->assertSame(
            'OpenCEP',
            $address->provider()->label()
        );
    }
}

// Open CEP       : Praça da Sé, Sé - São Paulo/SP
// CEP: 01001-000
// Logradouro: Praça da Sé
// Complemento: lado ímpar
// Bairro: Sé
// Cidade: São Paulo
// UF: SP
// IBGE: 3550308
// GIA:
// DDD:
// SIAFI:
// Provider: OpenCEP


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/OpenCepNormalizerTest.php
