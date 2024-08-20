<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects\SalesOrderDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QuerySalesOrdersResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        parent::__construct($response, array_map(static function ($item) {
            return SalesOrderDto::fromResponse($item);
        }, $response->json['Items']));
    }
}
