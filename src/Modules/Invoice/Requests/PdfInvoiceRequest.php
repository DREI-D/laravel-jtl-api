<?php

namespace DREID\LaravelJtlApi\Modules\Invoice\Requests;

readonly class PdfInvoiceRequest
{
    public function __construct(
        public int $invoiceId,
    ) {}
}
