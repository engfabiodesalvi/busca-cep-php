<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\CepSearch;
use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Config\Config;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\CepException;
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

function printAddress(Address $address): void
{
    echo 'CEP: ' . $address->cep() . PHP_EOL;
    echo 'Logradouro: ' . $address->street() . PHP_EOL;
    echo 'Complemento: ' . $address->complement() . PHP_EOL;
    echo 'Bairro: ' . $address->district() . PHP_EOL;
    echo 'Cidade: ' . $address->city() . PHP_EOL;
    echo 'UF: ' . $address->state() . PHP_EOL;
    echo 'IBGE: ' . $address->ibge() . PHP_EOL;
    echo 'GIA: ' . $address->gia() . PHP_EOL;
    echo 'DDD: ' . $address->ddd() . PHP_EOL;
    echo 'SIAFI: ' . $address->siafi() . PHP_EOL;
    echo 'Provider: ' . $address->provider()->label() .  PHP_EOL;    
}

$cep = new CepSearch();

// var_dump($cep);

//-------------------

try{

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

    printAddress($addressViaCep);

} catch (CepException $e) {

    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}

//-------------------

try {

    // Brasil API
    $brasilApiProvider = new BrasilApiProvider(
        new HttpClient()
    );

    // var_dump($brasilApiProvider);

    $addressBrasilApi = $brasilApiProvider->search(
        new Cep('01001000')
    );

    echo sprintf("%-15s", "Brasil API") . ": " . $addressBrasilApi->__toString() . "\n";

    printAddress($addressBrasilApi);

} catch (CepException $e) {

    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}

//-------------------

try {

    // Open CEP
    $openCepProvider = new OpenCepProvider(
        new HttpClient()
    );

    // var_dump($openCepProvider);

    $addressOpenCep = $openCepProvider->search(
        new Cep('01001000')
    );

    echo sprintf("%-15s", "Open CEP") . ": " . $addressOpenCep->__toString() . "\n";

    printAddress($addressOpenCep);

} catch (CepException $e) {

    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}

//-------------------

try {

    // Awesome API

    $awesomeApiProvider = new AwesomeApiProvider(
        new HttpClient()
    );

    // var_dump($awesomeApiProvider);

    $addressAwesomeApi = $awesomeApiProvider->search(
        new Cep('01001000')
    );

    echo sprintf("%-15s", "Awesome API") . ": " . $addressAwesomeApi->__toString() . "\n";

    printAddress($addressAwesomeApi);

} catch (CepException $e) {

    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}

//-------------------    

try {

    // CEP Aberto

    // Configura o token
    Config::set(
        'cepaberto_token',
        '' // your_token_here
    );    

    $cepAbertoProvider = new CepAbertoProvider(
        new HttpClient()
    );

    // var_dump($cepAbertoProvider);

    $addressCepAberto = $cepAbertoProvider->search(
        new Cep('01001000')
    );

    echo sprintf("%-15s", "CEP Aberto") . ": " . $addressCepAberto->__toString() . "\n";

    printAddress($addressCepAberto);

} catch (CepException $e) {

    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}

//-------------------