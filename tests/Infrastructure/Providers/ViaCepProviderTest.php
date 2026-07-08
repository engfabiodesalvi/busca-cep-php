<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\HttpClientInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\ProviderException;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Response;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\ViaCepProvider;
use PHPUnit\Framework\TestCase;

final class ViaCepProviderTest extends TestCase
{
    public function testShouldSearchCepSucessfully(): void
    {
        $response = new Response(
            200,
            json_encode([
                'cep' => '01001-000',
                'logradouro' => 'Praça da Sé',
                'complemento' => 'lado ímpar',
                'unidade' => '',
                'bairro' => 'Sé',
                'localidade' => 'São Paulo',
                'uf' => 'SP',
                'estado' => 'São Paulo',
                'regiao' => 'Sudeste',
                'ibge' => '3550308',
                'gia' => '1004',
                'ddd' => '11',
                'siafi' => '7107'
            ]),
            []
        );

        $client = $this->createMock(
            HttpClientInterface::class
        );

        $client
            ->expects($this->once())
            ->method('send')
            ->with(
                $this->isInstanceOf(
                    Request::class
                )
            )
            ->willReturn($response);

        $provider = new ViaCepProvider($client);

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

    public function testShouldThrowProviderExceptionWhenHttpFails(): void
    {
        $response = new Response(
            500,
            '{}',
            []
        );

        $client = $this->createMock(
            HttpClientInterface::class
        );

        $client
            ->expects($this->once())
            ->method('send')
            ->willReturn($response);

        $provider = new ViaCepProvider($client);

        $this->expectException(
            ProviderException::class
        );

        $provider->search(
            new Cep('01001000')
        );
    }
}



// {
//  "cep": "01001-000",
//  "logradouro": "Praça da Sé",
//  "complemento": "lado ímpar",
//  "unidade": "",
//  "bairro": "Sé",
//  "localidade": "São Paulo",
//  "uf": "SP",
//  "estado": "São Paulo",
//  "regiao": "Sudeste",
//  "ibge": "3550308",
//  "gia": "1004",
//  "ddd": "11",
//  "siafi": "7107"
// }


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Providers/ViaCepProviderTest.php
