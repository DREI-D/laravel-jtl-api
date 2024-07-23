<?php

namespace DREID\LaravelJtlApi;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use Http;
use Symfony\Component\HttpFoundation\Response;

class Repository
{
    public const string METHOD_GET = 'get';
    public const string METHOD_POST = 'post';

    /**
     * @throws MissingApiKeyException
     * @throws ConnectionException
     */
    protected function get(
        string $uri,
        ?array $query = null,
        ?array $headers = null
    ): ApiResponse
    {
        $query ??= [];

        $parsedUri = $this->parseUri($uri);
        $parsedHeaders = $this->parseHeaders($headers ?? []);

        try {
            $response = Http::withHeaders($parsedHeaders)->get(
                $parsedUri,
                $query
            );
        } catch (\Illuminate\Http\Client\ConnectionException $exception) {
            throw new ConnectionException($exception);
        }

        return ApiResponse::fromResponse(
            $response,
            $parsedUri,
            self::METHOD_GET,
            $query,
            $parsedHeaders
        );
    }

    /**
     * @throws MissingApiKeyException
     * @throws ConnectionException
     */
    protected function post(
        string $uri,
        ?array $body = null,
        ?array $headers = null,
    ): ApiResponse
    {
        $body ??= [];

        $parsedUri = $this->parseUri($uri);
        $parsedHeaders = $this->parseHeaders($headers ?? []);

        try {
            $response = Http::withHeaders($parsedHeaders)->post(
                $parsedUri,
                $body
            );
        } catch (\Illuminate\Http\Client\ConnectionException $exception) {
            throw new ConnectionException($exception);
        }

        return ApiResponse::fromResponse(
            $response,
            $parsedUri,
            self::METHOD_POST,
            $body,
            $parsedHeaders
        );
    }

    /**
     * @throws UnauthorizedException
     * @throws MissingLicenseException
     */
    protected function throwExceptionsIfPossible(ApiResponse $response): void
    {
        if ($response->status === Response::HTTP_UNAUTHORIZED) {
            throw new UnauthorizedException($response);
        }

        if ($response->status === Response::HTTP_PAYMENT_REQUIRED) {
            throw new MissingLicenseException($response);
        }
    }

    protected function parseUri(string $uri): string
    {
        return config('jtl-api.base_url') . $uri;
    }

    /**
     * @throws MissingApiKeyException
     */
    protected function parseHeaders(array $headers): array
    {
        $headers = $this->addConfigHeaders($headers);

        $apiKey = config('jtl-api.api_key');

        if (!$apiKey) {
            throw new MissingApiKeyException();
        }

        $headers['Authorization'] = 'Wawi ' . $apiKey;

        return $headers;
    }

    protected function addConfigHeaders(array $headers): array
    {
        $headers['X-RunAs'] = config('jtl-api.run_as');
        $headers['X-AppID'] = config('jtl-api.app_id');
        $headers['X-AppVersion'] = config('jtl-api.version');

        return $headers;
    }

    protected function deleteNullValues(array $body): array
    {
        foreach ($body as $key => $value) {
            if ($value === null) {
                unset($body[$key]);
            }
        }

        return $body;
    }
}
