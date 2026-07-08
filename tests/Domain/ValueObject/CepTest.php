<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\tests\Domain\ValueObject;

use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\InvalidCepException;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use PHPUnit\Framework\TestCase;

final class CepTest extends TestCase
{
    // Criar um CEP válido
    public function testShouldCreateValidCep(): void
    {
        $cep = new Cep('01001000');

        $this->assertSame(
            '01001000',
            $cep->value()
        );
    }

    // Remover a máscara de um CEP
    public function testShouldRemoveMask(): void
    {
        $cep = new Cep('01001-000');

        $this->assertSame(
            '01001000',
            $cep->value()
        );
    }

    // Remoção de espaços
    public function testShouldRemoveSpaces(): void
    {
        $cep = new Cep(' 01001-000 ');

        $this->assertSame(
            '01001000',
            $cep->value()
        );
    }

    // Lançamento de excessão para CEP vazio
    public function testShouldThrowExceptionForEmptyCep(): void
    {
        $this->expectException(
            InvalidCepException::class
        );

        new Cep('');
    }

    // Lançamento de excessão para tamanho incorreto da variável CEP
    public function testShouldThrowExceptionForInvalidLength(): void
    {
        $this->expectException(
            InvalidCepException::class
        );

        new Cep('123');
    }

    // Lançamento de excessão para letras enviadas dentro da variável CEP
    public function testShouldThrowExceptionForLetters(): void
    {
        $this->expectException(
            InvalidCepException::class
        );

        new Cep('ABC12345');
    }

    // Aceitar somente números após normalização
    public function testShouldNormalizeCep(): void
    {
        $cep = new Cep('01.001-000');

        $this->assertSame(
            '01001000',
            $cep->value()
        );
    }
}


// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Domain/ValueObject/CepTest.php
