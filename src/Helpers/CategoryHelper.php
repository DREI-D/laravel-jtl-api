<?php

namespace DREID\LaravelJtlApi\Helpers;

use DREID\LaravelJtlApi\DataTransferObjects\CategoryTreeDto;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Category\CategoryRepository;
use DREID\LaravelJtlApi\Modules\Category\DataTransferObjects\CategoryDto;
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
     * @return CategoryDto[]
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

    /**
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     * @throws MissingLicenseException
     * @return CategoryTreeDto[]
     */
    public function loadCategoryTree(): array
    {
        $categories = $this->loadAllCategories();
        $mapToParent = [];

        foreach ($categories as $category) {
            $parentId = $category->parentCategoryId ?? 0;

            if (!isset($mapToParent[$parentId])) {
                $mapToParent[$parentId] = [];
            }

            $mapToParent[$parentId][] = $category;
        }

        $tree = [];

        foreach ($mapToParent[0] ?? [] as $category) {
            $tree[] = $this->mapChildren($category, $mapToParent);
        }

        return $tree;
    }

    private function mapChildren(CategoryDto $category, array $mapToParent): CategoryTreeDto
    {
        return new CategoryTreeDto(
            $category,
            array_map(
                function(CategoryDto $categoryDto) use ($mapToParent) {
                    return $this->mapChildren($categoryDto, $mapToParent);
                },
                $mapToParent[$category->id] ?? []
            )
        );
    }
}
