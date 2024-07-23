<?php

namespace DREID\LaravelJtlApi\Modules\Customer\Requests;

readonly class QueryCustomersRequest
{
    public function __construct(
        public ?string $searchKeyWord = null,
        public ?string $number = null,
        public ?int $groupId = null,
        public ?int $categoryId = null,
        public ?string $lastChangeFrom = null,
        public ?string $lastChangeTo = null,
        public ?int $pageNumber = null,
        public ?int $pageSize = null,
    ) {}
}
