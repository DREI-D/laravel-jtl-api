<?php

namespace DREID\LaravelJtlApi\Modules\Info\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Info\DataTransferObjects\InfoDto;

readonly class GetStatusResponse
{
    public InfoDto $info;

    public function __construct(public ApiResponse $response)
    {
        $this->info = InfoDto::fromResponse($this->response->json);
    }
}
