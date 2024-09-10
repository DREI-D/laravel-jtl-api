<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

use DREID\LaravelJtlApi\Services\DataTransferObjectService;

readonly class ItemDangerousGoodsDto
{
    public function __construct(
        public ?string $unNumber,
        public ?string $hazardNo,
    ) {}

    public static function fromResponse(array $data): static
    {
        $service = app(DataTransferObjectService::class);

        return new self(
            $service->getArrayValue($data, 'UnNumber'),
            $service->getArrayValue($data, 'HazardNo'),
        );
    }
}
