<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http;

final class HttpStatus
{
    public const OK = 200;
    public const CREATED = 201;
    public const NO_CONTENT = 204;

    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;

    public const INTERNAL_SERVER_ERROR = 500;
    public const BAD_GATEWAY = 502;
    public const SERVICE_UNAVAILABLE = 503;
    public const GATEWAY_TIMEOUT = 504;

    
    public static function isSuccess(int $status): bool
    {
        return $status >= 200
            && $status < 300;
    }

    public static function isClientError(
        int $status
    ): bool
    {
        return $status >= 400
            && $status < 500;
    }

    public static function isServerError(
        int $status
    ): bool
    {
        return $status >= 500
            && $status < 600;
    }
    

}