<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage\DataTransferObjects;

use DREID\LaravelJtlApi\Services\DataTransferObjectService;

readonly class ItemImageDto
{
    public function __construct(
        public int $itemId,
        public int $imageId,
        public string $imageDataType,
        public string $salesChannelId,
        public ?string $ebayUserName,
        public int $sortNumber,
        public int $size,
        public int $width,
        public int $height,
    ) {}

    public static function fromResponse(array $data): static
    {
        $service = app(DataTransferObjectService::class);

        return new self(
            $service->getArrayValue($data, 'ItemId'),
            $service->getArrayValue($data, 'ImageId'),
            $service->getArrayValue($data, 'ImageDataType'),
            $service->getArrayValue($data, 'SalesChannelId'),
            $service->getArrayValue($data, 'EbayUserName'),
            $service->getArrayValue($data, 'SortNumber'),
            $service->getArrayValue($data, 'Size'),
            $service->getArrayValue($data, 'Width'),
            $service->getArrayValue($data, 'Height'),
        );
    }
}
