<?php

namespace DREID\LaravelJtlApi\Modules\ColorCode\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\ColorCode\DataTransferObjects\ColorCodeDto;

readonly class QueryColorCodesResponse
{
    public array $colorCodes;

    public function __construct(public ApiResponse $response)
    {
        $this->colorCodes = array_map(static function ($item) {
            return ColorCodeDto::fromResponse($item);
        }, $this->response->json);
    }
}
