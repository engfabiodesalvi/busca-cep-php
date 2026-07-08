<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\HttpClientInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\ProviderException;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Response;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\CepAbertoProvider;
use PHPUnit\Framework\TestCase;

final class CepAbertoProviderTest extends TestCase
{
    public function testShouldSearchCepSucessfully(): void
    {
        $response = new Response(
            200,
            json_encode([
                'altitude' => 760.0,
                'cep' => '01001000',
                'latitude' => '-23.5479099981',
                'longitude' => '-46.636',
                'logradouro' => 'Praça da Sé',
                'bairro' => 'Sé',
                'complemento' => '- lado ímpar',
                'cidade' => [
                    'ddd' => 11,
                    'ibge' => '3550308',
                    'nome' => 'São Paulo'
                ],
                'estado' => [
                    'sigla' => 'SP'
                ]
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

        $provider = new CepAbertoProvider($client);

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

        $provider = new CepAbertoProvider($client);

        $this->expectException(
            ProviderException::class
        );

        $provider->search(
            new Cep('01001000')
        );
    }
}



// {
//  "altitude": 760.0,
//  "cep": "01001000",
//  "latitude": "-23.5479099981",
//  "longitude": "-46.636",
//  "logradouro": "Praça da Sé",
//  "bairro": "Sé",
//  "complemento": "- lado ímpar",
//  "cidade": {
//      "ddd": 11,
//      "ibge": "3550308",
//      "nome": "São Paulo"
//  },
//  "estado": {
//      "sigla": "SP"
//  }
// }

// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Providers/CepAbertoProviderTest.php
