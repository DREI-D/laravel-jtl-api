<?php

namespace DREID\LaravelJtlApi\Modules\ShippingMethod\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\ShippingMethod\DataTransferObjects\ShippingMethodDto;

readonly class QueryShippingMethodsResponse
{
    public array $shippingMethods;

    public function __construct(public ApiResponse $response)
    {
        $this->shippingMethods = array_map(static function ($item) {
            return ShippingMethodDto::fromResponse($item);
        }, $this->response->json);
    }
}
