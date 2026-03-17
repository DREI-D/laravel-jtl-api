<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\DataTransferObjects\SalesOrderLineItemDto;

readonly class CreateSalesOrderLineItemResponse
{
    public function __construct(
        public ApiResponse $response,
        public SalesOrderLineItemDto $salesOrderLineItem
    ) {}
}
