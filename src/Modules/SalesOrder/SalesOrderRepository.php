<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrder;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrder\Requests\CreateSalesOrderRequest;
use DREID\LaravelJtlApi\Modules\SalesOrder\Responses\CreateSalesOrderResponse;
use DREID\LaravelJtlApi\Repository;
use DREID\LaravelJtlApi\Traits\MapAddress;

class SalesOrderRepository extends Repository
{
    use MapAddress;

    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function createSalesOrder(CreateSalesOrderRequest $request): CreateSalesOrderResponse
    {
        $permissions = [Permission::CreateSalesOrder];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $salesOrderShippingDetail = $request->salesOrderShippingDetail ? $this->deleteNullValues([
            'ShippingMethodId'      => $request->salesOrderShippingDetail->shippingMethodId,
            'ShippingPriority'      => $request->salesOrderShippingDetail->shippingPriority,
            'ShippingDate'          => $request->salesOrderShippingDetail->shippingDate,
            'EstimatedDeliveryDate' => $request->salesOrderShippingDetail->estimatedDeliveryDate,
            'OnHoldReasonId'        => $request->salesOrderShippingDetail->onHoldReasonId,
            'ExtraWeight'           => $request->salesOrderShippingDetail->extraWeight,
        ]) : null;

        $body = [
            'CustomerId'               => $request->customerId,
            'Number'                   => $request->number,
            'ExternalNumber'           => $request->externalNumber,
            'BillingNumber'            => $request->billingNumber,
            'CompanyId'                => $request->companyId,
            'CustomerVatID'            => $request->customerVatId,
            'BillingAddress'           => $this->mapAddress($request->billingAddress),
            'Shipmentaddress'          => $this->mapAddress($request->shipmentAddress),
            'SalesOrderDate'           => $request->salesOrderDate,
            'SalesOrderShippingDetail' => $salesOrderShippingDetail,
            'ColorcodeId'              => $request->colorCodeId,
            'Comment'                  => $request->comment,
            'CustomerComment'          => $request->customerComment,
            'LanguageIso'              => $request->languageIso,
        ];

        $body = $this->deleteNullValues($body);
        $response = $this->post('/v1/salesOrders', $body);

        if ($response->wasSuccessful) {
            return new CreateSalesOrderResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
