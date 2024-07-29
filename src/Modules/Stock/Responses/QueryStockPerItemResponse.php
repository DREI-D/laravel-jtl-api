<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Stock\DataTransferObjects\StockDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryStockPerItemResponse extends PaginatedResponse
{
    public function __construct(ApiResponse $response)
    {
        $items = array_map(static function ($item) {
            return StockDto::fromResponse($item);
        }, $response->json['Items']);

        parent::__construct($response, $items);
    }
}
