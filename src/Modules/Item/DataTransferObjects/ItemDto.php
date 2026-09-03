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
            $data['id'],
            $data['sku'],
            $data['isActive'],
            array_map(static function ($data) {
                return ItemCategoryDto::fromResponse($data);
            }, $data['categories'] ?? []),
            $data['name'],
            $service->getArrayValue($data, 'description'),
            $service->getArrayValue($data, 'shortDescription'),
            ItemIdentifiersDto::fromResponse($data['identifiers']),
            ItemPriceDataDto::fromResponse($data['itemPriceData']),
            $service->getDateValue($data, 'added'),
            $service->getDateValue($data, 'changed'),
            $service->getDateValue($data, 'releasedOnDate'),
            ItemStorageOptionsDto::fromResponse($data['storageOptions']),
            $service->getArrayValue($data, 'countryOfOrigin'),
            ItemDimensionsDto::fromResponse($data['dimensions']),
            ItemWeightsDto::fromResponse($data['weights']),
            $data['allowNegativeStock'],
            ItemDangerousGoodsDto::fromResponse($data['dangerousGoods']),
            $service->getArrayValue($data, 'taric'),
            $service->getArrayValue($data, 'searchTerms'),
        );
    }
}
