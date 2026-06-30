<?php

// Esta classe Object Value é responsável por:
// - Validar o CEP
// - Remover a máscara
// - verificar tamanho da string
// - mantém apenas os números da string
// - criar um objeto válido 
//
// Objeto nunca será inválido (imutabilidade).
// Após o objeto ser criado não é possível modificar o seu valor.
// Desta forma este 'objeto value' é imutável.
// Uso de 'final' e 'readonly' são recursos modernos do PHP 8.2 que reforçam a imutabilidade do objeto

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject;

use Engfabiodesalvi\BuscaCepPhp\Exceptions\InvalidCepException;

final readonly class Cep
{
    private string $value;

    public function __construct(string $cep)    
    {        
        $cep = preg_replace('/\D/', '', $cep);

        if ($cep === null || strlen($cep) !== 8) {
            // throw new InvalidCepException(
            //     'CEP inválido.'
            // );
            throw new \Exception('CEP inválido.');
        }        

        $this->value = $cep;        
    }

    // Retorna o CEP armazenado: '01001000'
    public function value(): string
    {
        return $this->value;
    }
    
    // Retorna o CEP armazenado: '01001000'
    public function toString(): string
    {
        return $this->value;
    }

    // Retorna o CEP com máscara: '01001-000'
    public function withMask(): string
    {
        return substr($this->value, 0, 5)
            . '-'
            . substr($this->value, 5);
    }

    // Retorna o CEP sem máscara: '01001-000'
    public function withoutMask(): string
    {
        return $this->value;
    }

    // Compara CEPs
    public function equals(
        Cep $other
    ): bool
    {
        return $this->value === $other->value;
    }
}