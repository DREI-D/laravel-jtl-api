<?php

namespace DREID\LaravelJtlApi\Exceptions;

use DREID\LaravelJtlApi\ApiResponse;
use Exception;

class UnauthorizedException extends Exception
{
    public function __construct(public readonly ApiResponse $response)
    {
        parent::__construct('Authorization failed.');
    }
}
