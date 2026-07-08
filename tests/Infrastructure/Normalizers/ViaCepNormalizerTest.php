<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\ViaCepNormalizer;
use PHPUnit\Framework\TestCase;

final class ViaCepNormalizerTest extends TestCase
{
    public function testShouldNormalizeViaCepResponse(): void
    {
        $data = [
            'cep' => '01001-000',
            'logradouro' => 'Praça da Sé',
            'complemento' => 'lado ímpar',
            'bairro' => 'Sé',
            'localidade' => 'São Paulo',
            'uf' => 'SP',
            'ibge' => '3550308',
            'gia' => '1004',
            'ddd' => '11',
            'siafi' => '7107',
            'provider' => 'ViaCEP',
        ];

        $normalizer = new ViaCepNormalizer();

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
            '1004',
            $address->gia()
        );

        $this->assertSame(
            '11',
            $address->ddd()
        );

        $this->assertSame(
            '7107',
            $address->siafi()
        );

        $this->assertSame(
            'ViaCEP',
            $address->provider()->label()
        );
    }
}

// Via Cep        : Praça da Sé, Sé - São Paulo/SP
// CEP: 01001-000
// Logradouro: Praça da Sé
// Complemento: lado ímpar
// Bairro: Sé
// Cidade: São Paulo
// UF: SP
// IBGE: 3550308
// GIA: 1004
// DDD: 11
// SIAFI: 7107
// Provider: ViaCEP


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/ViaCepNormalizerTest.php
