<?php

namespace DREID\LaravelJtlApi\Exceptions;

use DREID\LaravelJtlApi\ApiResponse;
use Exception;

class MissingLicenseException extends Exception
{
    public function __construct(public readonly ApiResponse $response)
    {
        parent::__construct('Licensing failed.');
    }
}
