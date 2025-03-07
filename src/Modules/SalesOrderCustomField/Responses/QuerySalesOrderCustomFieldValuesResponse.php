<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\DataTransferObjects\SalesOrderCustomFieldValueDto;

readonly class QuerySalesOrderCustomFieldValuesResponse
{
    public array $customFieldValues;

    public function __construct(public ApiResponse $response)
    {
        $this->customFieldValues = array_map(static function ($item) {
            return SalesOrderCustomFieldValueDto::fromResponse($item);
        }, $this->response->json);
    }
}
