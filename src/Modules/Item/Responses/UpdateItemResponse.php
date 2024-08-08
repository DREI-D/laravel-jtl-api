<?php

namespace DREID\LaravelJtlApi\Modules\Item\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDto;

readonly class UpdateItemResponse
{
    public ItemDto $item;

    public function __construct(public ApiResponse $response)
    {
        $this->item = ItemDto::fromResponse($this->response->json);
    }
}
