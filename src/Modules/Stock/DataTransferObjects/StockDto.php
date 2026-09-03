<?php

namespace DREID\LaravelJtlApi\Modules\Stock\DataTransferObjects;

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
            $data['warehouseId'],
            $data['storageLocationId'],
            $data['storageLocationName'],
            $data['itemId'],
            $data['shelfLifeExpirationDate'] ?? null,
            $data['batchNumber'] ?? null,
            $data['quantityTotal'],
            $data['quantityLockedForShipment'],
            $data['quantityLockedForAvailability'],
            $data['quantityInPickingLists'],
        );
    }
}
