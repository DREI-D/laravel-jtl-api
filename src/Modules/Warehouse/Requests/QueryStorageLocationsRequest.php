<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse\Requests;

readonly class QueryStorageLocationsRequest
{
    public function __construct(
        public int $warehouseId,
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
    ) {}
}
