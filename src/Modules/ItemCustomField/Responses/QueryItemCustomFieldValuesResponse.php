<?php

namespace DREID\LaravelJtlApi\Modules\ItemCustomField\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\ItemCustomField\DataTransferObjects\ItemCustomFieldValueDto;

readonly class QueryItemCustomFieldValuesResponse
{
    public array $customFieldValues;

    public function __construct(public ApiResponse $response)
    {
        $this->customFieldValues = array_map(static function ($item) {
            return ItemCustomFieldValueDto::fromResponse($item);
        }, $this->response->json);
    }
}
