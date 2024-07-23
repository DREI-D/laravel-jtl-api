<?php

namespace DREID\LaravelJtlApi\Modules\CustomerGroup\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\CustomerGroup\DataTransferObjects\CustomerGroupDto;

readonly class QueryCustomerGroupsResponse
{
    public array $customerGroups;

    public function __construct(public ApiResponse $response)
    {
        $this->customerGroups = array_map(static function ($item) {
            return CustomerGroupDto::fromResponse($item);
        }, $this->response->json);
    }
}
