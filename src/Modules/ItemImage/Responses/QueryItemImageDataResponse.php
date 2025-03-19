<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\ItemImage\DataTransferObjects\ItemImageDto;

readonly class QueryItemImageDataResponse
{
    public string $content;

    public function __construct(public ApiResponse $response)
    {
        $this->content = $this->response->body;
    }
}
