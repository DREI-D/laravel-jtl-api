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

        $response = $this->get('/items', [
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
        $response = $this->post('/items', $body);

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
        $response = $this->patch('/items/' . $request->id, $body);

        if ($response->wasSuccessful) {
            return new UpdateItemResponse($response);
        }

        $this->throwExceptionsIfPossible($response);
        throw new UnhandledResponseException($response);
    }

    private function buildRequestBody(CreateItemRequest|UpdateItemRequest $request): array
    {
        return [
            'sku'                => $request->sku,
            'categories'         => $request->categories ? $this->mapCategories($request->categories) : null,
            'name'               => $request->name,
            'description'        => $request->description,
            'shortDescription'   => $request->shortDescription,
            'identifiers'        => $this->mapIdentifiers($request->identifiers),
            'itemPriceData'      => $this->mapItemPriceData($request->itemPriceData),
            'storageOptions'     => $this->mapStorageOptions($request->storageOptions),
            'countryOfOrigin'    => $request->countryOfOrigin,
            'dimensions'         => $this->mapDimensions($request->dimensions),
            'weights'            => $this->mapWeights($request->weights),
            'allowNegativeStock' => $request->allowNegativeStock,
            'dangerousGoods'     => $this->mapDangerousGoods($request->dangerousGoods),
            'taric'              => $request->taric,
            'searchTerms'        => $request->searchTerms,
        ];
    }

    private function mapCategories(array $categories): array
    {
        return array_map(function (ItemCategoryRequest $categoryRequest) {
            return [
                'categoryId' => $categoryRequest->categoryId,
            ];
        }, $categories);
    }

    private function mapIdentifiers(?ItemIdentifiersRequest $identifiers): ?array
    {
        return $identifiers ? $this->deleteNullValues([
            'gtin'               => $identifiers->gtin,
            'manufacturerNumber' => $identifiers->manufacturerNumber,
            'isbn'               => $identifiers->isbn,
            'upc'                => $identifiers->upc,
            'amazonFnsku'        => $identifiers->amazonFnsku,
            'asins'              => $identifiers->asins,
            'ownIdentifier'      => $identifiers->ownIdentifier,
        ]) : null;
    }

    private function mapItemPriceData(?ItemPriceDataRequest $itemPriceData): ?array
    {
        return $itemPriceData ? $this->deleteNullValues([
            'salesPriceNet'        => $itemPriceData->salesPriceNet,
            'suggestedRetailPrice' => $itemPriceData->suggestedRetailPrice,
            'purchasePriceNet'     => $itemPriceData->purchasePriceNet,
            'ebayPrice'            => $itemPriceData->ebayPrice,
            'amazonPrice'          => $itemPriceData->amazonPrice,
        ]) : null;
    }

    private function mapStorageOptions(?ItemStorageOptionsRequest $storageOptions): ?array
    {
        return $storageOptions ? $this->deleteNullValues([
            'inventoryManagementActive'             => $storageOptions->inventoryManagementActive,
            'splitQuantity'                         => $storageOptions->splitQuantity,
            'globalMinimumStockLevel'               => $storageOptions->globalMinimumStock,
            'buffer'                                => $storageOptions->buffer,
            'serialNumberItem'                      => $storageOptions->serialNumberItem,
            'serialNumberTracking'                  => $storageOptions->serialNumberTracking,
            'subjectToShelfLifeExpirationDate'      => $storageOptions->subjectToShelfLifeExpirationDate,
            'subjectToBatchItem'                    => $storageOptions->subjectToBatchItem,
            'procurementTime'                       => $storageOptions->procurementTime,
            'determineProcurementTimeAutomatically' => $storageOptions->determineProcurementTimeAutomatically,
            'additionalHandlingTime'                => $storageOptions->additionalHandlingTime,
        ]) : null;
    }

    private function mapDimensions(?ItemDimensionsRequest $dimensions): ?array
    {
        return $dimensions ? $this->deleteNullValues([
            'length' => $dimensions->length,
            'width'  => $dimensions->width,
            'height' => $dimensions->height,
        ]) : null;
    }

    private function mapWeights(?ItemWeightsRequest $weights): ?array
    {
        /** @noinspection SpellCheckingInspection */

        return $weights ? $this->deleteNullValues([
            'itemWeigth'     => $weights->itemWeight,
            'shippingWeight' => $weights->shippingWeight,
        ]) : null;
    }

    private function mapDangerousGoods(?ItemDangerousGoodsRequest $dangerousGoods): ?array
    {
        return $dangerousGoods ? $this->deleteNullValues([
            'unNumber' => $dangerousGoods->unNumber,
            'hazardNo' => $dangerousGoods->hazardNo,
        ]) : null;
    }
}
