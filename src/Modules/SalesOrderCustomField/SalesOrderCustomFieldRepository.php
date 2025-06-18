<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderCustomField;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Requests\DeleteSalesOrderCustomFieldRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Requests\QuerySalesOrderCustomFieldValuesRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Requests\UpdateSalesOrderCustomFieldRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Responses\DeleteSalesOrderCustomFieldResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Responses\QuerySalesOrderCustomFieldsResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Responses\QuerySalesOrderCustomFieldValuesResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderCustomField\Responses\UpdateSalesOrderCustomFieldResponse;
use DREID\LaravelJtlApi\Repository;

class SalesOrderCustomFieldRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function querySalesOrderCustomFields(): QuerySalesOrderCustomFieldsResponse
    {
        $permissions = [Permission::AllRead, Permission::QuerySalesOrderCustomFields];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/salesOrders/customfields');

        if ($response->wasSuccessful) {
            return new QuerySalesOrderCustomFieldsResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingPermissionException
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     */
    public function querySalesOrderCustomFieldValues(QuerySalesOrderCustomFieldValuesRequest $request): QuerySalesOrderCustomFieldValuesResponse
    {
        $permissions = [Permission::AllRead, Permission::QuerySalesOrderCustomFieldValues];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/salesOrders/' . $request->salesOrderId . '/customfields');

        if ($response->wasSuccessful) {
            return new QuerySalesOrderCustomFieldValuesResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingPermissionException
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     */
    public function updateSalesOrderCustomField(UpdateSalesOrderCustomFieldRequest $request): UpdateSalesOrderCustomFieldResponse
    {
        $permissions = [Permission::AllRead, Permission::UpdateSalesOrderCustomField];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->patch('/salesOrders/' . $request->salesOrderId . '/customfields/' . $request->customFieldId, [
            'Value' => $request->value,
        ]);

        if ($response->wasSuccessful) {
            return new UpdateSalesOrderCustomFieldResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingPermissionException
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     */
    public function deleteSalesOrderCustomField(DeleteSalesOrderCustomFieldRequest $request): DeleteSalesOrderCustomFieldResponse
    {
        $permissions = [Permission::AllRead, Permission::DeleteSalesOrderCustomField];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->delete('/salesOrders/' . $request->salesOrderId . '/customfields/' . $request->customFieldId);

        if ($response->wasSuccessful) {
            return new DeleteSalesOrderCustomFieldResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
