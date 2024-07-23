<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Stock\DataTransferObjects\StockChangeDto;

readonly class StockAdjustmentResponse
{
    public StockChangeDto $stockChange;

    public function __construct(public ApiResponse $response)
    {
        $this->stockChange = StockChangeDto::fromResponse($this->response->json);
    }
}
