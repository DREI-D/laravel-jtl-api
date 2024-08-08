<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests\Global;

readonly class ItemPriceDataRequest
{
    public function __construct(
        public ?float $salesPriceNet = null,
        public ?float $suggestedRetailPrice = null,
        public ?float $purchasePriceNet = null,
        public ?float $ebayPrice = null,
        public ?float $amazonPrice = null,
    ) {}
}
