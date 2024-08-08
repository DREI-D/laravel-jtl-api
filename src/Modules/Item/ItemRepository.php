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
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemDangerousGoodsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemDimensionsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemIdentifiersRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemPriceDataRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemStorageOptionsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemWeightsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\UpdateItemRequest;
use DREID\LaravelJtlApi\Modules\Item\Responses\CreateItemResponse;
use DREID\LaravelJtlApi\Modules\Item\Responses\QueryItemsResponse;
use DREID\LaravelJtlApi\Modules\Item\Responses\UpdateItemResponse;
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

        $body = $this->deleteNullValues($this->buildRequestBody($request));
        $response = $this->post('/v1/items', $body);

        if ($response->wasSuccessful) {
            return new CreateItemResponse($response);
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
    public function updateItem(UpdateItemRequest $request): UpdateItemResponse
    {
        $permissions = [Permission::UpdateItem];

        if (!Permission::allowsOneOf($permissions)) {
            throw MissingPermissionException::oneOf($permissions);
        }

        $body = $this->deleteNullValues($this->buildRequestBody($request));
        $response = $this->patch('/v1/items/' . $request->id, $body);

        if ($response->wasSuccessful) {
            return new UpdateItemResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    private function buildRequestBody(CreateItemRequest|UpdateItemRequest $request): array
    {
        return [
            'SKU'                => $request->sku,
            'ManufacturerId'     => $request->manufacturerId,
            'Categories'         => $request->categories ? $this->mapCategories($request->categories) : null,
            'Name'               => $request->name,
            'Description'        => $request->description,
            'ShortDescription'   => $request->shortDescription,
            'Identifiers'        => $this->mapIdentifiers($request->identifiers),
            'ItemPriceData'      => $this->mapItemPriceData($request->itemPriceData),
            'StorageOptions'     => $this->mapStorageOptions($request->storageOptions),
            'CountryOfOrigin'    => $request->countryOfOrigin,
            'Dimensions'         => $this->mapDimensions($request->dimensions),
            'Weights'            => $this->mapWeights($request->weights),
            'AllowNegativeStock' => $request->allowNegativeStock,
            'DangerousGoods'     => $this->mapDangerousGoods($request->dangerousGoods),
            'Taric'              => $request->taric,
            'SearchTerms'        => $request->searchTerms,
        ];
    }

    private function mapCategories(array $categories): array
    {
        return array_map(function (ItemCategoryRequest $categoryRequest) {
            return [
                'CategoryId' => $categoryRequest->categoryId
            ];
        }, $categories);
    }

    private function mapIdentifiers(?ItemIdentifiersRequest $identifiers): ?array
    {
        return $identifiers ? $this->deleteNullValues([
            'Gtin'               => $identifiers->gtin,
            'ManufacturerNumber' => $identifiers->manufacturerNumber,
            'ISBN'               => $identifiers->isbn,
            'UPC'                => $identifiers->upc,
            'AmazonFnsku'        => $identifiers->amazonFnsku,
            'Asins'              => $identifiers->asins,
            'OwnIdentifier'      => $identifiers->ownIdentifier,
        ]) : null;
    }

    private function mapItemPriceData(?ItemPriceDataRequest $itemPriceData): ?array
    {
        return $itemPriceData ? $this->deleteNullValues([
            'SalesPriceNet'        => $itemPriceData->salesPriceNet,
            'SuggestedRetailPrice' => $itemPriceData->suggestedRetailPrice,
            'PurchasePriceNet'     => $itemPriceData->purchasePriceNet,
            'EbayPrice'            => $itemPriceData->ebayPrice,
            'AmazonPrice'          => $itemPriceData->amazonPrice,
        ]) : null;
    }

    private function mapStorageOptions(?ItemStorageOptionsRequest $storageOptions): ?array
    {
        return $storageOptions ? $this->deleteNullValues([
            'InventoryManagementActive'             => $storageOptions->inventoryManagementActive,
            'SplitQuantity'                         => $storageOptions->splitQuantity,
            'GlobalMinimumStockLevel'               => $storageOptions->globalMinimumStock,
            'Buffer'                                => $storageOptions->buffer,
            'SerialNumberItem'                      => $storageOptions->serialNumberItem,
            'SerialNumberTracking'                  => $storageOptions->serialNumberTracking,
            'SubjectToShelfLifeExpirationDate'      => $storageOptions->subjectToShelfLifeExpirationDate,
            'SubjectToBatchItem'                    => $storageOptions->subjectToBatchItem,
            'ProcurementTime'                       => $storageOptions->procurementTime,
            'DetermineProcurementTimeAutomatically' => $storageOptions->determineProcurementTimeAutomatically,
            'AdditionalHandlingTime'                => $storageOptions->additionalHandlingTime,
        ]) : null;
    }

    private function mapDimensions(?ItemDimensionsRequest $dimensions): ?array
    {
        return $dimensions ? $this->deleteNullValues([
            'Length' => $dimensions->length,
            'Width'  => $dimensions->width,
            'Height' => $dimensions->height,
        ]) : null;
    }

    private function mapWeights(?ItemWeightsRequest $weights): ?array
    {
        return $weights ? $this->deleteNullValues([
            'ItemWeight'     => $weights->itemWeight,
            'ShippingWeight' => $weights->shippingWeight,
        ]) : null;
    }

    private function mapDangerousGoods(?ItemDangerousGoodsRequest $dangerousGoods): ?array
    {
        return $dangerousGoods ? $this->deleteNullValues([
            'UnNumber' => $dangerousGoods->unNumber,
            'HazardNo' => $dangerousGoods->hazardNo,
        ]) : null;
    }
}
