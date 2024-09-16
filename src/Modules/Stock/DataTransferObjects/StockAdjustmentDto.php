<?php

namespace DREID\LaravelJtlApi\Modules\Stock\DataTransferObjects;

readonly class StockAdjustmentDto
{
    public function __construct(
        public int $warehouseId,
        public int $storageLocationId,
        public string $storageLocationName,
        public int $itemId,
        public int $quantityTotal,
        public int $quantityLockedForShipment,
        public int $quantityLockedForAvailability,
        public int $quantityInPickingLists,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new static(
            $data['WarehouseId'],
            $data['StorageLocationId'],
            $data['StorageLocationName'],
            $data['ItemId'],
            $data['QuantityTotal'],
            $data['QuantityLockedForShipment'],
            $data['QuantityLockedForAvailability'],
            $data['QuantityInPickingLists'],
        );
    }
}
