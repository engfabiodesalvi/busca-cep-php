<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Collections;

use Engfabiodesalvi\BuscaCepPhp\Contracts\ProviderInterface;
use IteratorAggregate;
use ArrayIterator;
use Traversable; 

final class ProviderCollection implements IteratorAggregate
{
    /**
     * @var ProviderInterface[]
     */
    private array $providers = [];

    /**
     * @param ProviderInterface[] $providers
     */
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
        ProviderInterface $provider
    ): void {

        $this->providers[] = $provider;
    }

    /**
     * @return ProviderInterface[]
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