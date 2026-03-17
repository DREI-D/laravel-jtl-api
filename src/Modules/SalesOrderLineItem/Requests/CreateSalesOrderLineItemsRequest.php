<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests;

readonly class CreateSalesOrderLineItemsRequest
{
    public function __construct(
        public int $salesOrderId,
        public array $items
    ) {}
}
