<?php

namespace DREID\LaravelJtlApi;

use Illuminate\Http\Client\Response;

readonly class ApiResponse
{
    public function __construct(
        public Response $object,
        public int $status,
        public string $url,
        public string $method,
        public array $params,
        public array $headers,
        public array $json = [],
        public bool $wasSuccessful = false,
    ) {}

    public static function fromResponse(
        Response $response,
        string $url,
        string $method,
        array $params,
        array $headers,
    ): self {
        return new self(
            $response,
            $response->status(),
            $url,
            $method,
            $params,
            $headers,
            $response->json(),
            $response->successful(),
        );
    }
}
