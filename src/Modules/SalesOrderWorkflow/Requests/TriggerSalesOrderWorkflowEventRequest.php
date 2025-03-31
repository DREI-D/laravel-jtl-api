<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\Requests;

readonly class TriggerSalesOrderWorkflowEventRequest
{
    public function __construct(
        public int $salesOrderId,
        public int $id,
    ) {}
}
