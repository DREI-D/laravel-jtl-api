<?php

namespace DREID\LaravelJtlApi\Modules\Supplier\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Supplier\SupplierDto;

readonly class QuerySuppliersResponse
{
    public array $suppliers;

    public function __construct(public ApiResponse $response)
    {
        $this->suppliers = array_map(static function ($item) {
            return SupplierDto::fromResponse($item);
        }, $this->response->json);
    }
}
