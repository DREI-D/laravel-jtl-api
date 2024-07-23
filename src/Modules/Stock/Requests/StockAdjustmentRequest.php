<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Requests;

readonly class StockAdjustmentRequest
{
    public function __construct(
        public int $warehouseId,
        public int $itemId,
        public int $quantity,
        public ?int $storageLocationId = null,
        public ?string $shelfLifeExpirationDate = null,
        public ?string $batchNumber = null,
        public ?float $purchasePriceNet = null,
        public ?array $serialNumbers = null,
        public ?string $comment = null,
    ) {}
}
