<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests\Global;

readonly class ItemWeightsRequest
{
    public function __construct(
        public ?float $itemWeight = null,
        public ?float $shippingWeight = null,
    ) {}
}
