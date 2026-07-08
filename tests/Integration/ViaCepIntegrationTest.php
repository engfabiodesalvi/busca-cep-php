<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Integration;

use Engfabiodesalvi\BuscaCepPhp\CepSearch;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\HttpClient;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\ViaCepProvider;
use PHPUnit\Framework\TestCase;

final class ViaCepIntegrationTest extends TestCase
{
    public function testShouldSearchCepUsingViaCep(): void
    {
        $provider = new ViaCepProvider(
            new HttpClient()
        );

        $address = $provider->search(
            new Cep('01001000')
        );

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

    public function testShouldReturnAddressObject(): void
    {
        $cepSearch = new CepSearch();

        $address = $cepSearch->search(
            '01001000'
        );

        $this->assertInstanceOf(
            Address::class,
            $address
        );
    }

    public function testShouldReturnValidAddressData(): void
    {
        $cepSearch = new CepSearch();

        $address = $cepSearch->search(
            '01001000'
        );

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


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Integration/ViaCepIntegrationTest.php
