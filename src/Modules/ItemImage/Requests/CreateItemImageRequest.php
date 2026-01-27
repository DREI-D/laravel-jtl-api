<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage\Requests;

readonly class CreateItemImageRequest
{
    public function __construct(
        public int $itemId,
        public string $imageData,
        public string $filename,
        public string $salesChannelId = '1-1-1',
    ) {}
}
