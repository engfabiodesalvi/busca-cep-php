<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Logging;

use Engfabiodesalvi\BuscaCepPhp\Contracts\LoggerInterface;

final class ConsoleLogger implements LoggerInterface
{
    private function write(string $level, string $message): void
    {
        echo sprintf(
            "[%s] [%s] %s%s",
            date('Y-m-d H:i:s'),
            strtoupper($level),
            $message,
            PHP_EOL
        );
    }

    public function debug(string $message): void
    {
        $this->write('debug', $message);
    }

    public function info(string $message): void
    {
        $this->write('info', $message);
    }

    public function warning(string $message): void
    {
        $this->write('warning', $message);
    }

    public function error(string $message): void
    {
        $this->write('error', $message);
    }
}
