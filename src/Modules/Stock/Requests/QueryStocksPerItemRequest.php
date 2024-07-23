<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Requests;

readonly class QueryStocksPerItemRequest
{
    public function __construct(
        public ?int $itemId = null,
        public ?int $warehouseId = null,
        public ?int $storageLocationId = null,
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
    ) {}
}
