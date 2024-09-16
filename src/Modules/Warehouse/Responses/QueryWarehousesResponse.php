<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Warehouse\DataTransferObjects\WarehouseDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryWarehousesResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        parent::__construct($response, array_map(static function ($item) {
            return WarehouseDto::fromResponse($item);
        }, $response->json['Items']));
    }
}
