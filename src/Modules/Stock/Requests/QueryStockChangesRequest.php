<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Requests;

readonly class QueryStockChangesRequest
{
    public function __construct(
        public ?int $itemId = null,
        public ?string $startDate = null,
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
    ) {}
}
