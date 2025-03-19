<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage\Requests;

readonly class QueryItemImageDataRequest
{
    public function __construct(
        public int $imageId,
    ) {}
}
