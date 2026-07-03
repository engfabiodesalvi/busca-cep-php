<?php

declare(strict_types=1);

use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Factory\ProviderFactory;

require_once __DIR__ . '/../vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\ViaCepProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\HttpClient;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\AwesomeApiProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\BrasilApiProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\CepAbertoProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\OpenCepProvider;

// $collection = new ProviderCollection();

// $collection->add(
//     new ViaCepProvider(
//         new HttpClient()
//     )
// );

// $collection->add(
//     new BrasilApiProvider(
//         new HttpClient()
//     )
// );

// $collection->add(
//     new OpenCepProvider(
//         new HttpClient()
//     )
// );

// $collection->add(
//     new AwesomeApiProvider(
//         new HttpClient()
//     )
// );

// $collection->add(
//     new CepAbertoProvider(
//         new HttpClient()
//     )
// );

// foreach ($collection as $provider) {

//     echo $provider->getName() . "\n";

// }


// FactoryProvider substitui a sequencia de código acima
$factory = (new ProviderFactory())->create();

foreach ($factory as $provider) {

    echo $provider->getName() . "\n";

}