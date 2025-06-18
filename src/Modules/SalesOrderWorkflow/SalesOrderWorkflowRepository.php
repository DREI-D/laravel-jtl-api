<?php

namespace DREID\LaravelJtlApi\Modules\SalesOrderWorkflow;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\Requests\TriggerSalesOrderWorkflowEventRequest;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\Responses\QuerySalesOrderWorkflowEventsResponse;
use DREID\LaravelJtlApi\Modules\SalesOrderWorkflow\Responses\TriggerSalesOrderWorkflowEventResponse;
use DREID\LaravelJtlApi\Repository;

class SalesOrderWorkflowRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function querySalesOrderWorkflowEvents(): QuerySalesOrderWorkflowEventsResponse
    {
        $permissions = [Permission::QuerySalesOrderWorkflowEvents, Permission::AllRead];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/salesOrders/workflowEvents');

        if ($response->wasSuccessful) {
            return new QuerySalesOrderWorkflowEventsResponse($response);
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
    public function triggerSalesOrderWorkflowEvent(TriggerSalesOrderWorkflowEventRequest $request): TriggerSalesOrderWorkflowEventResponse
    {
        $permissions = [Permission::TriggerSalesOrderWorkflowEvent];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $body = [
            'Id' => $request->id,
        ];

        $response = $this->post('/salesOrders/' . $request->salesOrderId . '/workflowEvents', $body);

        if ($response->wasSuccessful) {
            return new TriggerSalesOrderWorkflowEventResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
