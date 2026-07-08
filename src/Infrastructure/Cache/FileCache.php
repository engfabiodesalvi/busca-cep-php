<?php

// Responsabilidade
// - Persistir objetos em disco.

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Cache;

use Engfabiodesalvi\BuscaCepPhp\Contracts\CacheInterface;

final class FileCache implements CacheInterface
{
    public function __construct(
        private readonly string $directory
    ) {
        if (!is_dir($this->directory)) {
            mkdir(
                $this->directory,
                0777,
                true
            );
        }
    }

    private function filename(
        string $key
    ): string {

        return sprintf(
            '%s/%s.cache',
            rtrim(
                $this->directory,
                '/'
            ),
            md5($key)
        );
    }

    public function has(
        string $key
    ): bool {

        $file = $this->filename($key);

        if (!file_exists($file)) {
            return false;
        }

        $content = unserialize(
            file_get_contents($file)
        );

        return time() < $content['expires'];
    }

    public function get(
        string $key
    ): mixed {

        $file = $this->filename($key);

        $content = unserialize(
            file_get_contents($file)
        );

        return $content['value'];
    }

    public function put(
        string $key,
        mixed $value,
        int $ttl = 3600
    ): void {

        file_put_contents(
            $this->filename($key),
            serialize([

                'expires' => time() + $ttl,

                'value' => $value
            ])
        );
    }

    public function delete(
        string $key
    ): void {

        $file = $this->filename($key);

        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function clear(): void
    {
        foreach (
            glob(
                $this->directory . '/*.cache'
            ) as $file
        ) {
            unlink($file);
        }
    }
}
