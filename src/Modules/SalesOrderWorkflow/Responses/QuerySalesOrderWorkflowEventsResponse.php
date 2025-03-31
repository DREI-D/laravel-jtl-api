<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\Responses;

use DREID\LaravelJtlApi\ApiResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\DataTransferObjects\SalesOrderWorkflowEventDto;

readonly class QuerySalesOrderWorkflowEventsResponse
{
    public array $salesOrderWorkflowEvents;

    public function __construct(public ApiResponse $response)
    {
        $this->salesOrderWorkflowEvents = array_map(static function ($item) {
            return SalesOrderWorkflowEventDto::fromResponse($item);
        }, $response->json);
    }
}
