<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemDangerousGoodsDto
{
    public function __construct(
        public ?string $unNumber,
        public ?string $hazardNo,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['UnNumber'] ?: null,
            $data['HazardNo'] ?: null,
        );
    }
}
