<?php

namespace DREID\LaravelJtlApi\Console\Commands\Test\ItemCustomField;

use DREID\LaravelJtlApi\Exceptions\ConnectionException;
use DREID\LaravelJtlApi\Exceptions\MissingApiKeyException;
use DREID\LaravelJtlApi\Exceptions\MissingLicenseException;
use DREID\LaravelJtlApi\Exceptions\MissingPermissionException;
use DREID\LaravelJtlApi\Exceptions\UnauthorizedException;
use DREID\LaravelJtlApi\Exceptions\UnhandledResponseException;
use DREID\LaravelJtlApi\Modules\Item\DataTransferObjects\ItemDto;
use DREID\LaravelJtlApi\Modules\Item\ItemRepository;
use DREID\LaravelJtlApi\Modules\Item\Requests\QueryItemsRequest;
use DREID\LaravelJtlApi\Modules\ItemCustomField\ItemCustomFieldRepository;
use DREID\LaravelJtlApi\Modules\ItemCustomField\Requests\QueryItemCustomFieldValuesRequest;
use Illuminate\Console\Command;
use Throwable;

class TestItemCustomFieldValuesQueryCommand extends Command
{
    protected $signature = 'jtl-api:test:item-custom-field-values-query';

    protected $description = 'Tests the item custom field values query endpoint';

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

        $response = app(ItemCustomFieldRepository::class)->queryItemCustomFieldValues(
            new QueryItemCustomFieldValuesRequest(
                itemId: $item->id
            )
        );

        dd($response->customFieldValues);
    }
}
