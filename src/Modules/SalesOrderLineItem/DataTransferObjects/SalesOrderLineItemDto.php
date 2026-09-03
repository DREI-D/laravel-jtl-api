<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem\DataTransferObjects;

readonly class SalesOrderLineItemDto
{
    public function __construct(
        public int $id,
        public ?int $itemId,
        public ?string $name,
        public ?string $sku,
        public int $type,
        public int $quantity,
        public ?int $quantityDelivered,
        public ?string $salesUnit,
        public ?float $salesPriceNet,
        public ?float $salesPriceGross,
        public ?float $discount,
        public ?float $purchasePriceNet,
        public ?float $taxRate,
        public ?string $notice,
    ) {}

    public static function fromResponse(array $data): static
    {
        return new self(
            $data['id'],
            $data['itemId'] ?? null,
            $data['name'] ?? null,
            $data['sku'] ?? null,
            $data['type'],
            $data['quantity'],
            $data['quantityDelivered'] ?? null,
            $data['salesUnit'] ?? null,
            $data['salesPriceNet']  ?? null,
            $data['salesPriceGross'] ?? null,
            $data['discount'] ?? null,
            $data['purchasePriceNet'] ?? null,
            $data['taxRate'] ?? null,
            $data['notice'] ?? null,
        );
    }
}
