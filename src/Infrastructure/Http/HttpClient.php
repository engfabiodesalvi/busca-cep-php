<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Infrastructure\Http;

use Engfabiodesalvi\BuscaCepPhp\Contracts\HttpClientInterface;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\HttpException;
use Exception;

final class HttpClient implements HttpClientInterface
{
    public function send(
        Request $request
    ): Response {

        $context = stream_context_create([
            'http' => [
                'method' => $request->method()->value,
                'header' => implode(
                    "\r\n",
                    HttpHeaders::toLines(
                        $request->headers()
                    )
                ),
                'content' => $request->body() ?? '',
                'timeout' => $request->timeout(),
                'ignore_errors' => true
            ]
        ]);

        $previous = set_error_handler(
            static function (
                int $severity,
                string $message
            ): never {
                // throw new HttpException($message);
                throw new \Exception($message);
            }
        );

        try {

            $body = file_get_contents(
                $request->url(),
                false,
                $context
            );
            $headers = $http_response_header;

        } finally {

            restore_error_handler();

        }

        if ($body === false) {
            // throw new HttpException(
            //     'Resposta HTTP inválida.'
            // );
            throw new Exception(
                'Resposta HTTP inválida.'
            );            
        }

        
        //var_dump($headers);        

        //global $http_response_header;

        //var_dump($http_response_header);

        $status = 0;

        if (
            isset($headers[0]) &&
            preg_match(
                '/HTTP\/\S+\s(\d{3})/',
                $headers[0],
                $matches
            )
        ) {
            $status = (int) $matches[1];
        }

        return new Response(
            statusCode: $status,
            body: $body,
            headers: HttpHeaders::parse(
                $headers ?? []
            )
        );
    }
}