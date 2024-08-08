<?php

namespace DREID\LaravelJtlApi\Helpers;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Category\CategoryRepository;
use DREID\LaravelJtlApi\Modules\Category\Requests\QueryCategoriesRequest;

class CategoryHelper
{
    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function loadAllCategories(): array
    {
        $categories = [];
        $repository = app(CategoryRepository::class);

        $page = 1;
        $hasMore = true;

        while ($hasMore) {
            $response = $repository->queryCategories(new QueryCategoriesRequest(pageNumber: $page));
            array_push($categories, ...$response->items);

            $hasMore = $response->hasNextPage;
            $page++;
        }

        return $categories;
    }
}
