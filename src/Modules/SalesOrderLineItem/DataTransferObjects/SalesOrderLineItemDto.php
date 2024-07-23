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
            $data['Id'],
            $data['ItemId'] ?? null,
            $data['Name'] ?? null,
            $data['SKU'] ?? null,
            $data['Type'],
            $data['Quantity'],
            $data['QuantityDelivered'] ?? null,
            $data['SalesUnit'] ?? null,
            $data['SalesPriceNet']  ?? null,
            $data['SalesPriceGross'] ?? null,
            $data['Discount'] ?? null,
            $data['PurchasePriceNet'] ?? null,
            $data['TaxRate'] ?? null,
            $data['Notice'] ?? null,
        );
    }
}
