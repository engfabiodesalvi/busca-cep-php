<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions;

use Override;
use Throwable;

class HttpException extends CepException
{
    //#[Override]
    public function __construct(
        string $message = 'Http request failed.',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
