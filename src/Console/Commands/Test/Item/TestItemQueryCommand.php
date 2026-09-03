<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\Item;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Item\ItemRepository;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use Illuminate\Console\Command;

class TestItemQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:item-query';

    protected $description = 'Tests the item query endpoint';

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
        $response = app(ItemRepository::class)->queryItems(new QueryItemsRequest(pageSize: 1));

        dd($response->items);
    }
}
