<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers;

use Engfabiodesalvi\BuscaCepPhp\Contracts\HttpClientInterface;
use Engfabiodesalvi\BuscaCepPhp\Contracts\NormalizerInterface;
use Engfabiodesalvi\BuscaCepPhp\Contracts\ProviderInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\ProviderException;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http\Request;

abstract class AbstractProvider implements ProviderInterface
{
    public function __construct(
        protected readonly HttpClientInterface $client,
        protected readonly NormalizerInterface $normalizer
    ) {

    }

    final public function search(
        Cep $cep
    ): Address {

        $request = $this->buildRequest($cep);

        $response = $this->client->send($request);

        if (!$response->isSuccess()) {

            // throw new ProviderException(
            //     sprintf(
            //         '%s retornou HTTP %d',
            //         $this->getName(),
            //         $response->statusCode()
            //     )
            // );

            throw new \Exception(
                sprintf(
                    '%s retornou HTTP %d',
                    $this->getName(),
                    $response->statusCode()
                )
            );            
        }

        return $this->normalizer->normalize(
            $response->json()
        );

    }

    abstract protected function buildRequest(
        Cep $cep
    ): Request;    
}