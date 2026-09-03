<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\SalesOrderCustomField;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects\SalesOrderDto;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\QuerySalesOrdersRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\SalesOrderRepository;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Requests\QuerySalesOrderCustomFieldValuesRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\SalesOrderCustomFieldRepository;
use Illuminate\Console\Command;
use Throwable;

class TestSalesOrderCustomFieldValuesQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:sales-order-custom-field-values-query';

    protected $description = 'Tests the item custom field values query endpoint';

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

        $response = app(SalesOrderCustomFieldRepository::class)->querySalesOrderCustomFieldValues(
            new QuerySalesOrderCustomFieldValuesRequest(
                salesOrderId: $salesOrder->id,
            )
        );

        dd($response->customFieldValues);
    }
}
