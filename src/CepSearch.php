<?php

// Responsabilidades

// A Facade possui apenas duas responsabilidades:
// - criar os componentes necessários;
// - delegar a execução para o CepService.
// Não possui regras de negócio.

// Força a declaração dos tipos das variáveis, evitando erros inesperados de conversão automática de tipos de variáveis.
declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp;

use Engfabiodesalvi\BuscaCepPhp\Application\Services\CepService;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Factory\ProviderFactory;

// Classe que representa a principal porta de entrada da bibliteca.
// Utilizar "final" evita mudanças indevidas e força extençao por composição, prática comum em biblitecas modernas
final class CepSearch
{
    private CepService $service;

    public function __construct()
    {
        $factory = new ProviderFactory();

        $this->service = new CepService(
            $factory->create()
        );
    }

    public function search(string $cep): Address
    {
        return $this->service->search(
            new Cep($cep)
        );
    }
}