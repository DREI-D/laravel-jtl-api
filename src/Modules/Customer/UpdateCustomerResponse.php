<?php

namespace DREID\LaravelJtlApi\Modules\Customer;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Customer\DataTransferObjects\CustomerDto;

readonly class UpdateCustomerResponse
{
    public CustomerDto $customer;

    public function __construct(public ApiResponse $response)
    {
        $this->customer = CustomerDto::fromResponse($response->json);
    }
}
