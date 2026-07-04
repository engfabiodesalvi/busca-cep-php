<?php

// Responsabilidades

// O serviço deverá:
// - receber uma ProviderCollection;
// - validar se existe pelo menos um provedor disponível;
// - selecionar um provedor;
// - delegar a consulta;
// - devolver um Address.

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Application\Services;

use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\ProviderException;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;

final class CepService
{
    public function __construct(
        private readonly ProviderCollection $providers
    )
    {        
    }

    public function search(Cep $cep): Address
    {
        if ($this->providers->isEmpty()) {
            // throw new ProviderException(
            throw new \Exception(
                'Nenhum provider foi configurado.'
            );
        }
        
        $provider = $this->providers->all()[0];

        return $provider->search($cep);
    }    
}