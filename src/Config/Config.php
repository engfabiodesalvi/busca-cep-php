<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Config;

final class Config
{
    /**
     * @var array{
     *     timeout: int,
     *     user_agent: string,
     *     cache_ttl: int,
     *     retry_attempts: int,
     *     retry_delay: int,
     *     circuit_breaker_failures: int,
     *     circuit_breaker_timeout: int,
     *     cepaberto_token: string|null
     * }
     */
    private static array $config = [
        'timeout' => 5,
        'user_agent' => 'BuscaCepPHP/1.0',
        'cache_ttl' => 3600,
        'retry_attempts' => 3,
        'retry_delay' => 200000,
        'circuit_breaker_failures' => 5,
        'circuit_breaker_timeout' => 60,

        // Providers
        'cepaberto_token' => null,
    ];

    public static function set(
        string $key,
        mixed $value
    ): void {
        self::$config[$key] = $value;
    }

    public static function get(
        string $key,
        mixed $default = null
    ): mixed {
        if (array_key_exists($key, self::$config)) {
            return self::$config[$key];
        }

        return getenv(strtoupper($key)) ?: $default;
    }
}
