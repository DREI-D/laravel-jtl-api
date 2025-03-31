<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\Responses;

use DREID\LaravelJtlApi\ApiResponse;

readonly class TriggerSalesOrderWorkflowEventResponse
{
    public function __construct(public ApiResponse $response) {}
}
