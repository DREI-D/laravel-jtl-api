<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Stock;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Stock\Requests\QueryStocksPerItemRequest;
use DREID\LaravelJtlApi\Modules\Stock\StockRepository;
use Illuminate\Console\Command;

class TestStockQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:stock-query';

    protected $description = 'Tests the stock query endpoint';

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
        $response = app(StockRepository::class)->queryStocksPerItem(new QueryStocksPerItemRequest());

        dd($response->items);
    }
}
