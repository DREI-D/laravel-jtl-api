<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage\Requests;

readonly class QueryItemImagesRequest
{
    public function __construct(
        public int $itemId,
    ) {}
}
