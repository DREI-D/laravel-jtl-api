<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Item;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDto;
use DREID\LaravelJtlApi\Modules\Item\ItemRepository;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemCategoryRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemDangerousGoodsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemDimensionsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemIdentifiersRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemPriceDataRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemStorageOptionsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\Global\ItemWeightsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use DREID\LaravelJtlApi\Modules\Item\Requests\UpdateItemRequest;
use Illuminate\Console\Command;
use Str;
use Throwable;

class TestItemUpdateCommand extends Command
{
    protected $signature = 'jtl-api:test:item-update';

    protected $description = 'Tests the item update endpoint';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     * @throws Throwable
     */
    public function handle(): void
    {
        $response = app(ItemRepository::class)->queryItems(new QueryItemsRequest(pageSize: 1));
        throw_if($response->totalItems === 0);

        /** @var ItemDto $item */
        $item = $response->items[0];

        $response = app(ItemRepository::class)->updateItem(
            new UpdateItemRequest(
                id: $item->id,
                name: 'Testartikel',
                sku: 'TEST-' . Str::random(),
                categories: [
                    new ItemCategoryRequest(
                        categoryId: 1,
                    ),
                ],
                description: 'Testbeschreibung',
                shortDescription: 'Test-Kurzbeschreibung',
                identifiers: new ItemIdentifiersRequest(
                    gtin: 'TEST gtin',
                    manufacturerNumber: 'TEST manufacturerNumber',
                    isbn: '978-0-306-40615-7',
                    upc: '042100005264',
                    amazonFnsku: 'X001ABC123',
                    asins: ['B07FZ8S74R'],
                    ownIdentifier: 'TEST ownIdentifier'
                ),
                itemPriceData: new ItemPriceDataRequest(
                    salesPriceNet: 10.5,
                    suggestedRetailPrice: 9.99,
                    purchasePriceNet: 7.25,
                    ebayPrice: 10.5,
                    amazonPrice: 10.5,
                ),
                storageOptions: new ItemStorageOptionsRequest(
                    inventoryManagementActive: true,
                    splitQuantity: false,
                    globalMinimumStock: 10,
                    buffer: 5,
                    serialNumberItem: false,
                    serialNumberTracking: false,
                    subjectToShelfLifeExpirationDate: false,
                    subjectToBatchItem: false,
                    procurementTime: 0,
                    determineProcurementTimeAutomatically: false,
                    additionalHandlingTime: 0
                ),
                countryOfOrigin: 'Germany',
                dimensions: new ItemDimensionsRequest(
                    length: 6.5,
                    width: 7.85,
                    height: 2.69,
                ),
                weights: new ItemWeightsRequest(
                    itemWeight: 3.7,
                    shippingWeight: 4.0,
                ),
                allowNegativeStock: true,
                dangerousGoods: new ItemDangerousGoodsRequest(
                    unNumber: 'TEST unNumber',
                    hazardNo: 'TEST hazardNo',
                ),
                taric: '6115950000',
                searchTerms: 'TEST Artikel'
            )
        );

        dd($response->item);
    }
}
