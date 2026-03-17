<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests\CreateSalesOrderLineItemRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests\CreateSalesOrderLineItemsItem;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests\CreateSalesOrderLineItemsRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Responses\CreateSalesOrderLineItemResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Responses\CreateSalesOrderLineItemsResponse;
use DREID\LaravelJtlApi\Repository;

class SalesOrderLineItemRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     * @deprecated use createSalesOrderLineItems instead
     */
    public function createSalesOrderLineItem(CreateSalesOrderLineItemRequest $request): CreateSalesOrderLineItemResponse
    {
        $response = $this->createSalesOrderLineItems(
            new CreateSalesOrderLineItemsRequest(
                $request->salesOrderId,
                [
                    new CreateSalesOrderLineItemsItem(
                        quantity: $request->quantity,
                        itemId: $request->itemId,
                        name: $request->name,
                        sku: $request->sku,
                        salesUnit: $request->salesUnit,
                        salesPriceNet: $request->salesPriceNet,
                        salesPriceGross: $request->salesPriceGross,
                        discount: $request->discount,
                        purchasePriceNet: $request->purchasePriceNet,
                        taxRate: $request->taxRate,
                        notice: $request->notice,
                    )
                ]
            )
        );

        return new CreateSalesOrderLineItemResponse(
            $response->response,
            $response->salesOrderLineItems[0]
        );
    }

    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function createSalesOrderLineItems(CreateSalesOrderLineItemsRequest $request): CreateSalesOrderLineItemsResponse
    {
        $permissions = [Permission::CreateSalesOrderLineItem];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $items = array_map(function (CreateSalesOrderLineItemsItem $item) {
            return $this->deleteNullValues([
                'ItemId'           => $item->itemId,
                'Name'             => $item->name,
                'SKU'              => $item->sku,
                'Quantity'         => $item->quantity,
                'SalesUnit'        => $item->salesUnit,
                'SalesPriceNet'    => $item->salesPriceNet,
                'SalesPriceGross'  => $item->salesPriceGross,
                'Discount'         => $item->discount,
                'PurchasePriceNet' => $item->purchasePriceNet,
                'TaxRate'          => $item->taxRate,
                'Notice'           => $item->notice,
            ]);
        }, $request->items);

        $response = $this->post('/v1/salesOrders/' . $request->salesOrderId . '/lineitems', $items);

        if ($response->wasSuccessful) {
            return new CreateSalesOrderLineItemsResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
