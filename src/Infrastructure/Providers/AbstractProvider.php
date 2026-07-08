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
        // protected readonly NormalizerInterface $normalizer
    ) {
    }

    final public function search(
        Cep $cep
    ): Address {

        $request = $this->buildRequest($cep);

        $response = $this->client->send($request);

        if (!$response->isSuccess()) {
            $status = $response->statusCode();

            $message = match ($status) {
                401 => 'Não autorizado (token inválido ou ausente)',
                403 => 'Acesso proibido',
                404 => 'CEP não encontrado',
                429 => 'Limite de requisições excedido',
                500 => 'Erro interno do provedor',
                default => sprintf('Retornou HTTP %d', $status),
            };

            throw new ProviderException(
                $this->getName(),
                sprintf(
                    'Retornou HTTP %d. %s.',
                    $response->statusCode(),
                    $message
                ),
                $response->statusCode()
            );

            // throw new ProviderException(
            //     sprintf(
            //         $this->getName(),
            //         '%s retornou HTTP %d',
            //         $response->statusCode()
            //     )
            // );

            // throw new \Exception(
            //     sprintf(
            //         '%s retornou HTTP %d',
            //         $this->getName(),
            //         $response->statusCode()
            //     )
            // );
        }

        return $this
            ->normalizer()
            ->normalize(
                $response->json()
            );
    }

    abstract protected function buildRequest(
        Cep $cep
    ): Request;

    // A interface normalizaora é atribuida na imprementação do provedor
    abstract protected function normalizer(): NormalizerInterface;
}
