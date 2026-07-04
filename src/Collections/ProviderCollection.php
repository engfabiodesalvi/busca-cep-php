<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Collections;

use Engfabiodesalvi\BuscaCepPhp\Contracts\ProviderInterface;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Providers\AbstractProvider;
use IteratorAggregate;
use ArrayIterator;
use Traversable; 

final class ProviderCollection implements IteratorAggregate
{
    /**
     * @var AbstractProvider[] //ProviderInterface[]
     */
    private array $providers = [];

    /**     
     * @param AbstractProvider[] $providers
     */
    // @param ProviderInterface[] $providers
    public function __construct(
        array $providers = []
    )
    {
        foreach (
            $providers as $provider
        )
        {
            $this->add($provider);
        }
    }

    public function add(
        //ProviderInterface $provider
        AbstractProvider $provider
    ): void {

        $this->providers[] = $provider;
    }

    /**
     * @return AbstractProvider[] //ProviderInterface[]
     */
    public function all(): array
    {
        return $this->providers;
    }

    public function count(): int
    {
        return count($this->providers);
    }

    public function isEmpty(): bool
    {
        return empty($this->providers);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator(
            $this->providers
        );
    }
}