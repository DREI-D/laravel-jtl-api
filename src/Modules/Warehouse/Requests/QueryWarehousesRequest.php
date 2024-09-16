<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse\Requests;

readonly class QueryWarehousesRequest
{
    public function __construct(
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
        public ?bool $isActive = null,
    ) {}
}
