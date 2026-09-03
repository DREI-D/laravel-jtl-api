<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Warehouse;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Warehouse\Requests\QueryWarehousesRequest;
use DREID\LaravelJtlApi\Modules\Warehouse\WarehouseRepository;
use Illuminate\Console\Command;

class TestWarehouseQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:warehouse-query';

    protected $description = 'Tests the warehouse query endpoint';

    /**
     * @throws UnhandledResponseException
     * @throws UnauthorizedException
     * @throws ConnectionException
     * @throws MissingLicenseException
     * @throws MissingApiKeyException
     * @throws MissingPermissionException
     */
    public function handle(): void
    {
        $response = app(WarehouseRepository::class)->queryWarehouses(new QueryWarehousesRequest());

        dd($response->items);
    }
}
