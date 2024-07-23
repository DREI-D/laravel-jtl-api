<?php

namespace DREID\LaravelJtlApi\Modules\Customer;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Customer\Requests\QueryCustomersRequest;
use DREID\LaravelJtlApi\Modules\Customer\Responses\QueryCustomersResponse;
use DREID\LaravelJtlApi\Repository;

class CustomerRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryCustomers(QueryCustomersRequest $request): QueryCustomersResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryCustomers];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/customers', [
            'searchKeyWord'  => $request->searchKeyWord,
            'number'         => $request->number,
            'groupId'        => $request->groupId,
            'categoryId'     => $request->categoryId,
            'lastChangeFrom' => $request->lastChangeFrom,
            'lastChangeTo'   => $request->lastChangeTo,
            'pageNumber'     => $request->pageNumber,
            'pageSize'       => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryCustomersResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
