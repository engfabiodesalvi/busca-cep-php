<?php

// Este teste precisa ser modificado para funcinar devido à classe search() ter o atributo final

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Application\Services;

use Engfabiodesalvi\BuscaCepPhp\Application\Services\CepService;
use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\AbstractProvider;
use PHPUnit\Framework\TestCase;

final class CepServiceTest extends TestCase
{
    public function testShouldUseFirstAvailableProvider(): void
    {
        $provider = $this->createMock(AbstractProvider::class);

        $provider
            ->expects($this->once())
            ->method('search')
            ->with($this->isInstanceOf(Cep::class))
            ->willReturn(
                new Address(
                    cep: "01001-000",
                    street: "Praça da Sé",
                    complement: "lado ímpar",
                    district: "Sé",
                    city: "São Paulo",
                    state: "SP",
                    ibge: "3550308",
                    gia: "1004",
                    ddd: "11",
                    siafi: "7107",
                    provider: Provider::VIA_CEP
                )
            );

        $providers = new ProviderCollection([
            $provider
        ]);

        $service = new CepService($providers);

        $address = $service->search(
            new Cep('01001000')
        );

        $this->assertInstanceOf(
            Address::class,
            $address
        );

        $this->assertSame(
            'ViaCEP',
            $address->provider()->label()
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
// $ ./vendor/bin/phpunit tests/Application/Services/CepServiceTest.php
