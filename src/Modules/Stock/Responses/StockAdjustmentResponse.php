<?php

namespace DREID\LaravelJtlApi\Modules\Stock\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Stock\DataTransferObjects\StockAdjustmentDto;

readonly class StockAdjustmentResponse
{
    public StockAdjustmentDto $stockAdjustment;

    public function __construct(public ApiResponse $response)
    {
        $this->stockAdjustment = StockAdjustmentDto::fromResponse($this->response->json);
    }
}
