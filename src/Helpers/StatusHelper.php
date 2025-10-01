<?php

namespace DREID\LaravelJtlApi\Helpers;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Info\InfoRepository;

class StatusHelper
{
    /**
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     */
    public function isAvailable(): bool
    {
        try {
            app(InfoRepository::class)->getStatus();
        } catch (ConnectionException $e) {
            return false;
        }

        return true;
    }
}
