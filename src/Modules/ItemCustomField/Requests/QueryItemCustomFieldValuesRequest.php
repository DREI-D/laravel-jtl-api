<?php

namespace DREID\LaravelJtlApi\Modules\ItemCustomField\Requests;

readonly class QueryItemCustomFieldValuesRequest
{
    public function __construct(
        public int $itemId,
    ) {}
}
