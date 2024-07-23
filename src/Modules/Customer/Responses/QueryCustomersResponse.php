<?php

namespace DREID\LaravelJtlApi\Modules\Customer\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects\CustomerDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryCustomersResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        parent::__construct($response, array_map(static function ($item) {
            return CustomerDto::fromResponse($item);
        }, $response->json['Items']));
    }
}
