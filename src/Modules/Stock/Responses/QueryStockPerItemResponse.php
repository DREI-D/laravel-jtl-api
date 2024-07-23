<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Stock\StockDto;
use DREID\LaravelJtlApi\PaginatedResponse;

readonly class QueryStockPerItemResponse extends PaginatedResponse
{
    public function __construct(public ApiResponse $response)
    {
        $items = array_map(static function ($item) {
            return StockDto::fromResponse($item);
        }, $this->response->json['Items']);

        parent::__construct($response, $items);
    }
}
