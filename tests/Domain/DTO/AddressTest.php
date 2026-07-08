<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Domain\DTO;

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\ViaCepProvider;
use PHPUnit\Framework\TestCase;

final class AddressTest extends TestCase
{
    // Criação de um Address
    public function testShouldCreateAddress(): void
    {
        $address = new Address(
            cep: '01001000',
            street: 'Praça da Sé',
            complement: 'lado ímpar',
            district: 'Sé',
            city: 'São Paulo',
            state: 'SP',
            ibge: '3550308',
            gia: '',
            ddd: '11',
            siafi: '7107',
            provider: Provider::VIA_CEP
        );

        $this->assertInstanceOf(
            Address::class,
            $address
        );
    }

    // Retorno de um CEP
    public function testShouldReturnCep(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            '01001000',
            $address->cep()
        );
    }

    // Retorno do logradouro
    public function testShouldReturnStreet(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            'Praça da Sé',
            $address->street()
        );
    }

    // Retorno do complemento
    public function testShouldReturnCmplement(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            'lado ímpar',
            $address->complement()
        );
    }

    // Retorno do Bairro
    public function testShouldReturnDistrict(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            'Sé',
            $address->district()
        );
    }

    // Retorno da cidade
    public function testShouldReturnCity(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            'São Paulo',
            $address->city()
        );
    }

    // Retorno do estado
    public function testShouldReturnState(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            'SP',
            $address->state()
        );
    }

    // Retorno do código IBGE
    public function testShouldReturnIbge(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            '3550308',
            $address->ibge()
        );
    }

    // Retorno do código GIA
    public function testShouldReturnGia(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            '',
            $address->gia()
        );
    }

    // Retorno do código DDD
    public function testShouldReturnDdd(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            '11',
            $address->ddd()
        );
    }

    // Retorno do código SIAFI
    public function testShouldReturnSiafi(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            '7107',
            $address->siafi()
        );
    }

    // Retorno do Provider
    public function testShouldReturnProvider(): void
    {
        $address = $this->createAddress();

        $this->assertSame(
            'ViaCEP',
            $address->provider()->label()
        );
    }

    // Criando um endereço.
    private function createAddress(): Address
    {
        return new Address(
            cep: '01001000',
            street: 'Praça da Sé',
            complement: 'lado ímpar',
            district: 'Sé',
            city: 'São Paulo',
            state: 'SP',
            ibge: '3550308',
            gia: '',
            ddd: '11',
            siafi: '7107',
            provider: Provider::VIA_CEP
        );
    }
}

// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Domain/DTO/AddressTest.php

// CEP: 01001-000
// Logradouro: Praça da Sé
// Complemento: lado ímpar
// Bairro: Sé
// Cidade: São Paulo
// UF: SP
// IBGE: 3550308
// DDD: 11
// SIAFI: 7107
// Provider: ViaCEP
