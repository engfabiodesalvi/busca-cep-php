<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Integration;

use Engfabiodesalvi\BuscaCepPhp\CepSearch;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CepSearchIntegrationTest extends TestCase
{
    //#[Test] // para funções que não iniciam com 'test'
    public function testShouldSearchCepSuccessfully(): void
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

        // $this->assertSame(
        //     'Praça da Sé',
        //     $address->street()
        // );

        $this->assertNotEmpty(
            $address->street()
        );

        // $this->assertSame(
        //     'lado ímpar',
        //     $address->complement()
        // );

        // $this->assertSame(
        //     'Sé',
        //     $address->district()
        // );

        $this->assertNotEmpty(
            $address->district()
        );

        // $this->assertSame(
        //     'São Paulo',
        //     $address->city()
        // );

        $this->assertNotEmpty(
            $address->city()
        );

        // $this->assertSame(
        //     'SP',
        //     $address->state()
        // );

        $this->assertNotEmpty(
            $address->state()
        );

        // $this->assertSame(
        //     '3550308',
        //     $address->ibge()
        // );

        // $this->assertSame(
        //     '1004',
        //     $address->gia()
        // );

        // $this->assertSame(
        //     '11',
        //     $address->ddd()
        // );

        // $this->assertSame(
        //     '7107',
        //     $address->siafi()
        // );

        // $this->assertSame(
        //     'ViaCEP',
        //     $address->provider()->label()
        // );

        $this->assertNotEmpty(
            $address->provider()->label()
        );
    }
}


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Integration/CepSearchIntegrationTest.php
