<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Requests;

readonly class UpdateSalesOrderCustomFieldRequest
{
    public function __construct(
        public int $salesOrderId,
        public int $customFieldId,
        public mixed $value,
    ) {}
}
