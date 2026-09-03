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
            $data['itemId'],
            $data['warehouseId'],
            $data['storageLocationId'],
            $data['quantity'],
            $data['changedDate'] ?? null,
            $data['shelfLifeExpirationDate'] ?? null,
            $data['batchNumber'] ?? null,
            $data['comment'],
            $data['username'],
        );
    }
}
