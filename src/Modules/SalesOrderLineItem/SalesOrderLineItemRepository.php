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
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Responses\CreateSalesOrderLineItemResponse;
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
     */
    public function createSalesOrderLineItem(CreateSalesOrderLineItemRequest $request): CreateSalesOrderLineItemResponse
    {
        $permissions = [Permission::CreateSalesOrderLineItem];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $body = [
            'ItemId'           => $request->itemId,
            'Name'             => $request->name,
            'SKU'              => $request->sku,
            'Quantity'         => $request->quantity,
            'SalesUnit'        => $request->salesUnit,
            'SalesPriceNet'    => $request->salesPriceNet,
            'SalesPriceGross'  => $request->salesPriceGross,
            'Discount'         => $request->discount,
            'PurchasePriceNet' => $request->purchasePriceNet,
            'TaxRate'          => $request->taxRate,
            'Notice'           => $request->notice,
        ];

        $body = $this->deleteNullValues($body);
        $response = $this->post('/v1/salesOrders/' . $request->salesOrderId . '/lineitems', [$body]);

        if ($response->wasSuccessful) {
            return new CreateSalesOrderLineItemResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
