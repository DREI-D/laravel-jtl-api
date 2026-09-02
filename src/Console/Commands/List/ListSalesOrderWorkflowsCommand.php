<?php

namespace DREID\LaravelJtlApi\Console\Commands\List;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\SalesOrderWorkflowRepository;
use Illuminate\Console\Command;

class ListSalesOrderWorkflowsCommand extends Command
{
    protected $signature = 'jtl-api:list:sales-order-workflows';
    protected $description = 'Lists the sales order workflows from JTL';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(SalesOrderWorkflowRepository $repository): void
    {
        dd($repository->querySalesOrderWorkflowEvents()->salesOrderWorkflowEvents);
    }
}
