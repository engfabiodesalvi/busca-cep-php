<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Application\Services\CepService;
use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Factory\ProviderFactory;


// $factory = (new ProviderFactory())->create();

$factory = new ProviderFactory();

$service = new CepService(
    $factory->create()
);

$cep = '01001000';

$address = $service->search(
    new Cep($cep)
);

echo "CEP: " . $address->cep() . "\n";
echo "Cidade: " . $address->city() . "\n";


// Criando um serviço com uma coleção de provedores vazia
$service2 = new CepService(
    new ProviderCollection()
);

// Lançamento de excessão
$address2 = $service2->search(
    new Cep($cep)
);