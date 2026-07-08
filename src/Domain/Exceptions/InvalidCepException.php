<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions;

use Override;
use Throwable;

class InvalidCepException extends CepException
{
    //#[Override]
    public function __construct(
        string $cep = '',
        ?Throwable $previous = null
    ) {
        parent::__construct(
            sprintf(
                'The CEP "%s" is invalid.',
                $this->$cep
            ),
            0,
            $previous
        );
    }
}
