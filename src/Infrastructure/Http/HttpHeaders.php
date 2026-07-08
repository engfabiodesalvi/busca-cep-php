<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http;

final class HttpHeaders
{
    /**
     * @param array<string,string> $headers
     * @return string[]
     */
    public static function toLines(
        array $headers
    ): array {
        $lines = [];

        foreach ($headers as $key => $value) {
            $lines[] = "{$key}: {$value}";
        }

        return $lines;
    }

    /**
     * @param string[] $headers
     * @return array<string,string>
     */
    public static function parse(
        array $headers
    ): array {
        $parsed = [];

        foreach ($headers as $header) {
            if (!str_contains($header, ':')) {
                continue;
            }

            [$key, $value] = explode(
                ':',
                $header,
                2
            );

            $parsed[trim($key)] = trim($value);
        }

        return $parsed;
    }
}
