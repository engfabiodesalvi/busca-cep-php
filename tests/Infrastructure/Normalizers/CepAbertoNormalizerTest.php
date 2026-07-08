<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\CepAbertoNormalizer;
use PHPUnit\Framework\TestCase;

final class CepAbertoNormalizerTest extends TestCase
{
    public function testShouldNormalizeCepAbertoResponse(): void
    {
        $data = [
            'cep' => '01001000',
            'logradouro' => 'Praça da Sé',
            'complemento' => '- lado ímpar',
            'bairro' => 'Sé',
            'cidade' => [
                'nome' => 'São Paulo',
                'ibge' => '3550308',
                'ddd' => '11'
            ],
            'estado' => ['sigla' => 'SP'],
            // 'cidade' => ['ibge' => '3550308'],
            // 'gia' => '',
            // 'ddd' => '11',
            // 'siafi' => '',
            'provider' => 'CEPAberto',
        ];

        $normalizer = new CepAbertoNormalizer();

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
            '- lado ímpar',
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
            'CEPAberto',
            $address->provider()->label()
        );
    }
}

// CEP Aberto     : Praça da Sé, Sé - São Paulo/SP
// CEP: 01001000
// Logradouro: Praça da Sé
// Complemento: - lado ímpar
// Bairro: Sé
// Cidade: São Paulo
// UF: SP
// IBGE: 3550308
// GIA:
// DDD: 11
// SIAFI:
// Provider: CEPAberto

// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/CepAbertoNormalizerTest.php
