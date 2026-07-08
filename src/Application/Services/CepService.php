<?php

// Responsabilidades

// O serviço deverá:
// - receber uma ProviderCollection;
// - validar se existe pelo menos um provedor disponível;
// - selecionar um provedor;
// - delegar a consulta;
// - devolver um Address.

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Application\Services;

use Engfabiodesalvi\BuscaCepPhp\Collections\ProviderCollection;
use Engfabiodesalvi\BuscaCepPhp\Contracts\LoggerInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\ProviderException;
use Engfabiodesalvi\BuscaCepPhp\Domain\ValueObject\Cep;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Logging\NullLogger;
use SebastianBergmann\Type\MixedType;

final class CepService
{
    /**
     * @var array<string,int>
     */
    private array $failures = [];

    /**
     * @var array<string,int>
     */
    private array $openedAt = [];

    private const MAX_FAILURES = 5;
    private const OPEN_TIMEOUT = 60;

    private LoggerInterface $logger;

    public function __construct(
        private readonly ProviderCollection $providers,
        ?LoggerInterface $logger = null
    ) {
        $this->logger = $logger ?? new NullLogger();
    }

    public function search(Cep $cep): Address
    {
        $this->logger->info(
            sprintf(
                'Iniciando consulta do CEP %s',
                $cep->value()
            )
        );

        if ($this->providers->isEmpty()) {
            // throw new ProviderException(
            throw new \Exception(
                'Nenhum provider foi configurado.'
            );
        }

        $lastException = null;

        foreach ($this->providers as $provider) {
            $name = $provider->getName();

            if (
                $this->isOpen($name)
            ) {
                continue;
            }

            $attempt = 0;

            $maxAttempts = 3;

            // echo $name . PHP_EOL;

            do {
                try {
                    $this->logger->debug(
                        sprintf(
                            'Consultando provider %s',
                            $name
                        )
                    );

                    $address = $provider->search($cep);

                    $this->logger->info(
                        sprintf(
                            'Consulta realizada com sucesso utilizando %s',
                            $name
                        )
                    );

                    $this->close(
                        $provider->getName()
                    );

                    return $address;

                    //return $provider->search($cep);
                } catch (\Throwable $exception) {
                    $this->failure(
                        $name
                    );

                    $lastException = $exception;

                    $attempt++;

                    $this->logger->warning(
                        sprintf(
                            'Falha ao consultar %s: %s',
                            $name,
                            $exception->getMessage()
                        )
                    );

                    if ($attempt >= $maxAttempts) {
                        break;
                    }
                }

                usleep(200000);
            } while (true);
        }

        throw $lastException ??
            new ProviderException(
                'Nenhum provider conseguiu responder.'
            );
    }

    private function isOpen(
        string $provider
    ): bool {

        if (!isset($this->openedAt[$provider])) {
            return false;
        }

        return (
            time() - $this->openedAt[$provider]
        ) < self::OPEN_TIMEOUT;
    }

    private function open(
        string $provider
    ): void {

        $this->logger->warning(
            sprintf(
                'Circuit Breaker aberto para %s',
                $provider
            )
        );

        $this->openedAt[$provider] = time();
    }

    private function close(
        string $provider
    ): void {

        $this->logger->info(
            sprintf(
                'Circuit Breaker fechado para %s',
                $provider
            )
        );

        unset($this->openedAt[$provider]);

        $this->failures[$provider] = 0;
    }

    private function failure(
        string $provider
    ): void {

        $this->failures[$provider]
            = ($this->failures[$provider] ?? 0) + 1;

        if (
            $this->failures[$provider]
            >= self::MAX_FAILURES
        ) {
            $this->open($provider);
        }
    }
}
