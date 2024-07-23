<?php

namespace DREID\LaravelJtlApi\Modules\Category\Requests;

readonly class QueryCategoriesRequest
{
    public function __construct(
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
    ) {}
}
