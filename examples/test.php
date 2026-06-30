<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\CepSearch;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\HttpClient;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\BrasilApiNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\OpenCepNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\ViaCepNormalizer;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\BrasilApiProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\OpenCepProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\ViaCepProvider;

$cep = new CepSearch();

var_dump($cep);

// Via Cep
$viaCepProvider = new ViaCepProvider(
    new HttpClient(),
    new ViaCepNormalizer
);

var_dump($viaCepProvider);


$addressViaCep = $viaCepProvider->search(
    new Cep('01001000')
);

echo $addressViaCep->__toString() . "\n";


// Brasil API
$brasilApiProvider = new BrasilApiProvider(
    new HttpClient(),
    new BrasilApiNormalizer
);

var_dump($brasilApiProvider);

$addressBrasilApi = $brasilApiProvider->search(
    new Cep('01001000')
);

echo $addressBrasilApi->__toString() . "\n";

// Open CEP
$openCepProvider = new openCepProvider(
    new HttpClient(),
    new OpenCepNormalizer
);

var_dump($openCepProvider);

$addressOpenCep = $openCepProvider->search(
    new Cep('01001000')
);

echo $addressOpenCep->__toString() . "\n";