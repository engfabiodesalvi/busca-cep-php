<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\Application\Services\CepService;
use Engfabiodesalvi\BuscaCepPhp\CepSearch;
use Engfabiodesalvi\BuscaCepPhp\Config\Config;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Factory\ProviderFactory;


Config::set(
    'cepaberto_token',
    '' // your_token_here
);

// $token = Config::get('cepaberto_token');

// echo "Token (Cep Aberto): " . $token . PHP_EOL;


$cepSearch = new CepSearch();

$address = $cepSearch->search('01001000');

echo 'CEP: ' . $address->cep() . PHP_EOL;
echo 'Logradouro: ' . $address->street() . PHP_EOL;
echo 'Complemento: ' . $address->complement() . PHP_EOL;
echo 'Bairro: ' . $address->district() . PHP_EOL;
echo 'Cidade: ' . $address->city() . PHP_EOL;
echo 'UF: ' . $address->state() . PHP_EOL;
echo 'IBGE: ' . $address->ibge() . PHP_EOL;
echo 'DDD: ' . $address->ddd() . PHP_EOL;
echo 'SIAFI: ' . $address->siafi() . PHP_EOL;
echo 'Provider: ' . $address->provider()->label() .  PHP_EOL;
