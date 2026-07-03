<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Factory;

use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\HttpClient;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\ViaCepProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\BrasilApiProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\OpenCepProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\AwesomeApiProvider;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\CepAbertoProvider;

final class ProviderFactory
{
    public function create(): ProviderCollection
    {
        $http = new HttpClient;

        return new ProviderCollection([

            new ViaCepProvider($http),

            new BrasilApiProvider($http),

            new OpenCepProvider($http),

            new AwesomeApiProvider($http),

            new CepAbertoProvider($http)
            
        ]);
    }
}