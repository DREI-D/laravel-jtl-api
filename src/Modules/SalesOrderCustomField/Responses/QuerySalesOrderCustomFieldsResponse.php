<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\DataTransferObjects\SalesOrderCustomFieldDto;

readonly class QuerySalesOrderCustomFieldsResponse
{
    public array $customFields;

    public function __construct(public ApiResponse $response)
    {
        $this->customFields = array_map(static function ($item) {
            return SalesOrderCustomFieldDto::fromResponse($item);
        }, $this->response->json);
    }
}
