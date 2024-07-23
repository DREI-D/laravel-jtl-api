<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests;

readonly class CreateSalesOrderLineItemRequest
{
    public function __construct(
        public int $salesOrderId,
        public int $quantity,
        public ?int $itemId = null,
        public ?string $name = null,
        public ?string $sku = null,
        public ?string $salesUnit = null,
        public ?string $salesPriceNet = null,
        public ?string $salesPriceGross = null,
        public ?float $discount = null,
        public ?float $purchasePriceNet = null,
        public ?float $taxRate = null,
        public ?string $notice = null,
    ) {}
}
