<?php

namespace DREID\LaravelJtlApi\Modules\Stock;

readonly class StockDto
{
    public function __construct(
        public int $warehouseId,
        public int $storageLocationId,
        public string $storageLocationName,
        public int $itemId,
        public ?string $shelfLifeExpirationDate,
        public ?string $batchNumber,
        public int $quantityTotal,
        public int $quantityLockedForShipment,
        public int $quantityLockedForAvailability,
        public int $quantityInPickingLists
    ) {}

    public static function fromResponse(array $data): static
    {
        return new static(
            $data['WarehouseId'],
            $data['StorageLocationId'],
            $data['StorageLocationName'],
            $data['ItemId'],
            $data['ShelfLifeExpirationDate'] ?? null,
            $data['BatchNumber'] ?? null,
            $data['QuantityTotal'],
            $data['QuantityLockedForShipment'],
            $data['QuantityLockedForAvailability'],
            $data['QuantityInPickingLists'],
        );
    }
}
