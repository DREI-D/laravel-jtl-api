<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\DataTransferObjects\SalesOrderLineItemDto;

readonly class CreateSalesOrderLineItemResponse
{
    public SalesOrderLineItemDto $salesOrderLineItem;

    public function __construct(public ApiResponse $response)
    {
        $this->salesOrderLineItem = SalesOrderLineItemDto::fromResponse($this->response->json[0]);
    }
}
