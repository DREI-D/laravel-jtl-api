<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Requests;

readonly class QuerySalesOrderCustomFieldValuesRequest
{
    public function __construct(
        public int $salesOrderId,
    ) {}
}
