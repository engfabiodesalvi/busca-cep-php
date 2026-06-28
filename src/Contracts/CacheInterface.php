<?php

// Desacoplamento para uso de cache em arquivos e possibilitar futura implementação em:
// - Redis
// - Memcached
// - APCu
// Sem alterar a biblioteca
// Cmpatível com PSR-16 (Simple Cache)

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Contracts;

interface CacheInterface
{
    public function has(string $key): bool;

    public function get(string $key): mixed;

    public function set(
        string $key,
        mixed $value,
        int $ttl = 3600
    ): void;

    public function delete(string $key): void;

    public function clear() : void;
}