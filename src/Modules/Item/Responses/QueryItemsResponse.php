<?php

namespace DREID\LaravelJtlApi\Modules\Item\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryItemsResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        parent::__construct($response, array_map(static function ($item) {
            return ItemDto::fromResponse($item);
        }, $response->json['items']));
    }
}
