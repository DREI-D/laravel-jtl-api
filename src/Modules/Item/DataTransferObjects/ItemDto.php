<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

readonly class ItemDto
{
    public function __construct(
        public int $id,
        public string $sku,
        public ?int $manufacturerId,
        public string $name,
        public ?string $description,
        public ?string $shortDescription,
        public ItemIdentifiersDto $identifiers,
        public ItemPriceDataDto $itemPriceData,
        public ItemStorageOptionsDto $storageOptions,
        public ?string $countryOfOrigin,
        public ItemDimensionsDto $dimensions,
        public ItemWeightsDto $weights,
        public bool $allowNegativeStock,
        public ItemDangerousGoodsDto $dangerousGoods,
        public ?string $taric,
        public ?string $searchTerms,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['Id'],
            $data['SKU'],
            $data['ManufacturerId'] ?? null,
            $data['Name'],
            $data['Description'] ?: null,
            $data['ShortDescription'] ?: null,
            ItemIdentifiersDto::fromResponse($data['Identifiers']),
            ItemPriceDataDto::fromResponse($data['ItemPriceData']),
            ItemStorageOptionsDto::fromResponse($data['StorageOptions']),
            $data['CountryOfOrigin'] ?: null,
            ItemDimensionsDto::fromResponse($data['Dimensions']),
            ItemWeightsDto::fromResponse($data['Weights']),
            $data['AllowNegativeStock'],
            ItemDangerousGoodsDto::fromResponse($data['DangerousGoods']),
            $data['Taric'] ?: null,
            $data['SearchTerms'] ?: null,
        );
    }
}
