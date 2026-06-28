<?php

// Normaliza os dados recebidos pelas APIs.
// Gera um único objeto contendo as informações

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Contracts;

// Incluir dentro de Domain
use Engfabiodesalvi\BuscaCepPhp\DTO\Address;

interface NormalizerInterface
{
    public function normalize(array $data): Address;
}