<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\SalesOrderWorkflow;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\SalesOrderWorkflowRepository;
use Illuminate\Console\Command;

class TestSalesOrderWorkflowQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:sales-order-workflow-query';

    protected $description = 'Tests the sales order workflow query endpoint';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(): void
    {
        $response = app(SalesOrderWorkflowRepository::class)->querySalesOrderWorkflowEvents();

        dd($response->salesOrderWorkflowEvents);
    }
}
