<?php

// Todo provedor deverá implementar esta classe
// Responsabilidades:
// - consultar um CEP
// - informar seu nome
// - informar se está disponível

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Contracts;

// Verificar a inclusão em pasta Domain
// use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
// use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\ValueObject\Cep;

interface ProviderInterface
{
    /**
     * Nome do provedor.
     */
    public function getName(): string;

    /**
     * Consulta um CEP.
     * 
     * @throws \Engfabiodesalvi\BuscaCepPhp\Exceptions\ProviderException
     */
    // Passar um objeto Value Object Cep como argumento garante um CEP válido
    //public function search(Cep $cep): Address;

    /**
     * Verifica se o serviço está disponível.
     */
    // Verifica se o serviço esta operacinal antes de tentar consultar
    public function isAvailable(): bool;
}