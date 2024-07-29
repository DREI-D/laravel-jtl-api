<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemDto
{
    public function __construct(
        public int $id,
        public string $sku,
        public string $name,
        public ?string $description,
        public ?string $shortDescription,
        public ItemPriceDataDto $itemPriceData,
        public ItemStorageOptionsDto $storageOptions,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['SKU'],
            $data['Name'],
            $data['Description'] ?: null,
            $data['ShortDescription'] ?: null,
            ItemPriceDataDto::fromResponse($data['ItemPriceData']),
            ItemStorageOptionsDto::fromResponse($data['StorageOptions']),
        );
    }
}
