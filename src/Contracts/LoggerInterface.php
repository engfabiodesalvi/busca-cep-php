<?php

// Realizar log para:
// - saber qual API respondeu
// - qual API falhou
// - quanto tempo cada API demorou para responder
// Compatível com PSR-3 (Logger)

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Contracts;

interface LoggerInterface
{
    public function info(
        string $message,
        array $context = []
    ): void;

    public function warning(
        string $message,
        array $context = []
    ): void;

    public function error(
        string $message,
        array $context = []
    ): void;
}