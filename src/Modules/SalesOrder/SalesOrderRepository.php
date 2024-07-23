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

class SalesOrderRepository extends Repository
{
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

        $body = [
            'CustomerId'      => $request->customerId,
            'Number'          => $request->number,
            'ExternalNumber'  => $request->externalNumber,
            'BillingNumber'   => $request->billingNumber,
            'CompanyId'       => $request->companyId,
            'CustomerVatID'   => $request->customerVatId,
            'BillingAddress'  => $request->billingAddress ? [
                'Company'           => $request->billingAddress->company,
                'Company2'          => $request->billingAddress->company2,
                'FormOfAddress'     => $request->billingAddress->formOfAddress,
                'Title'             => $request->billingAddress->title,
                'FirstName'         => $request->billingAddress->firstName,
                'LastName'          => $request->billingAddress->lastName,
                'Street'            => $request->billingAddress->street,
                'Address2'          => $request->billingAddress->address2,
                'PostalCode'        => $request->billingAddress->postalCode,
                'State'             => $request->billingAddress->state,
                'VatID'             => $request->billingAddress->vatId,
                'PhoneNumber'       => $request->billingAddress->phoneNumber,
                'MobilePhoneNumber' => $request->billingAddress->mobilePhoneNumber,
                'EmailAddress'      => $request->billingAddress->emailAddress,
                'Fax'               => $request->billingAddress->fax,
            ] : null,
            'Shipmentaddress' => $request->shipmentAddress ? [
                'Company'           => $request->shipmentAddress->company,
                'Company2'          => $request->shipmentAddress->company2,
                'FormOfAddress'     => $request->shipmentAddress->formOfAddress,
                'Title'             => $request->shipmentAddress->title,
                'FirstName'         => $request->shipmentAddress->firstName,
                'LastName'          => $request->shipmentAddress->lastName,
                'Street'            => $request->shipmentAddress->street,
                'Address2'          => $request->shipmentAddress->address2,
                'PostalCode'        => $request->shipmentAddress->postalCode,
                'State'             => $request->shipmentAddress->state,
                'VatID'             => $request->shipmentAddress->vatId,
                'PhoneNumber'       => $request->shipmentAddress->phoneNumber,
                'MobilePhoneNumber' => $request->shipmentAddress->mobilePhoneNumber,
                'EmailAddress'      => $request->shipmentAddress->emailAddress,
                'Fax'               => $request->shipmentAddress->fax,
            ] : null,
            'SalesOrderDate'  => $request->salesOrderDate,
            'ColorcodeId'     => $request->colorCodeId,
            'Comment'         => $request->comment,
            'CustomerComment' => $request->customerComment,
            'LanguageIso'     => $request->languageIso,
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
