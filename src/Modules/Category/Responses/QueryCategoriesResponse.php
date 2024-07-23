<?php

namespace DREID\LaravelJtlApi\Modules\Category\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Category\DataTransferObjects\CategoryDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryCategoriesResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        parent::__construct($response, array_map(static function ($item) {
            return CategoryDto::fromResponse($item);
        }, $response->json['Items']));
    }
}
