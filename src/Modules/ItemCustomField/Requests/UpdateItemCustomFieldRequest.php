<?php

namespace DREID\LaravelJtlApi\Modules\ItemCustomField\Requests;

readonly class UpdateItemCustomFieldRequest
{
    public function __construct(
        public int $itemId,
        public int $customFieldId,
        public mixed $value,
    ) {}
}
