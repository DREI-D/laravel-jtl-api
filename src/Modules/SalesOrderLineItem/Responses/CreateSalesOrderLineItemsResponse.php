<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\DataTransferObjects\SalesOrderLineItemDto;

readonly class CreateSalesOrderLineItemsResponse
{
    public array $salesOrderLineItems;

    public function __construct(public ApiResponse $response)
    {
        $this->salesOrderLineItems = array_map(function (array $data) {
            return SalesOrderLineItemDto::fromResponse($data);
        }, $this->response->json);
    }
}
