<?php

namespace DREID\LaravelJtlApi\Modules\Stock\DataTransferObjects;

readonly class StockChangeDto
{
    public function __construct(
        public int $itemId,
        public int $warehouseId,
        public int $storageLocationId,
        public int $quantity,
        public string $changedDate,
        public string $shellLifeExpirationDate,
        public string $batchNumber,
        public string $comment,
        public string $username,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new static(
            $data['ItemId'],
            $data['WarehouseId'],
            $data['StorageLocationId'],
            $data['Quantity'],
            $data['ChangedDate'] ?? null,
            $data['ShelfLifeExpirationDate'] ?? null,
            $data['BatchNumber'] ?? null,
            $data['Comment'],
            $data['Username'],
        );
    }
}
