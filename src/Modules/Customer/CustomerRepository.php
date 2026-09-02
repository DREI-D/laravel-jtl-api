<?php

namespace DREID\LaravelJtlApi\Modules\Customer;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Customer\Requests\CreateCustomerRequest;
use DREID\LaravelJtlApi\Modules\Customer\Requests\QueryCustomersRequest;
use DREID\LaravelJtlApi\Modules\Customer\Requests\UpdateCustomerRequest;
use DREID\LaravelJtlApi\Modules\Customer\Responses\CreateCustomerResponse;
use DREID\LaravelJtlApi\Modules\Customer\Responses\QueryCustomersResponse;
use DREID\LaravelJtlApi\Modules\Customer\Responses\UpdateCustomerResponse;
use DREID\LaravelJtlApi\Repository;
use DREID\LaravelJtlApi\Traits\MapAddress;

class CustomerRepository extends Repository
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
    public function queryCustomers(QueryCustomersRequest $request): QueryCustomersResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryCustomers];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/customers', [
            'searchKeyWord'  => $request->searchKeyWord,
            'number'         => $request->number,
            'groupId'        => $request->groupId,
            'categoryId'     => $request->categoryId,
            'lastChangeFrom' => $request->lastChangeFrom,
            'lastChangeTo'   => $request->lastChangeTo,
            'pageNumber'     => $request->pageNumber,
            'pageSize'       => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryCustomersResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function createCustomer(CreateCustomerRequest $request): CreateCustomerResponse
    {
        $permissions = [Permission::CreateCustomer];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $body = $this->buildCustomerBody($request);
        $response = $this->post('/customers', $body);

        if ($response->wasSuccessful) {
            return new CreateCustomerResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function updateCustomer(UpdateCustomerRequest $request): UpdateCustomerResponse
    {
        $permissions = [Permission::UpdateCustomer];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $body = $this->buildCustomerBody($request);
        $response = $this->patch('/customers/' . $request->customerId, $body);

        if ($response->wasSuccessful) {
            return new UpdateCustomerResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    private function buildCustomerBody(CreateCustomerRequest|UpdateCustomerRequest $request): array
    {
        return $this->deleteNullValues([
            'Number'                  => $request->number,
            'CustomerGroupId'         => $request->customerGroupId,
            'BillingAddress'          => $this->mapAddress($request->billingAddress),
            'Shipmentaddress'         => $this->mapAddress($request->shipmentAddress),
            'CustomerSince'           => $request->customerSince,
            'LastChange'              => $request->lastChange,
            'LanguageIso'             => $request->languageIso,
            'InternalCompanyId'       => $request->internalCompanyId,
            'CustomerCategoryId'      => $request->customerCategoryId,
            'TaxIdentificationNumber' => $request->taxIdentificationNumber,
            'Birthday'                => $request->birthday,
            'IsLocked'                => $request->isLocked,
        ]);
    }
}
