<?php

namespace DREID\LaravelJtlApi\Modules\OnHoldReason\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\OnHoldReason\DataTransferObjects\OnHoldReasonDto;

readonly class QueryOnHoldReasonsResponse
{
    public array $onHoldReasons;

    public function __construct(public ApiResponse $response)
    {
        $this->onHoldReasons = array_map(static function ($item) {
            return OnHoldReasonDto::fromResponse($item);
        }, $this->response->json);
    }
}
