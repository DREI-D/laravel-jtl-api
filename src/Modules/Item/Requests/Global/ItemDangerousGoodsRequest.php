<?php

namespace DREID\LaravelJtlApi\Modules\Item\Requests\Global;

readonly class ItemDangerousGoodsRequest
{
    public function __construct(
        public ?string $unNumber = null,
        public ?string $hazardNo = null,
    ) {}
}
