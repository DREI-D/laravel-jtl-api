<?php

namespace DREID\LaravelJtlApi\Modules\Invoice\Responses;

use DREID\LaravelJtlApi\ApiResponse;

readonly class PdfInvoiceResponse
{
    public string $content;

    public function __construct(public ApiResponse $response)
    {
        $this->content = $this->response->body;
    }
}
