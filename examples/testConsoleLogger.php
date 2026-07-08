<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Application\Services\CepService;
use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\CepException;
use Engfabiodesalvi\BuscaCepPhp\Factory\ProviderFactory;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Logging\ConsoleLogger;

try {

    // $factory = (new ProviderFactory())->create();

    $factory = new ProviderFactory();

    $service = new CepService(
        $factory->create(),
        new ConsoleLogger()
    );

    $cep = '01001000';

    $address = $service->search(
        new Cep($cep)
    );

    echo "CEP: " . $address->cep() . "\n";
    echo "Cidade: " . $address->city() . "\n";

} catch (CepException $e) {

    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}    
