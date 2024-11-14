<?php

namespace DREID\LaravelJtlApi\Modules\ItemCustomField;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\ItemCustomField\Requests\DeleteItemCustomFieldRequest;
use DREID\LaravelJtlApi\Modules\ItemCustomField\Requests\QueryItemCustomFieldValuesRequest;
use DREID\LaravelJtlApi\Modules\ItemCustomField\Requests\UpdateItemCustomFieldRequest;
use DREID\LaravelJtlApi\Modules\ItemCustomField\Responses\QueryItemCustomFieldsResponse;
use DREID\LaravelJtlApi\Modules\ItemCustomField\Responses\QueryItemCustomFieldValuesResponse;
use DREID\LaravelJtlApi\Modules\ItemCustomField\Responses\UpdateItemCustomFieldResponse;
use DREID\LaravelJtlApi\Repository;

class ItemCustomFieldRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryItemCustomFields(): QueryItemCustomFieldsResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryItemCustomFields];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/items/customfields');

        if ($response->wasSuccessful) {
            return new QueryItemCustomFieldsResponse($response);
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
    public function queryItemCustomFieldValues(QueryItemCustomFieldValuesRequest $request): QueryItemCustomFieldValuesResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryItemCustomFieldValues];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/items/' . $request->itemId . '/customfields');

        if ($response->wasSuccessful) {
            return new QueryItemCustomFieldValuesResponse($response);
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
    public function updateItemCustomField(UpdateItemCustomFieldRequest $request): UpdateItemCustomFieldResponse
    {
        $permissions = [Permission::AllRead, Permission::UpdateItemCustomField];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->patch('/v1/items/' . $request->itemId . '/customfields/' . $request->customFieldId, [
            'Value' => $request->value,
        ]);

        if ($response->wasSuccessful) {
            return new UpdateItemCustomFieldResponse($response);
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
    public function deleteItemCustomField(DeleteItemCustomFieldRequest $request): UpdateItemCustomFieldResponse
    {
        $permissions = [Permission::AllRead, Permission::DeleteItemCustomField];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->delete('/v1/items/' . $request->itemId . '/customfields/' . $request->customFieldId);

        if ($response->wasSuccessful) {
            return new UpdateItemCustomFieldResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
