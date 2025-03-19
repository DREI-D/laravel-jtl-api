<?php

namespace DREID\LaravelJtlApi\Modules\ItemImage\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\ItemImage\DataTransferObjects\ItemImageDto;

readonly class QueryItemImagesResponse
{
    public array $images;

    public function __construct(public ApiResponse $response)
    {
        $this->images = array_map(static function ($item) {
            return ItemImageDto::fromResponse($item);
        }, $this->response->json);
    }
}
