<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\CepSearch;
use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\HttpClient;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\AwesomeApiNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\BrasilApiNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\CepAbertoNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\OpenCepNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\ViaCepNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\AwesomeApiProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\BrasilApiProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\CepAbertoProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\OpenCepProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\ViaCepProvider;

$cep = new CepSearch();

// var_dump($cep);

// Via Cep
$viaCepProvider = new ViaCepProvider(
    new HttpClient()
);

// var_dump($viaCepProvider);


$addressViaCep = $viaCepProvider->search(
    new Cep('01001000')
);

// echo $addressViaCep->toJson() . "\n";
echo sprintf("%-15s", "Via Cep") . ": " . $addressViaCep->__toString() . "\n";


// Brasil API
$brasilApiProvider = new BrasilApiProvider(
    new HttpClient()
);

// var_dump($brasilApiProvider);

$addressBrasilApi = $brasilApiProvider->search(
    new Cep('01001000')
);

echo sprintf("%-15s", "Brasil API") . ": " . $addressBrasilApi->__toString() . "\n";

// Open CEP
$openCepProvider = new OpenCepProvider(
    new HttpClient()
);

// var_dump($openCepProvider);

$addressOpenCep = $openCepProvider->search(
    new Cep('01001000')
);

echo sprintf("%-15s", "Open CEP") . ": " . $addressOpenCep->__toString() . "\n";

// Awesome API

$awesomeApiProvider = new AwesomeApiProvider(
    new HttpClient()
);

// var_dump($awesomeApiProvider);

$addressAwesomeApi = $awesomeApiProvider->search(
    new Cep('01001000')
);

echo sprintf("%-15s", "Awesome API") . ": " . $addressAwesomeApi->__toString() . "\n";

// CEP Aberto

$cepAbertoProvider = new CepAbertoProvider(
    new HttpClient()
);

// var_dump($cepAbertoProvider);

$addressCepAberto = $cepAbertoProvider->search(
    new Cep('01001000')
);

echo sprintf("%-15s", "CEP Aberto") . ": " . $addressCepAberto->__toString() . "\n";
