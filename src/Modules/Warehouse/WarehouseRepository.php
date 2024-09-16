<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Warehouse\Requests\QueryWarehousesRequest;
use DREID\LaravelJtlApi\Modules\Warehouse\Responses\QueryWarehousesResponse;
use DREID\LaravelJtlApi\Repository;

class WarehouseRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryWarehouses(QueryWarehousesRequest $request): QueryWarehousesResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryWarehouses];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/warehouses', [
            'isActive'   => $request->isActive,
            'pageNumber' => $request->pageNumber,
            'pageSize'   => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryWarehousesResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
