<?php

namespace DREID\LaravelJtlApi\Modules\ItemCustomField\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\ItemCustomField\DataTransferObjects\ItemCustomFieldDto;

readonly class QueryItemCustomFieldsResponse
{
    public array $customFields;

    public function __construct(public ApiResponse $response)
    {
        $this->customFields = array_map(static function ($item) {
            return ItemCustomFieldDto::fromResponse($item);
        }, $this->response->json);
    }
}
