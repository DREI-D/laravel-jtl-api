<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\SalesOrder;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\QuerySalesOrdersRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\SalesOrderRepository;
use Illuminate\Console\Command;

class TestSalesOrderQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:sales-order-query';

    protected $description = 'Tests the sales order query endpoint';

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
        $response = app(SalesOrderRepository::class)->querySalesOrders(new QuerySalesOrdersRequest(pageSize: 1));

        dd($response->items);
    }
}
