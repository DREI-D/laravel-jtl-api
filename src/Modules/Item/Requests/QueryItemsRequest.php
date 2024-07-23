<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests;

readonly class QueryItemsRequest
{
    public function __construct(
        public ?string $searchKeyWord = null,
        public ?int $categoryId = null,
        public ?int $manufacturerId = null,
        public ?int $parentItemId = null,
        public ?string $changedSince = null,
        public ?string $isActiveOnSalesChannelId = null,
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
    ) {}
}
