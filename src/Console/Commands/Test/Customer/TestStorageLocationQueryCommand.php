<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Customer;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Warehouse\DataTransferObjects\WarehouseDto;
use DREID\LaravelJtlApi\Modules\Warehouse\Requests\QueryStorageLocationsRequest;
use DREID\LaravelJtlApi\Modules\Warehouse\Requests\QueryWarehousesRequest;
use DREID\LaravelJtlApi\Modules\Warehouse\StorageLocationRepository;
use DREID\LaravelJtlApi\Modules\Warehouse\WarehouseRepository;
use Illuminate\Console\Command;
use Throwable;

class TestStorageLocationQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:storage-location-query';

    protected $description = 'Tests the storage location query endpoint';

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

        $response = app(StorageLocationRepository::class)->queryStorageLocations(
            new QueryStorageLocationsRequest($warehouse->id)
        );

        dd($response->items);
    }
}
