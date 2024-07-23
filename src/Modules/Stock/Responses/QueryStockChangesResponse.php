<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Stock\StockChangeDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryStockChangesResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        $items = array_map(static function ($item) {
            return StockChangeDto::fromResponse($item);
        }, $response->json['Items']);

        parent::__construct($response, $items);
    }
}
