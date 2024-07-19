<?php

namespace DREID\LaravelJtlApi\Modules\ColorCode;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\ColorCode\Responses\QueryColorCodesResponse;
use DREID\LaravelJtlApi\Repository;

class ColorCodeRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryColorCodes(): QueryColorCodesResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryColorCodes];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/colorCodes');

        if ($response->wasSuccessful) {
            return new QueryColorCodesResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
