<?php

namespace DREID\LaravelJtlApi\Modules\Item\DataTransferObjects;

use DREID\LaravelJtlApi\Services\DataTransferObjectService;
use Illuminate\Support\Carbon;

readonly class ItemDto
{
    public function __construct(
        public int $id,
        public string $sku,
        public bool $isActive,
        public array $categories,
        public ?int $manufacturerId,
        public string $name,
        public ?string $description,
        public ?string $shortDescription,
        public ItemIdentifiersDto $identifiers,
        public ItemPriceDataDto $itemPriceData,
        public ?Carbon $added,
        public ?Carbon $changed,
        public ?Carbon $releasedOnDate,
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
        $service = app(DataTransferObjectService::class);

        return new self(
            $data['Id'],
            $data['SKU'],
            $data['IsActive'],
            array_map(static function ($data) {
                return ItemCategoryDto::fromResponse($data);
            }, $data['Categories'] ?? []),
            $service->getArrayValue($data, 'ManufacturerId'),
            $data['Name'],
            $service->getArrayValue($data, 'Description'),
            $service->getArrayValue($data, 'ShortDescription'),
            ItemIdentifiersDto::fromResponse($data['Identifiers']),
            ItemPriceDataDto::fromResponse($data['ItemPriceData']),
            $service->getDateValue($data, 'Added'),
            $service->getDateValue($data, 'Changed'),
            $service->getDateValue($data, 'ReleasedOnDate'),
            ItemStorageOptionsDto::fromResponse($data['StorageOptions']),
            $service->getArrayValue($data, 'CountryOfOrigin'),
            ItemDimensionsDto::fromResponse($data['Dimensions']),
            ItemWeightsDto::fromResponse($data['Weights']),
            $data['AllowNegativeStock'],
            ItemDangerousGoodsDto::fromResponse($data['DangerousGoods']),
            $service->getArrayValue($data, 'Taric'),
            $service->getArrayValue($data, 'SearchTerms'),
        );
    }
}
