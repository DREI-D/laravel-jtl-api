<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects\SalesOrderDto;

readonly class CreateSalesOrderResponse
{
    public SalesOrderDto $salesOrder;

    public function __construct(public ApiResponse $response)
    {
        $this->salesOrder = SalesOrderDto::fromResponse($this->response->json);
    }
}
