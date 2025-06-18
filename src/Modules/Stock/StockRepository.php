<?php

namespace DREID\LaravelJtlApi\Modules\Stock;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Stock\Requests\QueryStockChangesRequest;
use DREID\LaravelJtlApi\Modules\Stock\Requests\QueryStocksPerItemRequest;
use DREID\LaravelJtlApi\Modules\Stock\Requests\StockAdjustmentRequest;
use DREID\LaravelJtlApi\Modules\Stock\Responses\QueryStockChangesResponse;
use DREID\LaravelJtlApi\Modules\Stock\Responses\QueryStockPerItemResponse;
use DREID\LaravelJtlApi\Modules\Stock\Responses\StockAdjustmentResponse;
use DREID\LaravelJtlApi\Repository;

class StockRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryStocksPerItem(QueryStocksPerItemRequest $request): QueryStockPerItemResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryStocksPerItem];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/stocks', [
            'itemId'            => $request->itemId,
            'warehouseId'       => $request->warehouseId,
            'storageLocationId' => $request->storageLocationId,
            'pageNumber'        => $request->pageNumber,
            'pageSize'          => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryStockPerItemResponse($response);
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
    public function stockAdjustment(StockAdjustmentRequest $request): StockAdjustmentResponse
    {
        $permissions = [Permission::StockAdjustment];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $body = $this->deleteNullValues([
            'WarehouseId'       => $request->warehouseId,
            'ItemId'            => $request->itemId,
            'Quantity'          => $request->quantity,
            'StorageLocationId' => $request->storageLocationId,
            'BatchNumber'       => $request->batchNumber,
            'PurchasePriceNet'  => $request->purchasePriceNet,
            'SerialNumbers'     => $request->serialNumbers,
            'Comment'           => $request->comment,
        ]);

        $response = $this->post('/stocks', $body);

        if ($response->wasSuccessful) {
            return new StockAdjustmentResponse($response);
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
    public function queryStockChanges(QueryStockChangesRequest $request): QueryStockChangesResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryStockChanges];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/stocks/changes', [
            'itemId'     => $request->itemId,
            'startDate'  => $request->startDate,
            'pageNumber' => $request->pageNumber,
            'pageSize'   => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryStockChangesResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
