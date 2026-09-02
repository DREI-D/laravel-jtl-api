<?php

namespace DREID\LaravelJtlApi\Exceptions;

use DREID\LaravelJtlApi\ApiResponse;
use Exception;

class UnhandledResponseException extends Exception
{
    public function __construct(public readonly ApiResponse $response)
    {
        parent::__construct(
            'The response could not be handled:'
            . ' Status: ' . $this->response->object->status()
            . ', Body: ' . $this->response->object->body()
        );
    }
}
