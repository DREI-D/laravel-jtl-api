<?php

namespace DREID\LaravelJtlApi\Modules\Item;

use DREID\LaravelJtlApi\Enums\Permission;
use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Item\Requests\CreateItemRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemCategoryRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use DREID\LaravelJtlApi\Modules\Item\Responses\CreateItemResponse;
use DREID\LaravelJtlApi\Modules\Item\Responses\QueryItemsResponse;
use DREID\LaravelJtlApi\Repository;

class ItemRepository extends Repository
{
    /**
     * @throws MissingApiKeyException
     * @throws MissingLicenseException
     * @throws MissingPermissionException
     * @throws UnauthorizedException
     * @throws UnhandledResponseException
     * @throws ConnectionException
     */
    public function queryItems(QueryItemsRequest $request): QueryItemsResponse
    {
        $permissions = [Permission::AllRead, Permission::QueryItems];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $response = $this->get('/v1/items', [
            'searchKeyWord'            => $request->searchKeyWord,
            'categoryId'               => $request->categoryId,
            'manufacturerId'           => $request->manufacturerId,
            'parentItemId'             => $request->parentItemId,
            'changedSince'             => $request->changedSince,
            'isActiveOnSalesChannelId' => $request->isActiveOnSalesChannelId,
            'pageNumber'               => $request->pageNumber,
            'pageSize'                 => $request->pageSize,
        ]);

        if ($response->wasSuccessful) {
            return new QueryItemsResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function createItem(CreateItemRequest $request): CreateItemResponse
    {
        $permissions = [Permission::CreateItem];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $body = $this->deleteNullValues([
            'SKU'                => $request->sku,
            'ManufacturerId'     => $request->manufacturerId,
            'Categories'         => array_map(function (ItemCategoryRequest $categoryRequest) {
                return [
                    'CategoryId' => $categoryRequest->categoryId
                ];
            }, $request->categories),
            'Name'               => $request->name,
            'Description'        => $request->description,
            'ShortDescription'   => $request->shortDescription,
            'Identifiers'        => $request->identifiers ? $this->deleteNullValues([
                'Gtin'               => $request->identifiers->gtin,
                'ManufacturerNumber' => $request->identifiers->manufacturerNumber,
                'ISBN'               => $request->identifiers->isbn,
                'UPC'                => $request->identifiers->upc,
                'AmazonFnsku'        => $request->identifiers->amazonFnsku,
                'Asins'              => $request->identifiers->asins,
                'OwnIdentifier'      => $request->identifiers->ownIdentifier,
            ]) : null,
            'ItemPriceData'      => $request->itemPriceData ? $this->deleteNullValues([
                'SalesPriceNet'        => $request->itemPriceData->salesPriceNet,
                'SuggestedRetailPrice' => $request->itemPriceData->suggestedRetailPrice,
                'PurchasePriceNet'     => $request->itemPriceData->purchasePriceNet,
                'EbayPrice'            => $request->itemPriceData->ebayPrice,
                'AmazonPrice'          => $request->itemPriceData->amazonPrice,
            ]) : null,
            'StorageOptions'     => $request->storageOptions ? $this->deleteNullValues([
                'InventoryManagementActive'             => $request->storageOptions->inventoryManagementActive,
                'SplitQuantity'                         => $request->storageOptions->splitQuantity,
                'GlobalMinimumStockLevel'               => $request->storageOptions->globalMinimumStock,
                'Buffer'                                => $request->storageOptions->buffer,
                'SerialNumberItem'                      => $request->storageOptions->serialNumberItem,
                'SerialNumberTracking'                  => $request->storageOptions->serialNumberTracking,
                'SubjectToShelfLifeExpirationDate'      => $request->storageOptions->subjectToShelfLifeExpirationDate,
                'SubjectToBatchItem'                    => $request->storageOptions->subjectToBatchItem,
                'ProcurementTime'                       => $request->storageOptions->procurementTime,
                'DetermineProcurementTimeAutomatically' => $request->storageOptions->determineProcurementTimeAutomatically,
                'AdditionalHandlingTime'                => $request->storageOptions->additionalHandlingTime,
            ]) : null,
            'CountryOfOrigin'    => $request->countryOfOrigin,
            'Dimensions'         => $request->dimensions ? $this->deleteNullValues([
                'Length' => $request->dimensions->length,
                'Width'  => $request->dimensions->width,
                'Height' => $request->dimensions->height,
            ]) : null,
            'Weights'            => $request->weights ? $this->deleteNullValues([
                'ItemWeight'     => $request->weights->itemWeight,
                'ShippingWeight' => $request->weights->shippingWeight,
            ]) : null,
            'AllowNegativeStock' => $request->allowNegativeStock,
            'DangerousGoods'     => $request->dangerousGoods ? $this->deleteNullValues([
                'UnNumber' => $request->dangerousGoods->unNumber,
                'HazardNo' => $request->dangerousGoods->hazardNo,
            ]) : null,
            'Taric'              => $request->taric,
            'SearchTerms'        => $request->searchTerms,
        ]);

        $response = $this->post('/v1/items', $body);

        if ($response->wasSuccessful) {
            return new CreateItemResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }
}
