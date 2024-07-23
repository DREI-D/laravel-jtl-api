<?php

namespace DREID\LaravelJtlApi\Modules\Category;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Category\Requests\QueryCategoriesRequest;
use DREID\LaravelJtlApi\Modules\Category\Responses\QueryCategoriesResponse;
use DREID\LaravelJtlApi\Repository;

class CategoryRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryCategories(QueryCategoriesRequest $request): QueryCategoriesResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryCategories];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/categories', [
            'pageNumber' => $request->pageNumber,
            'pageSize'   => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryCategoriesResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
