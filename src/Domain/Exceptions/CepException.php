<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions;

use Exception;
use Throwable;

class CepException extends Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
