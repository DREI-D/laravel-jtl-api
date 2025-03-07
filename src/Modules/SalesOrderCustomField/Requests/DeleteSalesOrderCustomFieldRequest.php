<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Requests;

readonly class DeleteSalesOrderCustomFieldRequest
{
    public function __construct(
        public int $salesOrderId,
        public int $customFieldId,
    ) {}
}
