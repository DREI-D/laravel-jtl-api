<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests\Global;

readonly class ItemDimensionsRequest
{
    public function __construct(
        public ?float $length = null,
        public ?float $width = null,
        public ?float $height = null,
    ) {}
}
