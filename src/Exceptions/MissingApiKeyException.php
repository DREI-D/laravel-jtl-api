<?php

namespace DREID\LaravelJtlApi\Exceptions;

use Exception;

class MissingApiKeyException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'Your jtl api key seems to be missing. Please set the JTL_API_KEY in your .env file, or update the jtl-api.php config.'
        );
    }
}
