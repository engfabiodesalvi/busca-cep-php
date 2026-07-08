<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions;

use Override;
use Throwable;

class NormalizerException extends CepException
{
    //#[Override]
    public function __construct(
        string $provider = '',
        string $field = '',
        ?Throwable $previous = null
    ) {
        parent::__construct(
            sprintf(
                'Unable to normalize field "%s" from provider "%s".',
                $field,
                $provider
            ),
            0,
            $previous
        );
    }
}
