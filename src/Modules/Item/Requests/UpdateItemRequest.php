<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests;

use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemDangerousGoodsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemDimensionsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemIdentifiersRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemPriceDataRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemStorageOptionsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemWeightsRequest;

readonly class UpdateItemRequest
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $sku = null,
        public ?int $manufacturerId = null,
        public ?array $categories = null,
        public ?string $description = null,
        public ?string $shortDescription = null,
        public ?ItemIdentifiersRequest $identifiers = null,
        public ?ItemPriceDataRequest $itemPriceData = null,
        public ?ItemStorageOptionsRequest $storageOptions = null,
        public ?string $countryOfOrigin = null,
        public ?ItemDimensionsRequest $dimensions = null,
        public ?ItemWeightsRequest $weights = null,
        public ?bool $allowNegativeStock = null,
        public ?ItemDangerousGoodsRequest $dangerousGoods = null,
        public ?string $taric = null,
        public ?string $searchTerms = null,
    ) {}
}
