<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests\Global;

readonly class ItemCategoryRequest
{
    public function __construct(
        public int $categoryId
    ) {}
}
