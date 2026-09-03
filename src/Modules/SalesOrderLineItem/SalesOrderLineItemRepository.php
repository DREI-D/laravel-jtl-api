<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderLineItem;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests\CreateSalesOrderLineItemsItem;
use DREID\LaravelJtlApi\Modules\SalesOrderLineItem\Requests\CreateSalesOrderLineItemsRequest;
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
     */
    public function createSalesOrderLineItems(CreateSalesOrderLineItemsRequest $request): CreateSalesOrderLineItemsResponse
    {
        $permissions = [Permission::CreateSalesOrderLineItem];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $items = array_map(function (CreateSalesOrderLineItemsItem $item) {
            return $this->deleteNullValues([
                'itemId'           => $item->itemId,
                'name'             => $item->name,
                'sku'              => $item->sku,
                'quantity'         => $item->quantity,
                'salesUnit'        => $item->salesUnit,
                'salesPriceNet'    => $item->salesPriceNet,
                'salesPriceGross'  => $item->salesPriceGross,
                'discount'         => $item->discount,
                'purchasePriceNet' => $item->purchasePriceNet,
                'taxRate'          => $item->taxRate,
                'notice'           => $item->notice,
            ]);
        }, $request->items);

        // todo: test, jtl api 2.0.6 is bugged. Parsing tax rate & discount fails for no reason...
        // https://issues.jtl-software.de/issues/WAWI-87918

        $response = $this->post('/salesOrders/' . $request->salesOrderId . '/lineitems', $items);

        if ($response->wasSuccessful) {
            return new CreateSalesOrderLineItemsResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
