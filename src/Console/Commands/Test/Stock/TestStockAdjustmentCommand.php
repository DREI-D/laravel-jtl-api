<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Stock;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDto;
use DREID\LaravelJtlApi\Modules\Item\ItemRepository;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use DREID\LaravelJtlApi\Modules\Stock\Requests\StockAdjustmentRequest;
use DREID\LaravelJtlApi\Modules\Stock\StockRepository;
use DREID\LaravelJtlApi\Modules\Warehouse\DataTransferObjects\WarehouseDto;
use DREID\LaravelJtlApi\Modules\Warehouse\Requests\QueryWarehousesRequest;
use DREID\LaravelJtlApi\Modules\Warehouse\WarehouseRepository;
use Illuminate\Console\Command;
use Throwable;

class TestStockAdjustmentCommand extends Command
{
    protected $signature = 'jtl-api:test:stock-adjustment';

    protected $description = 'Tests the stock adjustment endpoint';

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
        $response = app(WarehouseRepository::class)->queryWarehouses(new QueryWarehousesRequest());
        throw_if($response->totalItems === 0);

        /** @var WarehouseDto $warehouse */
        $warehouse = $response->items[0];

        $response = app(ItemRepository::class)->queryItems(new QueryItemsRequest(pageSize: 1));
        throw_if($response->totalItems === 0);

        /** @var ItemDto $item */
        $item = $response->items[0];

        app(StockRepository::class)->stockAdjustment(
            new StockAdjustmentRequest(
                $warehouse->id,
                $item->id,
                10
            )
        );
    }
}
