<?php

namespace DREID\LaravelJtlApi\Modules\ItemCustomField\Requests;

readonly class DeleteItemCustomFieldRequest
{
    public function __construct(
        public int $itemId,
        public int $customFieldId,
    ) {}
}
