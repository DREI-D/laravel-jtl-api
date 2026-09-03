<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\SalesOrderLineItem;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrder\DataTransferObjects\SalesOrderDto;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\QuerySalesOrdersRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\SalesOrderRepository;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests\CreateSalesOrderLineItemsItem;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests\CreateSalesOrderLineItemsRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\SalesOrderLineItemRepository;
use Illuminate\Console\Command;
use Throwable;

class TestSalesOrderLineItemCreateCommand extends Command
{
    protected $signature = 'jtl-api:test:sales-order-line-item-create';

    protected $description = 'Tests the sales order line item create endpoint';

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

        // todo: test, bugged in jtl 2.0.6

        $response = app(SalesOrderLineItemRepository::class)->createSalesOrderLineItems(
            new CreateSalesOrderLineItemsRequest(
                salesOrderId: $salesOrder->id,
                items: [
                    new CreateSalesOrderLineItemsItem(
                        quantity: 1,
                        itemId: null,
                        name: 'TEST Freiposition',
                        sku: null,
                        salesUnit: 1,
                        salesPriceNet: 1.0,
                        salesPriceGross: null,
                        discount: null,
                        purchasePriceNet: null,
                        taxRate: null,
                        notice: 'TEST notice'
                    ),
                ]
            )
        );

        dd($response->salesOrderLineItems);
    }
}
