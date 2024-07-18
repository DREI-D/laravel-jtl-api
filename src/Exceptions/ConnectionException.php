<?php

namespace DREID\LaravelJtlApi\Exceptions;

use Exception;

class ConnectionException extends Exception
{
    public function __construct(Exception $previous)
    {
        parent::__construct(
            'There was an error requesting the JTL api.',
            previous: $previous
        );
    }
}
