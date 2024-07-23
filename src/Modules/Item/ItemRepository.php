<?php

namespace DREID\LaravelJtlApi\Modules\Item;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use DREID\LaravelJtlApi\Modules\Item\Responses\QueryItemsResponse;
use DREID\LaravelJtlApi\Repository;

class ItemRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryItems(QueryItemsRequest $request): QueryItemsResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryItems];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/items', [
            'searchKeyWord'            => $request->searchKeyWord,
            'categoryId'               => $request->categoryId,
            'manufacturerId'           => $request->manufacturerId,
            'parentItemId'             => $request->parentItemId,
            'changedSince'             => $request->changedSince,
            'isActiveOnSalesChannelId' => $request->isActiveOnSalesChannelId,
            'pageNumber'               => $request->pageNumber,
            'pageSize'                 => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryItemsResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
