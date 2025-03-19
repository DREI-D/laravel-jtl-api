<?php

namespace DREID\LaravelJtlApi\DataTransferObjects;

use DREID\LaravelJtlApi\Modules\Category\DataTransferObjects\CategoryDto;

readonly class CategoryTreeDto
{
    public function __construct(
        public CategoryDto $category,
        public array $children
    ) {}
}
