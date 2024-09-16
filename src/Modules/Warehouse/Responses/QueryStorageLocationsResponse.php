<?php

namespace DREID\LaravelJtlApi\Modules\Warehouse\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Warehouse\DataTransferObjects\StorageLocationDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryStorageLocationsResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        parent::__construct($response, array_map(static function ($item) {
            return StorageLocationDto::fromResponse($item);
        }, $response->json['Items']));
    }
}
