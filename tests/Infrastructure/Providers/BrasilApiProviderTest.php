<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\HttpClientInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\ProviderException;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Response;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\BrasilApiProvider;
use PHPUnit\Framework\TestCase;

final class BrasilApiProviderTest extends TestCase
{
    public function testShouldSearchCepSucessfully(): void
    {
        $response = new Response(
            200,
            json_encode([
                'cep' => '01001000',
                'state' => 'SP',
                'city' => 'São Paulo',
                'neighborhood' => 'Sé',
                'street' => 'Praça da Sé',
                'service' => 'open-cep',
                'timezoneName' => null,
                'location' => [
                    'type' => 'Point',
                    'coordinates' => []
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

        $provider = new BrasilApiProvider($client);

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

        $provider = new BrasilApiProvider($client);

        $this->expectException(
            ProviderException::class
        );

        $provider->search(
            new Cep('01001000')
        );
    }
}



// {
//  "cep": "01001000",
//  "state": "SP",
//  "city": "São Paulo",
//  "neighborhood": "Sé",
//  "street": "Praça da Sé",
//  "service": "open-cep",
//  "timezoneName": null,
//  "location": {
//      "type": "Point",
//      "coordinates": {}
//  }
// }

// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Providers/BrasilApiProviderTest.php
