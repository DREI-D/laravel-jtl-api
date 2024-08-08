<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests\Global;

readonly class ItemIdentifiersRequest
{
    public function __construct(
        public ?string $gtin = null,
        public ?string $manufacturerNumber = null,
        public ?string $isbn = null,
        public ?string $upc = null,
        public ?string $amazonFnsku = null,
        public ?string $asins = null,
        public ?string $ownIdentifier = null,
    ) {}
}
