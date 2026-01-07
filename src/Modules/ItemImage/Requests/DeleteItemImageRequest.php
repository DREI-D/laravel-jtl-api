<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage\Requests;

readonly class DeleteItemImageRequest
{
    public function __construct(
        public int $itemId,
        public int $imageId,
    ) {}
}
