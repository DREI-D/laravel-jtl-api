<?php

namespace DREID\LaravelJtlApi\Modules\Category\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Category\DataTransferObjects\CategoryDto;

readonly class CreateCategoryResponse
{
    public CategoryDto $category;

    public function __construct(public ApiResponse $response)
    {
        $this->category = CategoryDto::fromResponse($this->response->json);
    }
}
