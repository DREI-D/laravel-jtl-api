<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Warehouse\Requests\QueryStorageLocationsRequest;
use DREID\LaravelJtlApi\Modules\Warehouse\Responses\QueryStorageLocationsResponse;
use DREID\LaravelJtlApi\Repository;

class StorageLocationRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryStorageLocations(QueryStorageLocationsRequest $request): QueryStorageLocationsResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryStorageLocations];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/warehouses/' . $request->warehouseId . '/storagelocations', [
            'pageNumber' => $request->pageNumber,
            'pageSize'   => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryStorageLocationsResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
