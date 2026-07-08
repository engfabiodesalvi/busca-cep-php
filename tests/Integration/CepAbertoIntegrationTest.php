<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Integration;

use Engfabiodesalvi\BuscaCepPhp\Config\Config;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\HttpClient;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\CepAbertoProvider;
use PHPUnit\Framework\TestCase;

final class ACepAbertoIntegrationTest extends TestCase
{
    public function testShouldSearchCepUsingCepAberto(): void
    {

        // Configura o token
        Config::set(
            'cepaberto_token',
            '' // your_token_here
        );

        $provider = new CepAbertoProvider(
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

    public function testShouldReturnAddressObject(): void
    {
        $provider = new CepAbertoProvider(
            new HttpClient()
        );

        $address = $provider->search(
            new Cep('01001000')
        );

        $this->assertInstanceOf(
            Address::class,
            $address
        );
    }

    public function testShouldReturnValidAddressData(): void
    {
        $provider = new CepAbertoProvider(
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


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Integration/CepAbertoIntegrationTest.php
