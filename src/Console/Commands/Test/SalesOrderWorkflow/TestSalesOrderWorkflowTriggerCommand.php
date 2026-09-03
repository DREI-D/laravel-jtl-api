<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\SalesOrderWorkflow;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects\SalesOrderDto;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\QuerySalesOrdersRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\SalesOrderRepository;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\DataTransferObjects\SalesOrderWorkflowEventDto;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\Requests\TriggerSalesOrderWorkflowEventRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\SalesOrderWorkflowRepository;
use Illuminate\Console\Command;
use Throwable;

class TestSalesOrderWorkflowTriggerCommand extends Command
{
    protected $signature = 'jtl-api:test:sales-order-workflow-trigger';

    protected $description = 'Tests the sales order workflow trigger endpoint';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     * @throws Throwable
     */
    public function handle(): void
    {
        $response = app(SalesOrderRepository::class)->querySalesOrders(new QuerySalesOrdersRequest(pageSize: 1));
        throw_if($response->totalItems === 0);

        /** @var SalesOrderDto $salesOrder */
        $salesOrder = $response->items[0];

        $response = app(SalesOrderWorkflowRepository::class)->querySalesOrderWorkflowEvents();
        throw_if(count($response->salesOrderWorkflowEvents) === 0);

        /** @var SalesOrderWorkflowEventDto $event */
        $event = $response->salesOrderWorkflowEvents[0];

        $response = app(SalesOrderWorkflowRepository::class)->triggerSalesOrderWorkflowEvent(
            new TriggerSalesOrderWorkflowEventRequest(
                salesOrderId: $salesOrder->id,
                id: $event->id,
            )
        );

        dd($response);
    }
}
